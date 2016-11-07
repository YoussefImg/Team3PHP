<?php

namespace App\Http\Controllers;

use App\LostObject;
use Illuminate\Http\Request;

class LostObjectController extends Controller
{
    public function index()
    {
        $lostObject = LostObject::all();
        return response()->json($lostObject);
    }

    public function byID($id)
    {
        $lostObject = LostObject::find($id);
        if (!empty($lostObject))
            return response()->json($lostObject);

        return Response('Not Found', 404);
    }

    public function create(Request $request)
    {
        if ($request->StationID
            && $request->Description
            && $request->Date
            && $request->TrainID
        ) {
            $lostObject = new LostObject();
            $lostObject->StationID = $request->StationID;
            $lostObject->Description = $request->Description;
            $lostObject->Date = $request->Date;
            $lostObject->TrainID = $request->TrainID;

            if ($lostObject->save())
                return Response('LostObject successfully created', 200);

            return Response('Not Acceptable', 406);
        }
        return response()->json($request);
        return Response('Bad Request', 400);
    }

    public function update(Request $request, $id)
    {
        $lostObject = LostObject::find($id);
        if (!empty($lostObject)) {
            if ($request->StationID)
                $lostObject->StationID = $request->StationID;
            if ($request->Description)
                $lostObject->Description = $request->Description;
            if ($request->Date)
                $lostObject->Date = $request->Date;
            if ($request->TrainID)
                $lostObject->TrainID = $request->TrainID;

            if ($lostObject->save())
                return Response('LostObject successfully updated', 200);
        } else {
            return Response('Not Found', 404);
        }
        return Response('Bad Request', 400);
    }

    public function delete($id)
    {
        $lostObject = LostObject::find($id);
        if (!empty($lostObject)) {
            if ($lostObject->delete())
                return Response('LostObject with id ' . $id . ' has successfully been deleted', 200);
        } else {
            return Response('Not Found', 404);
        }
        return Response('Bad Request', 400);
    }
}
