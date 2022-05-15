<?php

namespace App\Http\Controllers;

use App\Models\SmsPing;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentConfirmMail;


class PingController extends Controller
{
    function sendPing(Request $req)
    {
        

        //create rules
        $rules =array(
            
            "phone_number"=>"required | min:10 | max:10",

        );

        //validate data
        $validator=Validator::make($req->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }
        else
        {
            

            //delete same numbers
            if($checkNumber=SmsPing::where('phone_number',$req->phone_number))
            {
                $checkNumber->delete();
            }
            //generate a random ping
            $ping = rand(1111,9999);

            //save data to database
            $SmsPing = new SmsPing();
            $SmsPing->phone_number=$req->phone_number;
            $SmsPing->ping=$ping;
            $result=$SmsPing->save();
            if($result)
            {


                // send ping to customer
                $nexmo = app('Nexmo\Client');
                $nexmo->message()->send([
                    'to'=>'+94'.(int)$req->phone_number,
                    'from'=>'Sunshine Store',
                    'text'=>'Verify ping: '.$ping,
                ]);
                
                if($nexmo)
                {
                    return["Result=>ping sent"];
                }
                else{
                    return["Result =>Ping sent failed"];
                }

                
                

            }
            else
            {
                return ["Result"=>"error"];
            }
        }  
    }

}
