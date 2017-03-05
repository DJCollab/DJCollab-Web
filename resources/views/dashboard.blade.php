@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
<!-- Panel (Banner) -->
  <section class="panel banner right">
    <div class="content color0 span-3-75">
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
        <form method="post" action="#">
          <div class="field full">
            <label for="demo-name">Name</label>
            <input type="text" name="create-name" id="create-name" value="" placeholder="Fire Mixtape" />
          </div>
          <div class="field full">
            <label for="demo-email">Password</label>
            <input type="password" name="create-password" id="create-password" value="" placeholder="secret" />
          </div>
          <div class="field full">
            <label for="demo-name">Skip Song Threshold</label>
            <input type="text" name="create-threshold" id="create-threshold" value="" placeholder="5" />
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
          <tr>
            <td>Item One</td>
            <td>Ante turpis integer aliquet porttitor.</td>
            <td>29.99</td>
          </tr>
          <tr>
            <td>Item Two</td>
            <td>Vis ac commodo adipiscing arcu aliquet.</td>
            <td>19.99</td>
          </tr>
          <tr>
            <td>Item Three</td>
            <td> Morbi faucibus arcu accumsan lorem.</td>
            <td>29.99</td>
          </tr>
          <tr>
            <td>Item Four</td>
            <td>Vitae integer tempus condimentum.</td>
            <td>19.99</td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"></td>
            <td>100.00</td>
          </tr>
        </tfoot>
      </table>

      <passport-clients></passport-clients>
      <passport-authorized-clients></passport-authorized-clients>
      <passport-personal-access-tokens></passport-personal-access-tokens>
    </div>
  </div>
</div>
</section>



<!-- Copyright -->
  <div class="copyright">&copy; Untitled. Design: <a href="https://html5up.net">HTML5 UP</a>.</div>

@endsection
