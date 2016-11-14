<?php
/**
 * Created by PhpStorm.
 * User: Ludovic
 * Date: 09-11-16
 * Time: 18:02
 */

namespace App\Traits;

use App\Address;
use Illuminate\Http\Request;

trait AddressTrait
{
    public function createNewAdress(Request $request)
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
                return $address->AddressID;

            return $this->beautifyReturnMessage(406, 'Address Not Acceptable');
        }
        return $this->beautifyReturnMessage(400, 'Address Bad Request');
    }
}