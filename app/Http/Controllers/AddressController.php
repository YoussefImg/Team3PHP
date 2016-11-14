<?php

namespace App\Http\Controllers;

use App\Address;
use App\Traits\AddressTrait;
use App\Traits\ReturnTrait;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    use AddressTrait;
    use ReturnTrait;

    protected $className = 'Address';

    public function index()
    {
        $address = Address::all();

        return response()->json($address);
    }

    public function byID($id)
    {
        $address = Address::find($id);
        if (!empty($address))
            return response()->json($address);

        return $this->beautifyReturn(404);
    }

    public function create(Request $request)
    {
        $createAddressResponse = $this->createNewAdress($request);

        if (is_numeric($createAddressResponse)) {
            return $this->beautifyReturn(200, ['Extra' => 'Created', 'AddressID' => $createAddressResponse]);
        } else {
            return $createAddressResponse;
        }
    }

    public function update(Request $request, $id)
    {
        $address = Address::find($id);
        if (!empty($address)) {
            if ($request->Street)
                $address->Street = $request->AddressID;
            if ($request->Number)
                $address->Number = $request->StationID;
            if ($request->City)
                $address->City = $request->FirstName;
            if ($request->ZipCode)
                $address->ZipCode = $request->LastName;
            if ($request->Coordinates)
                $address->Coordinates = $request->UserName;

            if ($address->save())
                return $this->beautifyReturn(200, ['Extra' => 'Updated']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }

    public function delete($id)
    {
        $address = Address::find($id);
        if (!empty($address)) {
            if ($address->delete())
                return $this->beautifyReturn(200, ['Extra' => 'Deleted']);
        } else {
            return $this->beautifyReturn(404);
        }
        return $this->beautifyReturn(400);
    }
}
