  <!-- Static navbar -->
  <nav class="navbar navbar-default">
  	<div class="container-fluid">
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
          <li id="create-mode" class="active"><a>Create Mode</a></li>
          @elseif(Request::is('student/*/*'))
          <li class="dropdown active">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@if(Request::is('student/*/edit')) Edit Mode @elseif(Request::is('student/*/upload')) Upload Mode @elseif(Request::is('student/*/delete')) Delete Mode  @else @endif <span class="caret"></span></a>
            <ul class="dropdown-menu">
              @if(Request::is('student/*/edit')) @else <li><a href="edit">Edit Mode</a></li>@endif
              @if(Request::is('student/*/upload')) @else <li><a href="upload">Upload Mode</a></li>@endif
              @if(Request::is('student/*/delete')) @else <li><a href="delete">Delete Mode</a></li>@endif
              <li><a href=".">Detail Mode</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/student/create">Create Mode</a></li>
            </ul>
          </li>
          @elseif(Request::is('student/*'))
          <li class="dropdown active">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Detail Mode<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/{{Request::path()}}/edit">Edit Mode</a></li>
              <li><a href="/{{Request::path()}}/upload">Upload Mode</a></li>
              <li><a href="/{{Request::path()}}/delete">Delete Mode</a></li>
              <li role="separator" class="divider"></li>
              <li><a href="/student/create">Create Mode</a></li>
            </ul>
          </li>
          @else
          @endif
  			</ul>
  		</div><!--/.nav-collapse -->
  	</div><!--/.container-fluid -->
  </nav>
