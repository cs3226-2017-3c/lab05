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
				<li id="home" @if(Request::path()=="/")class="active"@endif}}><a href="/">{{trans('navigation.home')}}</a></li>
  				<li id="history" @if(Request::path()=="history")class="active"@endif}}><a href="/history">{{trans('navigation.history')}}</a></li>
				<li id="achievement" @if(Request::path()=="achievement")class="active"@endif}}><a href="/achievement">{{trans('navigation.achievement')}}</a></li>
          <li id="help" @if(Request::is('help'))class="active"@endif}}><a href="/help">{{trans('navigation.help')}}</a></li>
		  
		  </li>
          @if(Request::is('student/create'))
          <li class="active"><a href="/student/create">{{trans('navigation.createMode')}}</a></li>
          @elseif(Request::is('student/*/*'))
          <li class="dropdown active">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@if(Request::is('student/*/history')) {{trans('navigation.historyMode')}} @elseif(Request::is('student/*/edit')) {{trans('navigation.editStudentMode')}} @elseif(Request::is('student/*/score')) {{trans('navigation.editScoreMode')}} @elseif(Request::is('student/*/delete')) {{trans('navigation.deleteMode')}} @else @endif <span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href=".">{{trans('navigation.detailMode')}}</a></li> 
              @if(Request::is('student/*/history')) @else <li><a href="history">{{trans('navigation.historyMode')}}</a></li>@endif
              @if (Auth::check() and (Auth::user()->access == 1 or Auth::user()->student_id == $student->id))
              @if(Request::is('student/*/edit')) @else <li><a href="edit">{{trans('navigation.editStudentMode')}}</a></li>@endif
              @endif
              @if(Auth::check() and Auth::user()->access == 1)
              <li role="separator" class="divider"></li>
              @if(Request::is('student/*/score')) @else <li><a href="score">{{trans('navigation.editScoreMode')}}</a></li>@endif
              @if(Request::is('student/*/delete')) @else <li><a href="delete">{{trans('navigation.deleteMode')}}</a></li>@endif
              <li><a href="/student/create">{{trans('navigation.createMode')}}</a></li>
              <li><a href="/bulkEdit">{{trans('navigation.bulkEditMode')}}</a></li>
              @endif
            </ul>
          </li>
          @elseif(Request::is('student/*'))
          <li class="dropdown active">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{trans('navigation.detailMode')}}<span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/{{Request::path()}}/history">{{trans('navigation.historyMode')}}</a></li>
              @if (Auth::check() and (Auth::user()->access == 1 or Auth::user()->student_id == $student->id))
              <li><a href="/{{Request::path()}}/edit">{{trans('navigation.editStudentMode')}}</a></li>
              @endif
              @if(Auth::check() and Auth::user()->access == 1)
              <li role="separator" class="divider"></li>
              <li><a href="/{{Request::path()}}/score">{{trans('navigation.editScoreMode')}}</a></li>
              <li><a href="/{{Request::path()}}/delete">{{trans('navigation.deleteMode')}}</a></li>
              <li><a href="/student/create">{{trans('navigation.createMode')}}</a></li>
              <li><a href="/bulkEdit">{{trans('navigation.bulkEditMode')}}</a></li>
              @endif
            </ul>
          </li>
          @elseif(Request::is('bulkEdit/*') || Request::is('bulkEdit'))
          <li class="active"><a href="/bulkEdit"">{{trans('navigation.bulkEditMode')}}</a></li>
          @else
          @if (Auth::check() and Auth::user()->access == 1)
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="caret"></span></a>
            <ul class="dropdown-menu">
              <li><a href="/student/create">{{trans('navigation.createMode')}}</a></li>
              <li><a href="/bulkEdit">{{trans('navigation.bulkEditMode')}}</a></li>
            </ul>
          </li>
          @endif
          @endif
  			</ul>
        <ul class="nav navbar-nav navbar-right">
          <!-- Authentication Links -->

          @if (Auth::guest())
          <li @if(Request::is('login')) class="active" @endif ><a href="{{ route('login') }}">{{trans('navigation.login')}}</a></li>
          @else
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <ul class="dropdown-menu" role="menu">
             <li>
                <a href="/message">
                {{trans('navigation.message')}}
              </a>
            </li>
              <li>
                <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                document.getElementById('logout-form').submit();">
                {{trans('navigation.logout')}}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
              </form>
            </li>
          </ul>
        </li>
        @endif
        @if(Request::is('/'))
        <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown">
            {{ Config::get('languages')[App::getLocale()] }}
          </a>
          <ul class="dropdown-menu">
            @foreach (Config::get('languages') as $lang => $language)
              @if ($lang != App::getLocale())
                <li>
                  <a href="changeLanguage/{{$lang}}">{{$language}}</a>
                </li>
              @endif
            @endforeach
          </ul>
          @endif
        </ul>
  		</div><!--/.nav-collapse -->
  	</div><!--/.container-fluid -->
  </nav>
