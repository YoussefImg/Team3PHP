<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexViewController extends Controller
{
    public function getDienstRegeling(Request $request)
    {

        //https://api.irail.be/connections/?to={station1}&from={station2} (OPTIONAL:) &date={dmy}&time=2359&timeSel=arrive or depart

        $dateArray = explode('-', $request->Date);
        $date = $dateArray[2] . $dateArray[1] . substr($dateArray[0], 2);
        $time = str_replace(':', '', $request->Time);


        $url = sprintf('https://api.irail.be/connections/?format=json&to=%s&from=%s&date=%s&time=%s&timeSel=%s', $request->To, $request->From, $date, $time, $request->TimeSel);

        $client = new \GuzzleHttp\Client();
        $res = $client->get($url);

        if($res->getStatusCode() != 200)
            return view('pages.index', array('error' => true));


            $body = json_decode($res->getBody());
            $dienstRegeling = $body->connection;

            return view('pages.index', array('error' => false, 'dienstRegelingen' => $dienstRegeling));
    }

    public function show()
    {
        return view('pages.index');
    }
}
