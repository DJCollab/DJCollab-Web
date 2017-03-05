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

<section class="panel color2-alt" id="first">
    <div class="inner columns aligned">
        <div class="span-3-4">
            <h3 class="major">Add a Song</h3>
            <form method="POST" action="{{ url('dashboard/party/'.$party->id.'/add/') }}">
                {{ csrf_field() }}
                <div class="field full">
                    <label for="demo-name">Song Name</label>
                    <input type="text" name="songname" id="songname" value="" placeholder="Pillow Talk" required />
                </div>
                <ul class="actions">
                    <li><input type="submit" value="Search" class="special color2" /></li>
                    <li><input type="reset" value="Reset" /></li>
                </ul>
            </form>
        </div>
    </div>
</section>

<section class="panel color2-alt" id="second">
    <div class="inner columns aligned">
        <div class="span-3-5">
            <h3 class="major">Party Queue</h3>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>

                            <th class="text-center">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td> $party->name</td>
                            <td class="text-center"><a href="#" class="button small color1">View</a></td>
                        </tr>
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="1"></td>
                        <td class="text-center"><a href="#" class="button special color1 circle icon fa-angle-left">Prev</a><a href="#" class="button special color1 circle icon fa-angle-right">Next</a></td>
                      </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>



<!-- Copyright -->
<div class="copyright">&copy; Untitled. Design: <a href="https://html5up.net">HTML5 UP</a>.</div>

@endsection
@section('footer')
<script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@endsection
