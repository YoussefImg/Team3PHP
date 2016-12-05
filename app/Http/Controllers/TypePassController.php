<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\ReturnTrait;
use App\TypePass;

class TypePassController extends Controller
{
    use ReturnTrait;

    /**
     * ClassName to return on BeautifulRespons (Response Trait)
     * @var string
     */
    protected $className = 'TypePass';


    public function index()
    {
        $typePass = TypePass::all();
        return response()->json($typePass);
    }

    public function byID($id)
    {
        $typePass = TypePass::find($id);
        if (!empty($typePass))
            return response()->json($typePass);

        return $this->beautifyReturn(404);
    }

    public function create(Request $request)
    {
        if ($request->Name
        ) {
            $typePass = new TypePass();
            $typePass->Name = $request->Name;

            if ($typePass->save())
                return $this->beautifyReturn(200, ['Extra' => 'Created', 'TypePassID' => $typePass->TypePassID]);

            return $this->beautifyReturn(406);
        }
        return $this->beautifyReturn(400);
    }

    public function update(Request $request, $id)
    {
        $typePass = TypePass::find($id);
        if (!empty($typePass)) {
            if ($request->Name)
                $typePass->Name = $request->Name;

            if ($typePass->save())
                return $this->beautifyReturn(200, ['Extra' => 'Updated']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }

    public function delete($id)
    {
        $typePass = TypePass::find($id);
        if (!empty($typePass)) {
            if ($typePass->delete())
                return $this->beautifyReturn(200, ['Extra' => 'Deleted']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }
}
