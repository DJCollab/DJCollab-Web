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
                    <input type="password" name="createpassword" id="createpassword" value="" placeholder="secret"  />
                </div>
                <div class="field full">
                    <label for="demo-email">Confirm Password</label>
                    <input type="password" name="createcpassword" id="createcpassword" value="" placeholder="secret"  />
                </div>


                <ul class="actions">
                    <li><input type="submit" value="Create Party" class="special color2" /></li>
                    <li><input type="reset" value="Reset" /></li>
                </ul>
            </form>
        </div>
    </div>
</section>

<section class="panel color2-alt" id="second">
    <div class="inner columns aligned">
        <div class="span-3-5">
            <h3 class="major">Your Parties</h3>
            <div class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>

                            <th class="text-center">View</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($parties as $party)
                        <tr>
                            <td>{{ $party->name }}</td>
                            <td class="text-center"><a href="{{ url('/dashboard/party/' .$party->id) }}" class="button small color1">View</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="1"></td>
                        <td class="text-center"><a href="{{ $parties->previousPageUrl() }}" class="button special color1 circle icon fa-angle-left">Prev</a><a href="{{ $parties->nextPageUrl() }}" class="button special color1 circle icon fa-angle-right">Next</a></td>
                      </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</section>


<section class="panel color2-alt" id="third">
    <div class="inner columns aligned">
        <div class="span-3-5">
            <h3 class="major">Your Profile</h3>
            <form method="POST" action="{{ url('dashboard/profile/update') }}">
                {{ csrf_field() }}
                <div class="field half">
                    <label for="demo-name">Name</label>
                    <input type="text" name="name" id="username" value="{{ $user->name}}" placeholder="Name" />
                </div>
                <div class="field half">
                    <label for="demo-name">Email</label>
                    <input type="text" name="email" id="useremail" value="{{ $user->email }}" placeholder="email" />
                </div>
                <div class="field half">
                    <img src="{{ $user->avatar}}">
                </div>



                <ul class="actions">
                    <li><input type="submit" value="Update Profile" class="special color2" /></li>
                </ul>
            </form>
        </div>
    </div>
</section>


<!-- Copyright -->
@endsection
@section('footer')
<script>
$('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
@endsection
