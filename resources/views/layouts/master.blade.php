<html>
<head>
  <title>DJCollab | @yield('title')</title>
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
          @if(Request::is('dashboard'))
          <li><a href="{{ url('/')}}">Home</a></li>
          @else
          <li><a href="{{ url('/dashboard')}}">Dashboard</a></li>
          @endif
        <li><a href="{{ url('/logout')}}">Sign Out</a></li>
        @else
        <li><a href="{{ url('/login')}}">Log In</a></li>
        @endif
      </ul>
    </nav>
    <div id="wrapper">
      @yield('content')
      <div class="copyright">&copy; DJCollab. Design: <a href="https://html5up.net">HTML5 UP</a>.</div>
    </div>
  </div>
  <script src="{{ URL::asset('js/jquery.min.js') }}"></script>
  <script src="{{ URL::asset('js/skel.min.js') }}"></script>
  <script src="{{ URL::asset('js/main.js') }}"></script>
  @yield('footer')
</body>
</html>
