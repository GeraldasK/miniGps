<?php

namespace App\Http\Controllers;

use App\Device;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\MailController;

class DevicesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
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
        return view('add-device');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'device_id' => 'required|unique:devices,id|max:10',
            'place_name' => 'required',
            'long' => 'required|max:10',
            'lat' => 'required|max:10'
        ]);

        $device = new Device;
        $device->id = $request->input('device_id');
        $device->place_name = $request->input('place_name');
        $device->long = $request->input('long');
        $device->lat = $request->input('lat');
        $device->user_id = auth()->user()->id;

        $device->save();

        $mail = new MailController;
        $mail->sendMail($device);

        return redirect('/home')->with('success', 'Device added');
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
        $device = Device::find($id);
        return view('editdevice')->with('device', $device);
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
        $this->validate($request, [
            'device_id' => 'required|unique:devices,id|max:10',
            'place_name' => 'required',
            'long' => 'required|max:10',
            'lat' => 'required|max:10'
        ]);

        $device = Device::find($id);
        $device->id = $request->input('device_id');
        $device->place_name = $request->input('place_name');
        $device->long = $request->input('long');
        $device->lat = $request->input('lat');
        $device->user_id = auth()->user()->id;

        $device->save();

        $mail = new MailController;
        $mail->sendMail($device);

        return redirect('/home')->with('success', 'Device Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $device = Device::find($id);
        $device->delete();

        return redirect('/home')->with('success', 'Device deleted');
    }
}
