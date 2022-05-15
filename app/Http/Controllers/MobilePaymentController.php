<?php

namespace App\Http\Controllers;
use App\Models\MobilePayment;
use App\Models\SmsPing;
use Illuminate\Http\Request;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\PaymentConfirmMail;

class MobilePaymentController extends Controller
{
    

    //add a payment details
    function addPayment(Request $req)
    {
        //set validate rules
        $rules =array(
            "name"=> "required | min:4 | max:20",
            "email" =>"required | min:10 | max:30",
            "phone_number"=>"required | min:10 | max:10",
            "amount"=>"required",
            "ping"=>"required |min:4|max:4",

        );

        //validate data
        $validator=Validator::make($req->all(),$rules);

        if($validator->fails())
        {
            return response()->json($validator->errors(),401);
        }
        else
        {


            //check ping number
            $checkPing = SmsPing::where([['ping',$req->ping],['phone_number',$req->phone_number],['created_at','>',Carbon::now()->subMinutes(2)]],)->first();

            if($checkPing)
            {
                //add data to database
                $MobilePayment = new MobilePayment;
                $MobilePayment->name=$req->name;
                $MobilePayment->email=$req->email;
                $MobilePayment->phone_number=$req->phone_number;
                $MobilePayment->amount=$req->amount;
                $result=$MobilePayment->save();
                if($result)
                {
                    //create email body
                    $details= [
                        'title'=>'Mail from sunshine supermarket',
                        'body' =>'Payment confirmed',
                        'name' =>$req->name,
                        'amount' => $req->amount,
                        'email' => $req->email,
                        'phone_number'=>$req->phone_number
    
                    ];
    
                    //send payment confirmation email to customer
                    Mail::to($req->email)->send(new PaymentConfirmMail($details));

                    // send payment confirmation message to customer
                    $nexmo = app('Nexmo\Client');
                    $nexmo->message()->send([
                    'to'=>'+94'.(int)$req->phone_number,
                    'from'=>'Tharusha',
                    'text'=>'Dear '.$req -> name.', Your Payment '.$req -> amount.' Successfully Claimed.',
                    ]);
                    
                    if($nexmo)
                    {
                        return["Result=>Payment message sent"];
                    }
                    else
                    {
                        return ["Result"=>"Message sending error"];
                    }
                }
                else
                {
                    return ["Result"=>"Data saving error"];
                }
                
            }
            else
            {
                return ["Result"=>"wrong ping"];
            }

            
        }  

    }

}
