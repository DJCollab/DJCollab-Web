<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use App\Party;
use Auth;
use Route;
use App\User;

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

    public function ViewParty($id = null)
    {
        if($id != null) {
            $party = Party::where('id', $id)->first();
            return view('party', compact('party'));
        }
        flash('Error! Invalid ID!', 'danger');
        return redirect('MainController@dashboard');
    }

    public function SearchSong($id = null)
    {
        
        return redirect()->action('MainController@ViewParty', compact('id'));
    }







}
