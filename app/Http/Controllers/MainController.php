<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Party;
use Auth;
use Route;

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
            "createpassword" => "string|max:255",
            "createcpassword" => "string|max:255",
            "createthreshold" => "integer"
        ]);


        $request = Request::create('/api/party', 'PUT', array(
             "name"     => $request->createname,
             "threshold"    => $request->createthreshold,
             "user-id"    => Auth::user()->id
        ));
        dd($request);
        $response = Route::dispatch($request);
        //return $response;
        dd($response);




        $party = new Party();
        $party->name = $request->createname;
        $party->threshold = $request->createthreshold;
        $party->CreatedBy()->associate(Auth::user()->id);
        $party->Host()->associate(Auth::user()->id);


        if($request->input('createpassword') != "" && $request->input('createcpassword') != "")
        {
            if(strlen($request->input('createpassword')) >= 5)
            {
              if ($request->input('createcpassword') == $request->input('createpassword'))
              {
                $party->password = bcrypt($request->input('createpassword'));
              } else
              {
                  flash('Your current password does not match the one you typed in.', 'danger');
                  return redirect()->action('MainController@dashboard');
              }
            }
            else
            {
                flash('Your password must be longer than five characters.');
                return redirect()->action('MainController@dashboard');
            }
        }
        $party->save();

        flash('Party Created Successfully!', 'success');
        return redirect()->action("MainController@dashboard");
    }

    public function ViewParty($id = null)
    {
        return view('party');
    }
}
