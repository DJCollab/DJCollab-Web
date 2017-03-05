@extends('layouts.master')
@section('title', 'Home')
@section('content')
  <section class="panel banner right">
    <div class="content color0 span-3-75">
      <h1 class="major">Welcome to<br />
      DJCollab</h1>
      <p>This is <strong>DJCollab</strong>, a web and mobile application built so that you and your friends can queue up some 🔥🔥🔥 beats.</p>
      <ul class="actions">
        <li><a href="#first" class="button special color1 circle icon fa-angle-right">Next</a></li>
      </ul>
    </div>
    <div class="image filtered span-1-75" data-position="25% 25%">
      <img src="{{ URL::asset('img/1.jpg') }}" alt="" />
    </div>
  </section>

  <section class="panel spotlight medium right" id="first">
    <div class="content span-7">
      <h2 class="major">Host a Party</h2>
      <p>Become the ultimate DJ.</p>
      <ul class="actions">
        <li><a href="{{ url('/dashboard') }}" class="button special color1 circle icon fa-angle-right">Login</a></li>
      </ul>
    </div>
    <div class="image filtered tinted" data-position="top left">
      <img src="{{ URL::asset('img/2.jpg') }}" alt="" />
    </div>
  </section>

  <section class="panel spotlight large left">
    <div class="content span-5">
      <h2 class="major">Join a Party</h2>
      <p>Start queuing up your favorite songs.</p>
      <ul class="actions">
        <li><a href="{{ url('/dashboard') }}" class="button special color1 circle icon fa-angle-right">Login</a></li>
      </ul>
    </div>
    <div class="image filtered tinted" data-position="top right">
      <img src="{{ URL::asset('img/3.jpg') }}" alt="" />
    </div>
  </section>

  <section class="panel color4-alt">
    <div class="intro color4">
      <h2 class="major">Contact</h2>
      <p>Have a question? Want to more ways to make some fire beats? Hit us up!</p>
    </div>
    <div class="inner columns divided">
      <div class="span-1-5">
        <ul class="contact-icons color1">
          <li class="icon fa-twitter"><a href="#">@djcollab</a></li>
          <li class="icon fa-facebook"><a href="#">facebook.com/djcollab</a></li>
          <li class="icon fa-snapchat-ghost"><a href="#">@djcollab</a></li>
          <li class="icon fa-instagram"><a href="#">@djcollab</a></li>
          <li class="icon fa-medium"><a href="#">medium.com/djcollab</a></li>
        </ul>
      </div>
    </div>
  </section>
@endsection
