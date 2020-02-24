<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Hotel;
use Auth;
use App\Http\Resources\Hotel as HotelResource;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\File;

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


    public function store(Request $request)
    {


        $this->validate($request,[
            'name' => 'required',
            'location' => 'required'
        ]);
        $userID =  auth('api')->user()->id;

           if($request->logo){
               $this->uploadImage($request->logo);
               $request->logo = $this->generateName($request->logo);
           }

        return Hotel::create([
           'name' => $request->name,
           'location'=>$request->location,
           'user_id' =>$userID,
            'logo' =>$request->logo,
            'created' => date('Y-m-d H:i:s')
        ]);
    }

    private function generateName($image){

        return time().'.' . explode('/', explode(':', substr($image, 0, strpos($image, ';')))[1])[1];
    }

    private  function uploadImage($image){

        Image::make($image)->resize(160, 160)->save(public_path('images/hotel_logos/').$this->generateName($image));


    }

    public function show($id)
    {
        //
    }


    public function update(Request $request, $id)
    {

        $hotel = Hotel::findOrFail($id);
        $this->validate($request,[
            'name' => 'required',
            'location' => 'required'
        ]);

        $currentImage = $hotel->logo;


        if($request->logo != $currentImage){
            $name= $this->generateName($request->logo);
            $this->uploadImage($request->logo);
            $request->merge(['logo'=>$name]);
            $pathToCurrentLogo = public_path('images/hotel_logos/').$currentImage;
            if(file_exists($pathToCurrentLogo)){
                @unlink($pathToCurrentLogo);
            }
        }

        $hotel->update($request->all());

        return ["Message" => "Success"];
    }


    public function destroy($id)
    {
        $hotel = Hotel::findOrFail($id);

        $hotel->delete();

        $currentImage = $hotel->logo;

        $pathToCurrentLogo = public_path('images/hotel_logos/').$currentImage;
        if(file_exists($pathToCurrentLogo)){
            @unlink($pathToCurrentLogo);
        }

        return ['message'=> 'Hotel deleted'];
    }


}
