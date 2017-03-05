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
use App\Join;
use Hash;

class PartyController extends Controller
{
  // Creates a party
  // name, threshold, user-id, password
  public static function CreateParty(Request $request)
  {
    $party = Party::where('name', $request->body('name'))->first();
    if($party != null){
      return Response::json(['error' => "The party name already exists."], 400);
    }
    $party = new Party();
    $party->name = $request->body('name');
    $party->threshold = $request->body('threshold');
    $user = User::where('id', $request->body('user-id'))->first();
    if($user == null)
    {
      return Response::json(['error' => "The user was not found."], 400);
    }
    $party->Host()->associate($user);
    $party->CreatedBy()->associate($user);
    if($request->body('password') != null){
      $party->password = Hash::make($request->body('password'));
    }
    $party->save();
    return Response::json($party, 200);
  }

  // Updates a party
  // party-id, name, threshold, user-id, password
  public static function UpdateParty(Request $request)
  {
    $party = Party::where('id', $request->body('party-id'))->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    $party->name = $request->body('name');
    $party->threshold = $request->body('threshold');
    $user = User::where('id', $request->body('user-id'))->first();
    if($user == null)
    {
      return Response::json(['error' => "The user was not found."], 400);
    }
    $party->Host()->associate($user);
    $party->CreatedBy()->associate($user);
    if($request->body('password') != null){
      $party->password = Hash::make($request->body('password'));
    }
    $party->save();
    return Response::json($party, 200);
  }

  // Adds a song to a party
  // party-id, song-id
  public static function AddSong(Request $request)
  {
    $party = Party::where('id', $request->body('party-id'))->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    $queue = new Queue();
    $queue->Party()->associate($party);
    $queue->song_id = $request->body('song-id');
    $queue->title = "";
    $queue->artist = "";
    $queue->album = "";
    $queue->album_image = "";
    $queue->votes = 0;
    $queue->save();
    return Response::json($queue, 200);
  }

  // Deletes a song from a party
  // party-id, song-id
  public static function DeleteSong(Request $request)
  {
    $queue = Queue::with('Party')->where('party_id', $request->body('party-id'))->where('song_id', $request->body('song-id'))->first();
    if($queue == null){
      return Response::json(['error' => "The requested song was not found."], 404);
    }
    $queue->delete();
    return Response::json(200);
  }

  // Upvotes a song in a party
  // party-id, song-id
  public static function UpvoteSong(Request $request)
  {
    $queue = Queue::with('Party')->where('party_id', $request->body('party-id'))->where('song_id', $request->body('song-id'))->first();
    if($queue == null){
      return Response::json(['error' => "The requested song was not found."], 404);
    }
    $queue->votes++;
    $queue->save();
    return Response::json($queue, 200);
  }

  // Downvotes a song in a party
  // party-id, song-id
  public static function DownvoteSong(Request $request)
  {
    $queue = Queue::with('Party')->where('party_id', $request->body('party-id'))->where('song_id', $request->body('song-id'))->first();
    if($queue == null){
      return Response::json(['error' => "The requested song was not found."], 404);
    }
    $queue->votes--;
    $queue->save();
    return Response::json($queue, 200);
  }

  // Deletes a party
  // party-id, user-id
  public static function DeleteParty(Request $request)
  {
    $party = Party::where('id', $request->body('party-id'))->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    $user = User::where('id', $request->body('user-id'))->first();
    if($party->host_id == $user->id){
      $queue = Queue::with('Party')->where('party_id', $request->body('party-id'))->get();
      foreach($queue as $song){
        $song->delete();
      }
      $party->delete();
      return Response::json(200);
    }
    return Response::json(['error' => "You must be the host of a party to delete it."], 400);
  }

  // Returns the party
  // party-id or name
  public static function Party(Request $request)
  {
    $party = null;
    if($request->body('party-id') != null)
    {
      $party = Party::where('id', $request->body('party-id'))->first();
    } else if($request->body('name') != null)
    {
      $party = Party::where('name', $request->body('name'))->first();
    }
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    return Response::json($party, 200);
  }

  // Returns the queue for a party
  // party-id
  public static function Queue(Request $request)
  {
    $queue = Queue::where('party_id', $request->body('party-id'))->get();
    if($queue == null){
      return Response::json(['error' => "The requested queue was not found."], 404);
    }
    return Response::json($queue, 200);
  }

  // Joins a party
  // party-id, user-id
  public static function JoinParty(Request $request)
  {
    $party = Party::where('id', $request->body('party-id'))->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    $user = User::where('id', $request->body('user-id'))->first();
    if($user == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    $join = new Join;
    $join->Party()->associate($party);
    $join->User()->associate($user);
    $join->save();
    return Response::json($join, 200);
  }
}
