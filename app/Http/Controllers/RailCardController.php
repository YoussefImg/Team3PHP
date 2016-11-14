<?php

namespace App\Http\Controllers;

use App\RailCard;
use App\Traits\ReturnTrait;
use Illuminate\Http\Request;

class RailCardController extends Controller
{
    // RailCard cannot exist w/o a Customer and Viceversa.. controlelr has no point in existing


//    use ReturnTrait;
//
//    protected $className = 'RailCard';
//
//    public function index()
//    {
//        $railCard = RailCard::all();
//        return response()->json($railCard);
//    }
//
//    public function byID($id)
//    {
//        $railCard = RailCard::find($id);
//        if (!empty($railCard))
//            return response()->json($railCard);
//
//        return $this->beautifyReturn(404);
//    }
//
//    /*
//    public function create(Request $request)
//    {
//        if ( $request->DepartureStationID
//            && $request->ArrivalStationID
//        ) {
//            $railCard = new RailCard();
//            $railCard->DepartureStationID = $request->DepartureStationID;
//            $railCard->ArrivalStationID = $request->ArrivalStationID;
//
//            if ($railCard->save())
//                return Response('RailCard successfully created', 200);
//
//            return Response('Not Acceptable', 406);
//        }
//        return response()->json($request);
//        return Response('Bad Request', 400);
//    }
//
//
//    public function update(Request $request, $id)
//    {
//        $railCard = RailCard::find($id);
//        if (!empty($railCard)) {
//            if ($request->DepartureStationID)
//                $railCard->DepartureStationID = $request->DepartureStationID;
//            if ($request->ArrivalStationID)
//                $railCard->ArrivalStationID = $request->ArrivalStationID;
//
//
//            if ($railCard->save())
//                return Response('RailCard successfully updated', 200);
//        } else {
//            return Response('Not Found', 404);
//        }
//        return Response('Bad Request', 400);
//    }
//    */
//
//    public function delete($id)
//    {
//        $railCard = RailCard::find($id);
//        if (!empty($railCard)) {
//            if ($railCard->delete())
//                return $this->beautifyReturn(200, ['Extra' => 'Deleted']);
//        } else {
//            return $this->beautifyReturn(404);
//        }
//        return $this->beautifyReturn(400);
//    }
}
