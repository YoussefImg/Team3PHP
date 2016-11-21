<?php

namespace App\Http\Controllers;

use App\Route;
use App\RouteWithStation;
use App\Traits\ExceptionTrait;
use App\Traits\ReturnTrait;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    use ExceptionTrait;
    use ReturnTrait;

    protected $className = 'Route';

    public function index()
    {
        $route = RouteWithStation::all();
        return response()->json($route);
    }

    public function byID($id)
    {
        $route = RouteWithStation::find($id);
        if (!empty($route))
            return response()->json($route);

        return $this->beautifyReturn(404);
    }

    public function byStations($departureStationID, $arrivalStationID)
    {

        $route = Route::where('ArrivalStationID', '=', $arrivalStationID)
                        ->where('DepartureStationID', '=', $departureStationID)
                        ->get();


        if(!empty($route) && $route->count())
            return response()->json($route);

        return $this->beautifyReturn(404);

    }

    public function create(Request $request)
    {
        if ( $request->DepartureStationID
            && $request->ArrivalStationID
        ) {
            $route = new Route();
            $route->DepartureStationID = $request->DepartureStationID;
            $route->ArrivalStationID = $request->ArrivalStationID;

            try {
                if ($route->save())
                    return $this->beautifyReturn(200, ['Extra' => 'Created', 'RouteID' => $route->RouteID]);

                return $this->beautifyReturn(406);
            } catch (\Exception $e) {
                return $this->beautifyReturn(406, ['Error' => $this->beautifyException($e)]);
            }
        }
        return $this->beautifyReturn(400);
    }

    public function update(Request $request, $id)
    {
        $route = Route::find($id);
        if (!empty($route)) {
            if ($request->DepartureStationID)
                $route->DepartureStationID = $request->DepartureStationID;
            if ($request->ArrivalStationID)
                $route->ArrivalStationID = $request->ArrivalStationID;


            if ($route->save())
                return $this->beautifyReturn(200, ['Extra' => 'Updated']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }

    public function delete($id)
    {
        $route = Route::find($id);
        if (!empty($route)) {
            if ($route->delete())
                return $this->beautifyReturn(200, ['Extra' => 'Deleted']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }
}
