<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use FarhanWazir\GoogleMaps\GMaps;
use App\Http\Controllers\MailController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $user_id = auth()->user()->id;
         $user = User::find($user_id);

        $address = new MailController();

        //Google map setup
        $config = array();
        $config['center'] = '54.687157, 25.279652';
        $config['zoom'] = '14';
        $config['map_height'] = '500px';
        $config['scrollwheel'] = false;
        $gmaps = new GMaps;
        $gmaps->initialize($config);
        
        //looping for popup data
        foreach($user->devices as $device):
            $marker['position'] = $device->lat.','.$device->long;
            $marker['infowindow_content'] = 'device Id: '.$device->id.'<br>Place:'.$device->place_name.'<br>Adress: '.$address->getAddress($device->lat,$device->long);
            $gmaps->add_marker($marker);
        endforeach;

        $map = $gmaps->create_map();
        $data = [];
        $data['devices'] = $user->devices;
        $data['map'] = $map;
        return view('home')->with('data', $data);
        
    }
}
