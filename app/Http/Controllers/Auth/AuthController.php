<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    /**
     * Redirect the user to the Spotify authentication page.
     *
     * @return Response
     */
    public function redirectToProvider()
    {
      return Socialite::with('spotify')->scopes([
        'user-read-email', //Get Email
        'user-read-private', //Get Subscription Status
        //'playlist-modify-private', //Manage Private Playlists
        //'user-library-modify', //Modify Spotify Library
      ])->redirect();
    }

    /**
     * Obtain the user information from Spotify
     * @return Resonse
     */
    public function handleProviderCallback()
    {
      $user = Socialite::driver('spotify')->user();
      $authUser = $this->findOrCreateUser($user);
      Auth::login($authUser, true);
      return redirect()->to('/dashboard');
    }

    public function findOrCreateUser($user)
    {
      $authUser = User::where('spotify_id', $user->id)->first();
      if ($authUser) {
          return $authUser;
      }
      return User::create([
          'name' => $user->nickname,
          'email' => $user->email,
          'spotify_id' => $user->id,
          'avatar' => $user->avatar,
          'country' => $user->user['country'],
          'product' => $user->user['product'],
      ]);
    }
}
