<?php

namespace App\Http\Controllers;

use App\Discount;
use App\Traits\ReturnTrait;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    use ReturnTrait;

    protected $className = 'Discount';

    public function index()
    {
        $discount = Discount::all();
        return response()->json($discount);
    }

    public function byID($id)
    {
        $discount = Discount::find($id);
        if (!empty($discount))
            return response()->json($discount);

        return $this->beautifyReturn(404);
    }

    public function create(Request $request)
    {
        if ($request->Name
            && $request->Amount
        ) {
            $discount = new Discount();
            $discount->Name = $request->Name;
            $discount->Amount = $request->Amount;

            if ($discount->save())
                return $this->beautifyReturn(200, ['Extra' => 'Created', 'DiscountID' => $discount->DiscountID]);

            return $this->beautifyReturn(406);
        }
        return $this->beautifyReturn(400);
    }

    public function update(Request $request, $id)
    {
        $discount = Discount::find($id);
        if (!empty($discount)) {
            if ($request->Name)
                $discount->Name = $request->Name;
            if ($request->Amount)
                $discount->Amount = $request->Amount;

            if ($discount->save())
                return $this->beautifyReturn(200, ['Extra' => 'Updated']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }

    public function delete($id)
    {
        $discount = Discount::find($id);
        if (!empty($discount)) {
            if ($discount->delete())
                return $this->beautifyReturn(200, ['Extra' => 'Deleted']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }
}
