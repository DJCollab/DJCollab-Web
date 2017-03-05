<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client;
use App\Party;
use Auth;
use Route;
use App\User;
use App\Queue;

class MainController extends Controller
{
    public function Index()
    {
        return view('index');
    }

    public function dashboard()
    {
        $parties = Party::paginate(5);

        return view('dashboard', compact('parties'));
    }

    public function create(Request $request)
    {
        $this->validate($request, [
            "createname" => "required|string|max:255",
            "createthreshold" => "integer"
        ]);


        $client = new Client();

        try {
            $response = $client->put(url('api/party'), [
                'headers'         => ['X-Foo' => 'Bar'],
                'form_params'            => [
                    'name' => $request->input('createname'),
                    'threshold' => $request->input('createthreshold'),
                    'user-id' => Auth::user()->id
                ],
                'allow_redirects' => false,
                'timeout'         => 5
            ]);
            flash('Created party!', 'success');
            return redirect()->action("MainController@dashboard");
        } catch (RequestException $e){
            //dd($e->getMessage());
            flash($e->getMessage(), 'danger');
            return redirect()->action("MainController@dashboard");
        }


    }

    public function ViewParty($id)
    {
      $party = Party::where('id', $id)->first();
      if($party != null) {
        $queue = Queue::where('party_id', $id)->paginate(5);
        return view('party', compact('party', 'queue'));
      }
      flash('Error! Invalid Party!', 'danger');
      return redirect('MainController@dashboard');
    }

    public function AddSong($id, $songid)
    {

        $address = "https://api.spotify.com/v1/tracks/";
        $song = explode(":", $songid);
        $address .= $song[0];

        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => $address,

        ));
        $result = json_decode(curl_exec($curl));

      $party = Party::where('id', $id)->first();
      if($party != null) {
        $queue = new Queue();
        $queue->Party()->associate($party);
        $queue->song_id = "spotify:track:".$songid;
        $queue->title = $result->name;
        $queue->artist = $result->artists[0]->name;
        $queue->album = $result->album->name;
        $queue->album_image = $result->album->images[0]->url;
        $queue->votes = 0;
        $queue->save();
        flash('Song Added!', 'success');
        return redirect()->back();
      }
      flash('Error! Invalid Party!', 'danger');
      return redirect('MainController@dashboard');
    }
}
