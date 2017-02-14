  <!-- Static navbar -->
  <nav class="navbar navbar-default navbar-fixed-top">
  	<div class="container">
  		<div class="navbar-header">
  			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
  				<span class="sr-only">Toggle navigation</span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  				<span class="icon-bar"></span>
  			</button>
  			<a class="navbar-brand" href="/">CS3233 Ranklist 2020</a>
  		</div>
  		<div id="navbar" class="navbar-collapse collapse">
  			<ul class="nav navbar-nav">
  				<li id="home" @if(Request::path()=="/")class="active"@endif}}><a href="/">Home</a></li>
  				<li id="help" @if(Request::is('help'))class="active"@endif}}><a href="/help">Help</a></li>
          @if(Request::is('student/create'))
          <li class="active"><a href="/student/create">Create Mode</a></li>
          @elseif(Request::is('student/*/*'))
          <li class="dropdown active">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@if(Request::is('student/*/history')) Score History Mode @elseif(Request::is('student/*/edit')) Edit Student Mode @elseif(Request::is('student/*/score')) Edit Score Mode @elseif(Request::is('student/*/delete')) Delete Mode @else @endif <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href=".">Detail Mode</a></li> 
              @if(Request::is('student/*/history')) @else <li><a href="history">History Mode</a></li>@endif
              <li role="separator" class="divider"></li>
              @if(Request::is('student/*/edit')) @else <li><a href="edit">Edit Student Mode</a></li>@endif
              @if(Request::is('student/*/score')) @else <li><a href="score">Edit Score Mode</a></li>@endif
              @if(Request::is('student/*/delete')) @else <li><a href="delete">Delete Mode</a></li>@endif
              <li role="separator" class="divider"></li>
              <li><a href="/student/create">Create Mode</a></li>
            </ul>
          </li>
          @elseif(Request::is('student/*'))
          <li class="dropdown active">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Detail Mode<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/{{Request::path()}}/history">History Mode</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/{{Request::path()}}/edit">Edit Student Mode</a></li>
              <li><a href="/{{Request::path()}}/score">Edit Score Mode</a></li>
              <li><a href="/{{Request::path()}}/delete">Delete Mode</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/student/create">Create Mode</a></li>
            </ul>
          </li>
          @else
          <li><a href="/student/create">Create Mode</a></li>
          @endif
  			</ul>
        <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->
          @if (Auth::guest())
          <li @if(Request::is('login')) class="active" @endif ><a href="{{ route('login') }}">Login</a></li>
          <li @if(Request::is('register')) class="active" @endif ><a href="{{ route('register') }}">Register</a></li>
          @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
              <li>
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                Logout
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </li>
        @endif
      </ul>
  		</div><!--/.nav-collapse -->
  	</div><!--/.container-fluid -->
  </nav>
