<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Auth;
use Response;
use Validator;
use App\Party;
use App\Queue;

class PartyController extends Controller
{
  public static function CreateParty($name, $threshold, $password = null)
  {
    $party = Party::where('name', $name)->first();
    if($party != null){
      return Response::json(['error' => "The party name already exists."], 400);
    }
    $party = new Party();
    $party->name = $name;
    $party->threshold = $threshold;
    $party->host = Auth::user()->id;
    $party->created_by = Auth::user()->id;
    if($password != null){
      $party->password = $password;
    }
    $party->save();
    return Response::json($party, 200);
  }

  public static function SetPassword($party_id, $password = null)
  {
    $party = Party::where('id', $party_id)->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    if($password == null){
      $password = "";
    }
    $party->password = $password;
    $party->save();
    return Response::json("Password set for ".$party->name.".", 200);
  }

  public static function SetThreshold($party_id, $threshold)
  {
    $party = Party::where('id', $party_id)->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    $party->threshold = $threshold;
    $party->save();
    return Response::json("Threshold set for ".$party->name.".", 200);
  }

  public static function TransferHost($party_id, $userId)
  {
    $party = Party::where('id', $party_id)->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    $party->host = $userId;
    $party->save();
    return Response::json("Host set for ".$party->name.".", 200);
  }

  public static function AddSong($party_id, $song_id)
  {
    $party = Party::where('id', $party_id)->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    $queue = new Queue();
    $queue->Party()->associate($party);
    $queue->song_id = $song_id;
    $queue->title = "";
    $queue->artist = "";
    $queue->album = "";
    $queue->album_image = "";
    $queue->votes = 0;
    $queue->save();
  }

  public static function RemoveSong($party_id, $song_id)
  {
    $queue = Queue::with('Party')->where('party_id', $party_id)->where('song_id', $song_id)->first();
    if($queue == null){
      return Response::json(['error' => "The requested song was not found."], 404);
    }
    $queue->delete();
  }

  public static function UpvoteSong($party_id, $song_id)
  {
    $queue = Queue::with('Party')->where('party_id', $party_id)->where('song_id', $song_id)->first();
    if($queue == null){
      return Response::json(['error' => "The requested song was not found."], 404);
    }
    $queue->votes++;
    $queue->save();
  }

  public static function DownvoteSong($party_id, $song_id)
  {
    $queue = Queue::with('Party')->where('party_id', $party_id)->where('song_id', $song_id)->first();
    if($queue == null){
      return Response::json(['error' => "The requested song was not found."], 404);
    }
    $queue->votes--;
    $queue->save();
  }

  public static function DeleteParty($party_id)
  {
    $party = Party::where('id', $party_id)->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    if($party->host == Auth::user()->id){
      $party->delete();
      return Response::json($party->name." deleted.", 200);
    }
    return Response::json(['error' => "You must be the host of a party to delete it."], 400);
  }

  public static function Party($party_id)
  {
    $party = Party::where('id', $party_id)->first();
    if($party == null){
      return Response::json(['error' => "The requested party was not found."], 404);
    }
    return Response::json($party, 200);
  }

  public static function Queue($party_id)
  {
    $queue = Queue::where('party_id', $party_id)->get();
    if($queue == null){
      return Response::json(['error' => "The requested queue was not found."], 404);
    }
    return Response::json($queue, 200);
  }
}
