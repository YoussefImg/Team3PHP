<?php

namespace App\Http\Controllers;

use App\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function byID($id)
    {
        $address = Address::find($id);
        if (!empty($address))
            return response()->json($address);

        return Response('Not Found', 404);
    }

    public function create(Request $request)
    {
        if ($request->Street
            && $request->Number
            && $request->City
            && $request->ZipCode
            && $request->Coordinates
        ) {
            $address = new Address();
            $address->Street = $request->Street;
            $address->Number = $request->Number;
            $address->City = $request->City;
            $address->ZipCode = $request->ZipCode;
            $address->Coordinates = $request->Coordinates;

            if ($address->save())
                return Response('Address successfully created', 200);

            return Response('Not Acceptable', 406);
        }
        return Response('Bad Request', 400);
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
                return Response('Address successfully updated', 200);
        } else {
            return Response('Not Found', 404);
        }
        return Response('Bad Request', 400);
    }

    public function delete($id)
    {
        $address = Address::find($id);
        if (!empty($address)) {
            if ($address->delete())
                return Response('Address with id ' . $id . ' has successfully been deleted', 200);
        } else {
            return Response('Not Found', 404);
        }
        return Response('Bad Request', 400);
    }
}
