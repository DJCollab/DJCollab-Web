<html>
<head>
  <title>DJCollab</title>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
  <link href="{{ URL::asset('css/main.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
  <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
  @yield('head')
</head>
<body>
  <div id="page-wrapper">
    <nav>
      <ul>
        @if(Auth::check())
        <li><a href="#">My Profile</a></li>
        <li><a href="#">Sign Out</a></li>
        @else
        <li><a href="#">Log In</a></li>
        <li><a href="#">Register</a></li>
        @endif
      </ul>
    </nav>
    <div id="wrapper">
      @yield('content')
    </div>
  </div>
  <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
  <script src="{{ URL::asset('js/skel.min.js') }}"></script>
  <script src="{{ URL::asset('js/main.js') }}"></script>
  @yield('footer')
</body>
</html>
