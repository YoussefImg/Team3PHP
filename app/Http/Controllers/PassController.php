<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ReturnTrait;
use App\Pass;

class PassController extends Controller
{
    use ReturnTrait;

    /**
     * ClassName to return on BeautifulRespons (Response Trait)
     * @var string
     */
    protected $className = 'Pass';


    public function index()
    {
        $pass = Pass::all();
        return response()->json($pass);
    }

    public function byID($id)
    {
        $pass = Pass::find($id);
        if (!empty($pass))
            return response()->json($pass);

        return $this->beautifyReturn(404);
    }

    public function create(Request $request)
    {
        if ($request->RouteID
            && $request->TypePassID
            && $request->Date
            && $request->StartDate
            && $request->ComfortClass
        ) {
            $pass = new Pass();
            $pass->RouteID = $request->RouteID;
            $pass->TypePassID = $request->TypePassID;
            $pass->Date = $request->Date;
            $pass->StartDate = $request->StartDate;
            $pass->ComfortClass = $request->ComfortClass;

            if ($pass->save())
                return $this->beautifyReturn(200, ['Extra' => 'Created', 'SubscriptionID' => $pass->PassID]);

            return $this->beautifyReturn(406);
        }
        return $this->beautifyReturn(400);
    }

    public function update(Request $request, $id)
    {
        $pass = Pass::find($id);
        if (!empty($pass)) {
            if ($request->RouteID)
                $pass->RouteID = $request->RouteID;
            if ($request->TypePassID)
                $pass->TypePassID = $request->TypePassID;
            if ($request->Date)
                $pass->Date = $request->Date;
            if ($request->StartDate)
                $pass->StartDate = $request->StartDate;
            if ($request->ComfortClass)
                $pass->ComfortClass = $request->ComfortClass;

            if ($pass->save())
                return $this->beautifyReturn(200, ['Extra' => 'Updated']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }

    public function delete($id)
    {
        $pass = Pass::find($id);
        if (!empty($pass)) {
            if ($pass->delete())
                return $this->beautifyReturn(200, ['Extra' => 'Deleted']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }
}
