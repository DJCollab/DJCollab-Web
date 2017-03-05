<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        
        $party = Party::where('name', $request->input('createname'))->first();
        if($party != null){
            flash('The party name already exists.', 'danger');
            return redirect()->action("MainController@dashboard");
        }
        $party = new Party();
        $party->name = $request->input('createname');
        $party->threshold = $request->input('createthreshold');
        $user = User::where('id', Auth::user()->id)->first();
        if($user == null)
        {
            flash('The user was not found.', 'danger');
            return redirect()->action('MainController@dashboard');
        }
        $party->Host()->associate($user);
        $party->CreatedBy()->associate($user);
        if($request->input('createpassword') != null){
            if($request->input('createpassword') != $request->input('createcpassword')) {
                flash('Your current password does not match the one you typed in.', 'danger');
                return redirect()->action('MainController@dashboard');
            }
            $party->password = Hash::make($request->input('createpassword'));
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
