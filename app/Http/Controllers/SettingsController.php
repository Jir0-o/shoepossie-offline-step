<?php

namespace App\Http\Controllers;

use App\Models\BannerInformation;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class SettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Banner = BannerInformation::first();
        return view('settings.systemSettings', compact(['Banner']));
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
        $request->validate([
            'banner_mobile' => 'required',
            'banner_address' => 'required',
            'banner_email' => 'required',
            'banner_name' => 'required',
            'banner_code' => 'nullable',
            'banner_url' => 'required',
        ]);

        $bannerUpdate = BannerInformation::find($id);
        $bannerUpdate->banner_mobile = $request->banner_mobile;
        $bannerUpdate->banner_address = $request->banner_address;
        $bannerUpdate->banner_email = $request->banner_email;
        $bannerUpdate->banner_name = $request->banner_name;
        $bannerUpdate->banner_code = $request->banner_code;
        $bannerUpdate->banner_url = $request->banner_url;

        if ($request->file('banner_logo')) {
            $imageName = date("dmy") . $request->file('banner_logo')->getClientOriginalName();
            $path = url('/') . "/backend/" . $imageName;
            $request->file('banner_logo')->move(public_path('/backend/'), $imageName);
            $bannerUpdate->banner_logo = $path;
        }
        $bannerUpdate->update();

        return redirect()->back()->with('success', 'System Settings Updated');
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
        //
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
