<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Symfony\Component\HttpFoundation\Response;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Facades\Hash;



class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // check if the request is made from the same authentciated user
        if(auth()->user()->id !== (int)$id)
        {

            return response()->json(Response::HTTP_UNAUTHORIZED);
        }

        $user = User::find(auth()->user()->id);

        $response = [
        'data' => $user,
        'message' => 'Data Fetched Successfully'
        ];

        return response()->json($response, Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $data = [
        "first_name" => $request->first_name,
        "last_name" => $request->last_name
        ];

        $user = User::find($id);
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;

        // if the request has key for password then update the password as well

        if(isset($request->all()['password']))
        {
            // hashing password

         $user->password =Hash::make($request->password);

     }

     $user->save();



     $response = [
     'data' => $user,
     'message' => 'Data Updated Successfully'
     ];

     return response()->json($response, Response::HTTP_OK);
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function getUserActivity(Request $request, $id)
    {
        // check if user is authenticated

        if(auth()->user()->id !== (int)$id)
        {

            return response()->json(Response::HTTP_UNAUTHORIZED);
        }


        //fetching user all activties
        $user_activity = Activity::where('subject_id', $id)->orWhere('causer_id',$id)->get()->toArray();

            //checking if activty exist
        if(!empty($user_activity))
        {
            foreach ($user_activity as $key => $value) {

                    //casting date as human readable
                $user_activity[$key]['created_at'] = \Carbon\Carbon::parse($user_activity[$key]['created_at'])->diffForHumans()  ;

                $user_activity[$key]['updated_at'] = \Carbon\Carbon::parse($user_activity[$key]['updated_at'])->diffForHumans()  ;
            }
        }


        $response = [
        'data' => $user_activity,
        'message' => 'Data Fetched Successfully'
        ];

        return response()->json($response, Response::HTTP_OK);
    }
}
