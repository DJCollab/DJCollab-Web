@extends('layouts.master')
@section('title', 'View Party')

@section('content')

<!-- Panel (Banner) -->
<section class="panel banner right">
    <div class="content color0 span-3-75">
        @if (session()->has('flash_notification.message'))
            <div class="alert alert-{{ session('flash_notification.level') }}">
                <h3>{!! session('flash_notification.message') !!}</h3>
            </div>
            @endif
        <h1 class="major">{{ $party->name }}</h1>
        <p>You can add songs and view the queue of songs from this page. Scroll to the right to try it!</p>
        <ul class="actions">
            <li><a href="#first" class="button special color1 circle icon fa-angle-right">Next</a></li>
        </ul>
    </div>
    <div class="image filtered span-1-75" data-position="25% 25%">
        <img src="{{ URL::asset('img/1.jpg') }}" alt="" />
    </div>
</section>

<section class="panel color2-alt add-song" id="first">
    <div class="inner columns aligned">
        <div class="span-3">
            <h3 class="major">Add a Song</h3>
            <form method="POST" action="">
                {{ csrf_field() }}
                <div class="field full">
                    <label for="demo-name">Song Name</label>
                    <input type="text" name="songname" id="songname" value="" placeholder="Pillow Talking" required />
                </div>
                <div class="table-wrapper search-results">
                    <table>
                        <tbody id="resultsList">
                        </tbody>
                    </table>
                </div>
            </form>
        </div>
    </div>
</section>

<section class="panel color2-alt" id="second">
    <div class="inner columns aligned">
        <div class="span-5-5">
            <h3 class="major">Party Queue</h3>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Artist</th>
                            <th>Album</th>
                        </tr>
                    </thead>
                    <tbody>
                      @foreach($queue as $song)
                        <tr>
                            <td class="img-align"><img src="{{ $song->album_image }}"></td>
                            <td>{{ $song->title }}</td>
                            <td>{{ $song->artist }}</td>
                            <td>{{ $song->album }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="3"></td>
                        <td class="text-center"><a href="{{ $queue->previousPageUrl() }}" class="button special color1 circle icon fa-angle-left">Prev</a><a href="{{ $queue->nextPageUrl() }}" class="button special color1 circle icon fa-angle-right">Next</a></td>
                      </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>



<!-- Copyright -->

@endsection
@section('footer')
<script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
<script src="/js/spotify.js"></script>
<script>
$('#songname').keypress(function (e) {
  if (e.which == 13) {
    SearchSongs($("#songname").val());
    return false;
  }
});
$link = "{{ url('dashboard/party/'.$party->id.'/add/') }}";
</script>
@endsection
