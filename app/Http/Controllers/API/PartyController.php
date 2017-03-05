<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Response;
use Validator;
use App\Party;
use App\Queue;
use App\User;
use Hash;

class PartyController extends Controller
{
  public static function CreateParty(Request $request)
  {
    $party = Party::where('name', $request->header('name'))->first();
    if($party != null){
      return Response::json(['error' => "The party name already exists."], 400);
    }
    $party = new Party();
    $party->name = $request->header('name');
    $party->threshold = $request->header('threshold');
    $user = User::where('id', $request->header('user-id'))->first();
    if($user == null)
    {
      return Response::json(['error' => "The user was not found."], 400);
    }
    $party->Host()->associate($user);
    $party->CreatedBy()->associate($user);
    if($request->header('password') != null){
      $party->password = Hash::make($request->header('password'));
    }
    $party->save();
    return Response::json($party, 200);
  }

  public static function UpdateParty(Request $request)
  {
    $party = Party::where('id', $request->header('party-id'))->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    $party->name = $request->header('name');
    $party->threshold = $request->header('threshold');
    $user = User::where('id', $request->header('user-id'))->first();
    if($user == null)
    {
      return Response::json(['error' => "The user was not found."], 400);
    }
    $party->Host()->associate($user);
    $party->CreatedBy()->associate($user);
    if($request->header('password') != null){
      $party->password = Hash::make($request->header('password'));
    }
    $party->save();
    return Response::json($party, 200);
  }

  public static function AddSong(Request $request)
  {
    $party = Party::where('id', $request->header('party-id'))->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    $queue = new Queue();
    $queue->Party()->associate($party);
    $queue->song_id = $request->header('song-id');
    $queue->title = "";
    $queue->artist = "";
    $queue->album = "";
    $queue->album_image = "";
    $queue->votes = 0;
    $queue->save();
    return Response::json($queue, 200);
  }

  public static function DeleteSong(Request $request)
  {
    $queue = Queue::with('Party')->where('party_id', $request->header('party-id'))->where('song_id', $request->header('song-id'))->first();
    if($queue == null){
      return Response::json(['error' => "The requested song was not found."], 404);
    }
    $queue->delete();
    return Response::json(200);
  }

  public static function UpvoteSong(Request $request)
  {
    $queue = Queue::with('Party')->where('party_id', $request->header('party-id'))->where('song_id', $request->header('song-id'))->first();
    if($queue == null){
      return Response::json(['error' => "The requested song was not found."], 404);
    }
    $queue->votes++;
    $queue->save();
    return Response::json($queue, 200);
  }

  public static function DownvoteSong(Request $request)
  {
    $queue = Queue::with('Party')->where('party_id', $request->header('party-id'))->where('song_id', $request->header('song-id'))->first();
    if($queue == null){
      return Response::json(['error' => "The requested song was not found."], 404);
    }
    $queue->votes--;
    $queue->save();
    return Response::json($queue, 200);
  }

  public static function DeleteParty(Request $request)
  {
    $party = Party::where('id', $request->header('party-id'))->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    $user = User::where('id', $request->header('user-id'))->first();
    if($party->host_id == $user->id){
      $queue = Queue::with('Party')->where('party_id', $request->header('party-id'))->get();
      foreach($queue as $song){
        $song->delete();
      }
      $party->delete();
      return Response::json(200);
    }
    return Response::json(['error' => "You must be the host of a party to delete it."], 400);
  }

  public static function Party(Request $request)
  {
    $party = Party::where('id', $request->header('party-id'))->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    return Response::json($party, 200);
  }

  public static function Queue(Request $request)
  {
    $queue = Queue::where('party_id', $request->header('party-id'))->get();
    if($queue == null){
      return Response::json(['error' => "The requested queue was not found."], 404);
    }
    return Response::json($queue, 200);
  }
}
