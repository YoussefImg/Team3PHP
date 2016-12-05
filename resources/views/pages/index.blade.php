@extends('layouts.default')
@section('title', 'NMBSTeam WebApp')
@section('content')

    <div class="header_title row">
        <h1>Dienstregeling</h1>
    </div>

    <div class="header_form row">
        <div class="container">
            <div class="search-form row">
                {{ Form::open(['url' => '/']) }}
                {{ Form::token() }}
                <div class="row">
                    <div class="col-sm-2">{{ Form::label('From', 'From') }}</div>
                    <div class="col-sm-8">{{ Form::text('From', 'Groenendael', ['required' => true]) }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-2">{{ Form::label('To', 'To', ['required' => true]) }}</div>
                    <div class="col-sm-8">{{ Form::text('To', 'Kiewit') }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-2">{{ Form::label('Date', 'Date') }}</div>
                    <div class="col-sm-6">{{ Form::date('Date', \Carbon\Carbon::now()), ['required' => true] }}</div>
                    <div class="col-sm-2 radio-align">{{ Form::radio('TimeSel', 'depart', true) }} {{ Form::label('TimeSel', 'Depart') }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-2">{{ Form::label('Time', 'Time') }}</div>
                    <div class="col-sm-6">{{ Form::text('Time', \Carbon\Carbon::now('Europe/Brussels')->format('H:i')), ['required' => true] }}</div>
                    <div class="col-sm-2 radio-align">{{ Form::radio('TimeSel', 'arrival', false) }} {{ Form::label('TimeSel', 'Arrive') }}</div>
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
                    @foreach($dienstRegelingen as $dienstRegeling)

                        <div id="accordion" class="search-result" role="tablist" aria-multiselectable="true">
                            <div class="card">
                                <div class="card-header" role="tab" id="heading_{{ $loop->index }}">
                                    <div class="title">
                                        <a data-toggle="collapse" data-parent="#accordion" aria-expanded="true"
                                           href="#collapse_{{ $loop->index }}">

                                            <div class="title-primary row">
                                                {{ date('H:i', $dienstRegeling->departure->time) }}
                                                @if ($dienstRegeling->departure->delay != 0)
                                                    <span class="vertraging">{{ intval($dienstRegeling->departure->delay)/60 }}</span>
                                                @endif

                                                &gt;

                                                <span class="uur">{{ date('H:i', $dienstRegeling->arrival->time) }}</span>
                                                @if ($dienstRegeling->arrival->delay != 0)
                                                    <span class="vertraging">{{ intval($dienstRegeling->arrival->delay)/60 }}</span>
                                                @endif
                                            </div>
                                            <div class="title-secundary row">
                                                {{ date('H', $dienstRegeling->duration) }}
                                                u {{ intval(date('i', $dienstRegeling->duration)) }} min
                                                @if(isset($dienstRegeling->vias))
                                                    - {{ $dienstRegeling->vias->number }} transfers
                                                @endif
                                            </div>
                                        </a>
                                    </div>
                                </div>

                                {{--card content--}}
                                <div id="collapse_{{ $loop->index }}"
                                     class="search-result-info collapse {{ $loop->index == 0 ? 'in': '' }}"
                                     role="tabpanel" aria-labelledby="heading_{{ $loop->index }}">

                                    <div class="card-block">
                                        <div class="departure row {{ ($dienstRegeling->departure->canceled != 0)? 'canceled' : '' }}">
                                            <div class="col-xs-2">{{ date('H:i', $dienstRegeling->departure->time) }}</div>
                                            <div class="col-xs-9">
                                                {{ $dienstRegeling->departure->station }}
                                                <div class="extra-info">
                                                    {{ $dienstRegeling->departure->direction->name }}
                                                    - {{ substr($dienstRegeling->departure->vehicle, strripos($dienstRegeling->departure->vehicle, '.')+1) }}
                                                </div>
                                            </div>
                                            <div class="col-xs-1">
                                                <span class="platform">{{ $dienstRegeling->departure->platform }}
                                            </span>
                                            </div>
                                        </div>

                                        {{--vias--}}
                                        @if(isset($dienstRegeling->vias))
                                            @foreach($dienstRegeling->vias->via as $via)

                                                <div class="via-arrival row {{ ($via->arrival->canceled != 0)? 'canceled' : '' }}">
                                                    <div class="col-xs-2">
                                                        {{ date('H:i', $via->arrival->time) }}
                                                        @if($via->arrival->delay != 0)
                                                            <span class="vertraging">{{ intval($via->arrival->delay)/60 }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-xs-9">
                                                        {{ $via->stationinfo->standardname }}
                                                    </div>
                                                    <div class="col-xs-1">
                                                        <span class="platform">{{ $via->arrival->platform }}
                                                    </span>
                                                    </div>
                                                </div>

                                                <div class="via-icon row">
                                                    <div class="col-xs-1"><span class="glyphicon glyphicon-sort"></span>
                                                    </div>
                                                </div>

                                                <div class="via-departure row {{ ($via->departure->canceled != 0)? 'canceled' : '' }}">
                                                    <div class="col-xs-2">
                                                        {{ date('H:i', $via->departure->time) }}
                                                        @if($via->departure->delay != 0)
                                                            <span class="vertraging">{{ intval($via->departure->delay)/60 }}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-xs-9">
                                                        {{ $via->stationinfo->standardname }}
                                                        <div class="extra-info">
                                                            @if($loop->last)
                                                                {{ $dienstRegeling->arrival->direction->name }} -
                                                                {{ substr($dienstRegeling->arrival->vehicle, strripos($dienstRegeling->arrival->vehicle, '.')+1) }}

                                                            @else
                                                                @php
                                                                    $newtVia = $dienstRegeling->vias->via[$loop->iteration];
                                                                @endphp
                                                                {{ $newtVia->direction->name }} -
                                                                {{ substr($newtVia->vehicle, strripos($newtVia->vehicle, '.')+1) }}

                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="col-xs-1">
                                                        <span class="platform">{{ $via->departure->platform }}
                                                    </span>
                                                    </div>
                                                </div>

                                            @endforeach
                                        @endif

                                        <div class="arrival row {{ ($dienstRegeling->arrival->canceled != 0)? 'canceled' : '' }}">
                                            <div class="col-xs-2">{{ date('H:i', $dienstRegeling->arrival->time) }}</div>
                                            <div class="col-xs-9">
                                                {{ $dienstRegeling->arrival->station }}
                                            </div>
                                            <div class="col-xs-1">
                                                <span class="platform">{{ $dienstRegeling->arrival->platform }}
                                            </span>
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
