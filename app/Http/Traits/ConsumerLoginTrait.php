<?php

namespace App\Http\Traits;

use App\Models\ConsumerLogin;

class ConsumerLoginTrait
{
     public function LoginData()
     {
         $ConsumerLogin = ConsumerLogin::join('consumer_information','consumer_information.consumer_id','=','consumer_Login.consumer_id')
                                        ->select('consumer_information.*','consumer_Login.*')->get();
          return  $ConsumerLogin;
     }
     
     public function allConsumerInfo($consumer_id){
         
         $ConsumerInfo= ConsumerLogin::join('consumer_information','consumer_information.consumer_id','=','consumer_Login.consumer_id')
                                        ->where('consumer_information.consumer_id','=',$consumer_id)
                                        ->select('consumer_information.*','consumer_Login.*')
                                        ->get();
         return  $ConsumerInfo;
         
     }
}
