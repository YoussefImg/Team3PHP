<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StationsViewController extends Controller
{
    public function getStation(Request $request)
    {

        //https://api.irail.be/connections/?to={station1}&from={station2} (OPTIONAL:) &date={dmy}&time=2359&timeSel=arrive or depart

        $dateArray = explode('-', $request->Date);
        $date = $dateArray[2] . $dateArray[1] . substr($dateArray[0], 2);
        $time = str_replace(':', '', $request->Time);

        $url = "https://api.irail.be/liveboard/?format=json";

        $url .= "&station=" . $request->Name;

        if (isset($request->Date))
            $url .= "&date=" . $date;

        if (isset($request->Time))
            $url .= "&time=" . $time;

        $url .= "&arrdep=" . $request->TimeSel;



        $client = new \GuzzleHttp\Client();
        $res = $client->get($url);

        if($res->getStatusCode() != 200)
            return view('pages.index', array('error' => true));


        $body = json_decode($res->getBody());
        $station = $body->stationinfo;
        $departures = $body->departures;

        return view('pages.stations', array('error' => false, 'station' => $station, 'departures' => $departures));

    }

    public function show()
    {
        return view('pages.stations');
    }
}
