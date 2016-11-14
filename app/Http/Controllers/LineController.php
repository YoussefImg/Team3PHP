<?php

namespace App\Http\Controllers;

use App\Line;
use App\Traits\ReturnTrait;
use Illuminate\Http\Request;

class LineController extends Controller
{
    use ReturnTrait;

    protected $className = 'Line';

    public function index()
    {
        $line = Line::all();
        return response()->json($line);
    }

    public function byID($id)
    {
        $line = Line::find($id);
        if (!empty($line))
            return response()->json($line);

        return $this->beautifyReturn(404);
    }

    public function create(Request $request)
    {
        if ( $request->RouteID
            && $request->TrainType
        ) {
            $line = new Line();
            $line->RouteID = $request->RouteID;
            $line->TrainType = $request->TrainType;

            if ($line->save())
                return $this->beautifyReturn(200, ['Extra' => 'Created', 'LineID' => $line->LineID]);

            return $this->beautifyReturn(406);
        }
        return $this->beautifyReturn(400);
    }

    public function update(Request $request, $id)
    {
        $line = Line::find($id);
        if (!empty($line)) {
            if ($request->RouteID)
                $line->RouteID = $request->RouteID;
            if ($request->TrainType)
                $line->TrainType = $request->TrainType;


            if ($line->save())
                return $this->beautifyReturn(200, ['Extra' => 'Updated']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }

    public function delete($id)
    {
        $line = Line::find($id);
        if (!empty($line)) {
            if ($line->delete())
                return $this->beautifyReturn(200, ['Extra' => 'Deleted']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }
}
