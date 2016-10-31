<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Staff;
use Illuminate\Support\Facades\Input;

class StaffController extends Controller
{
    public function login()
    {
        return response()->json('login_func');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $staff = Staff::all();

        return response()->json($staff);
    }

    public function byID($id)
    {
        $staff_member = Staff::find($id);
        if (!empty($staff_member))
            return response()->json($staff_member);

        return Response('Not Found', 404);
    }

    /**
     * Created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Input::has('AddressID')
            && Input::has('StationID')
            && Input::has('FirstName')
            && Input::has('LastName')
            && Input::has('UserName')
            && Input::has('Password')
            && Input::has('Rights')
            && Input::has('BirthDate')
            && Input::has('Email')
        ) {

            $staff_member = new Staff();
            $staff_member->AddressID = Input::get('AddressID');
            $staff_member->StationID = Input::get('StationID');
            $staff_member->FirstName = Input::get('FirstName');
            $staff_member->LastName = Input::get('LastName');
            $staff_member->UserName = Input::get('UserName');
            $staff_member->Password = Input::get('Password');
            $staff_member->Rights = Input::get('Rights');
            $staff_member->BirthDate = Input::get('BirthDate');
            $staff_member->Email = Input::get('Email');

            if ($staff_member->save())
                return Response('Staff member successfully created', 200);

            return Response('Not Acceptable', 406);
        }
        return Response('Bad Request', 400);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $staff_member = Staff::find($id);
        if (!empty($staff_member)) {
            if (Input::has('AddressID'))
                $staff_member->AddressID = Input::get('AddressID');
            if (Input::has('StationID'))
                $staff_member->StationID = Input::get('StationID');
            if (Input::has('FirstName'))
                $staff_member->FirstName = Input::get('FirstName');
            if (Input::has('LastName'))
                $staff_member->LastName = Input::get('LastName');
            if (Input::has('UserName'))
                $staff_member->UserName = Input::get('UserName');
            if (Input::has('Password'))
                $staff_member->Password = Input::get('Password');
            if (Input::has('Rights'))
                $staff_member->Rights = Input::get('Rights');
            if (Input::has('BirthDate'))
                $staff_member->BirthDate = Input::get('BirthDate');
            if (Input::has('Email'))
                $staff_member->Email = Input::get('Email');


            if ($staff_member->save())
                return Response('Staff member successfully created', 200);
        } else {
            return Response('Not Found', 404);
        }
        return Response('Bad Request', 400);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $staff_member = Staff::find($id);
        if (!empty($staff_member)) {
            if ($staff_member->delete())
                return Response('Staff member with id ' . $id . ' has successfully been deleted', 200);
        } else {
            return Response('Not Found', 404);
        }
        return Response('Bad Request', 400);
    }
}
