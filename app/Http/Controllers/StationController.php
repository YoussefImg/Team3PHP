<?php

namespace App\Http\Controllers;

use App\Station;
use Illuminate\Http\Request;

class StationController extends Controller
{
    public function index()
    {
        $station = Station::all();
        return response()->json($station);
    }

    public function byID($id)
    {
        $station = Station::find($id);
        if (!empty($station))
            return response()->json($station);

        return Response('Not Found', 404);
    }

    public function create(Request $request)
    {
        if ($request->AddressID
            && $request->Name
        ) {
            $station = new Station();
            $station->AddressID = $request->AddressID;
            $station->Name = $request->Name;

            if ($station->save())
                return Response('Station successfully created', 200);

            return Response('Not Acceptable', 406);
        }
        return response()->json($request);
        return Response('Bad Request', 400);
    }

    public function update(Request $request, $id)
    {
        $station = Station::find($id);
        if (!empty($station)) {
            if ($request->AddressID)
                $station->AddressID = $request->AddressID;
            if ($request->Name)
                $station->Name = $request->Name;

            if ($station->save())
                return Response('Station successfully updated', 200);
        } else {
            return Response('Not Found', 404);
        }
        return Response('Bad Request', 400);
    }

    public function delete($id)
    {
        $station = Station::find($id);
        if (!empty($station)) {
            if ($station->delete())
                return Response('Station with id ' . $id . ' has successfully been deleted', 200);
        } else {
            return Response('Not Found', 404);
        }
        return Response('Bad Request', 400);
    }
}
