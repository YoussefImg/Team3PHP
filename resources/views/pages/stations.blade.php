@extends('layouts.default')
@section('title', 'NMBSTeam WebApp')
@section('content')

    <div class="header_title row">
        <h1>Stations</h1>
    </div>

    <div class="header_form row">
        <div class="container">
            <div class="search-form row">
                {{ Form::open(['url' => '/stations']) }}
                {{ Form::token() }}
                <div class="row">
                    <div class="col-sm-2">{{ Form::label('Name', 'Station') }}</div>
                    <div class="col-sm-8">{{ Form::text('Name', 'Groenendael', ['required' => true]) }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-2">{{ Form::label('Date', 'Datum') }}</div>
                    <div class="col-sm-6">{{ Form::date('Date', \Carbon\Carbon::now(), ['required' => true]) }}</div>
                    <div class="col-sm-2 radio-align">{{ Form::radio('TimeSel', 'DEP', true) }} {{ Form::label('TimeSel', 'Depart') }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-2">{{ Form::label('Time', 'Uur') }}</div>
                    <div class="col-sm-6">{{ Form::text('Time', \Carbon\Carbon::now()->format('H:i'), ['required' => true]) }}</div>
                    <div class="col-sm-2 radio-align">{{ Form::radio('TimeSel', 'ARR', false) }} {{ Form::label('TimeSel', 'Arrive') }}</div>
                </div>
                <br/>
                <div class="row">
                    <div class="col-xs-8 col-xs-offset-2">
                        {{ Form::submit('Search') }}
                    </div>
                </div>

                {{ Form::close() }}
            </div>
        </div>
    </div>

    <div class="search-results row">
        <div class="container">

            @if(isset($error))
                @if($error)
                    <span class="error-alert">An error occured!</span>

                @else
                    <div class="search-results-header row">
                        <div class="col-xs-2">Uur</div>
                        <div class="col-xs-8"></div>
                        <div class="col-xs-2">Spoor</div>
                    </div>


                    @foreach($departures->departure as $departure)
                        {{ Form::open(['url' => '/trains', 'class'=>'search-result-link']) }}
                        <button type="submit" name="TreinID" value="{{ substr($departure->vehicle, strripos($departure->vehicle, '.')+1) }}">
                            <div class="search-result">
                                <div class="title-primary row">
                                    <div class="col-xs-2">
                                        {{ date('H:i', $departure->time) }}
                                        @if ($departure->delay != 0)
                                            <span class="vertraging">{{ intval($departure->delay)/60 }}</span>
                                        @endif
                                    </div>
                                    <div class="col-xs-8">{{ $departure->stationinfo->standardname }}</div>
                                    <div class="col-xs-2">{{ $departure->platform }}</div>
                                </div>
                            </div>
                        </button>
                        {{ Form::close() }}

                    @endforeach
                @endif
            @endif
        </div>
    </div>
@stop
