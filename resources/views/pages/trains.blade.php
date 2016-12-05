@extends('layouts.default')
@section('title', 'NMBSTeam WebApp')
@section('content')

    <div class="header_title row">
        <h1>Trains</h1>
    </div>

    <div class="header_form row">
        <div class="container">
            <div class="search-form row">
                {{ Form::open(['url' => '/trains']) }}
                {{ Form::token() }}
                <div class="row">
                    <div class="col-sm-2">{{ Form::label('TreinID', 'Train ID') }}</div>
                    <div class="col-sm-8">{{ Form::text('TreinID', 'S83964', ['required' => true]) }}</div>
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
                    @foreach($stops->stop as $stop)

                        <div id="accordion" class="search-result" role="tablist" aria-multiselectable="true">
                            <div class="card">
                                <div class="card-header" role="tab" id="heading_{{ $loop->index }}">
                                    <div class="title">
                                        <a data-toggle="collapse" data-parent="#accordion" aria-expanded="true"
                                           href="#collapse_{{ $loop->index }}">
                                            <div class="title-primary row">
                                                <div class="col-xs-2">
                                                    {{ date('H:i', $stop->time) }}
                                                    @if ($stop->delay != 0)
                                                        <span class="vertraging">{{ intval($stop->delay)/60 }}</span>
                                                    @endif
                                                </div>
                                                <div class="col-xs-8">
                                                    {{ $stop->stationinfo->standardname }}
                                                </div>
                                                <div class="col-xs-2">
                                                    {{ $stop->platform }}
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                {{--card content--}}
                                <div id="collapse_{{ $loop->index }}"
                                     class="search-result-info collapse {{ $loop->index == 0 ? 'in': '' }}"
                                     role="tabpanel" aria-labelledby="heading_{{ $loop->index }}">
                                    <div class="card-block">
                                        <div class="arrival row {{ ($stop->arrivalCanceled != 0)? 'canceled' : '' }}">
                                            <div class="col-xs-4 col-xs-offset-3">
                                                <strong>Arrival:</strong>
                                                {{ date('H:i', $stop->scheduledArrivalTime) }}
                                                @if ($stop->arrivalDelay != 0)
                                                    <span class="vertraging">{{ intval($stop->arrivalDelay)/60 }}</span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="depart row {{ ($stop->departureCanceled != 0)? 'canceled' : '' }}">
                                            <div class="col-xs-4 col-xs-offset-3">
                                                <strong>Depart:</strong>
                                                {{ date('H:i', $stop->scheduledDepartureTime) }}
                                                @if ($stop->departureDelay != 0)
                                                    <span class="vertraging">{{ intval($stop->departureDelay)/60 }}</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    @endforeach
                @endif
            @endif
        </div>
    </div>

@stop
