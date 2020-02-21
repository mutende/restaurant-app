<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hotel;
use Auth;
use App\Http\Resources\Hotel as HotelResource;

class HotelController extends Controller
{

    public function __construct()
    {
       $this->middleware('auth:api');


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Hotel::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'location' => 'required'
        ]);

        return Hotel::create([
           'name' => $request->name,
           'location'=>$request->location,
           'user_id' =>$request->user,
            'logo' =>$request->logo,
            'created' => date('Y-m-d H:i:s')
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

        $hotel = Hotel::findOrFail($id);
        $this->validate($request,[
            'name' => 'required',
            'location' => 'required'
        ]);
        $hotel->update($request->all());

        return $request;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);

        $hotel->delete();

        return ['message'=> 'Hotel deleted'];
    }

//    public function showHotels(){
//
//        $hotels = Hotel::all();
//
//        return HotelResource::collection($hotels);
//    }
}
