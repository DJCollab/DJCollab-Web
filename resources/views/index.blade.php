@extends('layouts.master')
@section('title', 'Home')
@section('content')
<!-- Panel (Banner) -->
  <section class="panel banner right">
    <div class="content color0 span-3-75">
      <h1 class="major">Welcome to<br />
      DJCollab</h1>
      <p>This is <strong>Ethereal</strong>, a free site template by AJ for <a href="https://html5up.net">HTML5 UP</a>. It’s fully responsive, built on HTML5 and CSS3, and released entirely for free under the Creative Commons license. Hope you dig it :)</p>
      <ul class="actions">
        <li><a href="#first" class="button special color1 circle icon fa-angle-right">Next</a></li>
      </ul>
    </div>
    <div class="image filtered span-1-75" data-position="25% 25%">
      <img src="{{ URL::asset('img/1.jpg') }}" alt="" />
    </div>
  </section>

<!-- Panel (Spotlight) -->
  <section class="panel spotlight medium right" id="first">
    <div class="content span-7">
      <h2 class="major">Sed etiam aenean</h2>
      <p>Mauris et ligula arcu. Proin dapibus convallis accumsan. Lorem maximus hendrerit orci, sit amet elementum massa hendrerit sed. Donec et ullamcorper ligula. Suspendisse amet potenti. Ut pretium libero eleifend euismod sed tristique. Quisque dictum magna risus, id ultricies justo sagittis vitae. Sed id odio tempor, porttitor elit amet, gravida hendrerit fringilla lorem ipsum dolor.</p>
    </div>
    <div class="image filtered tinted" data-position="top left">
      <img src="{{ URL::asset('img/2.jpg') }}" alt="" />
    </div>
  </section>

<!-- Panel -->
  <section class="panel color1">
    <div class="intro joined">
      <h2 class="major">Amet lorem</h2>
      <p>Sed vel nibh libero. Mauris et lorem pharetra massa lorem turpis congue pulvinar. Vivamus sed feugiat finibus. Duis amet bibendum amet sed. Duis mauris ex, dapibus sed ligula tempus volutpat magna etiam.</p>
    </div>
    <div class="inner">
      <ul class="grid-icons three connected">
        <li><span class="icon fa-diamond"><span class="label">Lorem</span></span></li>
        <li><span class="icon fa-camera-retro"><span class="label">Ipsum</span></span></li>
        <li><span class="icon fa-cog"><span class="label">Dolor</span></span></li>
        <li><span class="icon fa-paper-plane"><span class="label">Sit</span></span></li>
        <li><span class="icon fa-bar-chart"><span class="label">Amet</span></span></li>
        <li><span class="icon fa-code"><span class="label">Nullam</span></span></li>
      </ul>
    </div>
  </section>



<!-- Copyright -->
  <div class="copyright">&copy; Untitled. Design: <a href="https://html5up.net">HTML5 UP</a>.</div>

@endsection
