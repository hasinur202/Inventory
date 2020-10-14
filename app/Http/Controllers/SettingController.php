<?php

namespace App\Http\Controllers;

use App\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;

class SettingController extends Controller
{

    public function getData(){
        $data = Setting::all();

        return response()->json([
            'data'=>$data,
            'message'=>'success'
        ],200);
    }

    public function store(Request $request){
        $this->validate($request, [
            'title'    => 'required',
            'mobile' => 'required',
            'address'  => 'required',
        ]);


        $settings = new Setting();

        if ($request->get('logo')) {
            $logo = $request->get('logo');
            $name = Str::random(5).'.' . explode('/', explode(':', substr($logo, 0, strpos($logo, ';')))[1])[1];
            $img = Image::make($request->logo);
            $upload_path = public_path()."/images/";
            $img->save($upload_path.$name);

            $settings->logo        = $name;
        }

        $settings->title    = $request->title;
        $settings->mobile      = $request->mobile;
        $settings->address     = $request->address;

        $settings->save();

        return response()->json([
            'message'=>'success'
        ],200);

    }

    public function update(Request $request){
        $settings = Setting::find($request->id);
        $settings->title    = $request->title;
        $settings->mobile      = $request->mobile;
        $settings->address     = $request->address;

        $settings->save();

        return response()->json([
            'message'=>'success'
        ],200);

    }
}
