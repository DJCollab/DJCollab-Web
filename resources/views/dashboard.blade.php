@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')


<!-- Panel (Banner) -->
<section class="panel banner right">
    <div class="content color0 span-3-75">
        @if (session()->has('flash_notification.message'))
            <div class="alert alert-{{ session('flash_notification.level') }}">
                <h3>{!! session('flash_notification.message') !!}</h3>
            </div>
        @elseif(count($errors) > 0)
            <div class="alert alert-danger">
                <h3>Error creating the party!</h3>
            </div>
        @endif

        <h1 class="major">Dashboard</h1>
        <p>You can join parties and create parties from here. You can also add songs to a party! Click the button below to try it out!</p>
        <ul class="actions">
            <li><a href="#first" class="button special color1 circle icon fa-angle-right">Next</a></li>
        </ul>
    </div>
    <div class="image filtered span-1-75" data-position="25% 25%">
        <img src="{{ URL::asset('img/1.jpg') }}" alt="" />
    </div>
</section>

<!-- Panel (Spotlight) -->
<section class="panel color2-alt" id="first">
    <div class="inner columns aligned">
        <div class="span-3-5">
            <h3 class="major">Create a Party</h3>
            <form method="POST" action="{{ url('dashboard/create') }}">
                {{ csrf_field() }}
                <div class="field half">
                    <label for="demo-name">Name</label>
                    <input type="text" name="createname" id="createname" value="" placeholder="Fire Mixtape" required />
                </div>
                <div class="field half">
                    <label for="demo-name">Skip Song Threshold</label>
                    <input type="text" name="createthreshold" id="createthreshold" value="" placeholder="5" required />
                </div>
                <div class="field full">
                    <label for="demo-email">Password</label>
                    <input type="password" name="createpassword" id="createpassword" value="" placeholder="secret" required />
                </div>
                <div class="field full">
                    <label for="demo-email">Confirm Password</label>
                    <input type="password" name="createcpassword" id="createcpassword" value="" placeholder="secret" required />
                </div>


                <ul class="actions">
                    <li><input type="submit" value="Create Party" class="special color2" /></li>
                    <li><input type="reset" value="Reset" /></li>
                </ul>
            </form>
        </div>
    </div>
</section>

<section class="panel color2-alt" id="first">
    <div class="inner columns aligned">
        <div class="span-3-5">
            <h3 class="major">All Parties</h3>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Password</th>
                            <th>Join</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parties as $party)
                        <tr>
                            <td>{{ $party->name }}</td>
                            <td><input type="password" name="createpassword" id="createpassword" value="" placeholder="secret" required /></td>
                            <td><input type="submit" value="Join Party" class="small color2" /></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2"></td>
                            <td>100.00</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>


<section class="panel color2-alt" id="first">
    <div class="inner columns aligned">
        <div class="span-3-5">
            <h3 class="major">Current Party</h3>
        </div>
    </div>
</section>

<section class="panel color2-alt" id="first">
    <div class="inner columns aligned">
        <div class="span-3-5">
            <h3 class="major">Your Profile</h3>
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
