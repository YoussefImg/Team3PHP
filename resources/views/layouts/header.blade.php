<nav class="navbar">

    <div class="left">
        {{ Html::image('img/NMBS_TEAM_LOGO.png', 'NMBS_TEAM_LOGO') }}
    </div>
    <div class="right">
        <ul>
            <li class="{{ Request::path() ==  '/' ? 'active' : ''  }}"><a href="{{URL::to('/')}}">Dienstregeling</a></li>
            <li class="{{ Request::path() ==  'stations' ? 'active' : ''  }}"><a href="{{URL::to('/stations')}}">Stations</a></li>
            <li class="{{ Request::path() ==  'trains' ? 'active' : ''  }}"><a href="{{URL::to('/trains')}}">Trains</a></li>
        </ul>
    </div>
</nav>