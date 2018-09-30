<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public function sendMail($device){
        $address = $this->getaddress($device->lat, $device->long);
        $data = [
            'device_id' => $device->id,
            'address' => $address
        ];

        if($device->place_name == "work"){
                Mail::send('inc.mail',$data, function($message){
                $message->to(auth()->user()->email, '')->subject('Test Email');
                $message->from('myowntestacc123@gmail.com', 'Gerald');
            });
        }
    }

    public function getAddress($lat, $long){
        $url  = "http://maps.googleapis.com/maps/api/geocode/json?latlng=".$lat.",".$long."&sensor=false";
        $json = file_get_contents($url);
        $data = json_decode($json);
        $status = $data->status;
        $address = '';
        if($status == "OK")
        {
        return $address = $data->results[0]->formatted_address;
        }
        else
        {
        return "No Data Found Try Again";
        }
    }
}
