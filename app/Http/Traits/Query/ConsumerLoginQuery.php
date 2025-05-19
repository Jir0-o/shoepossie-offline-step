<?php

namespace App\Http\Traits\Query;

use App\Models\ConsumerLogin;

trait ConsumerLoginQuery
{

     public static function ConsumerLoginData()
     {
          $ConsumerLogin = ConsumerLogin::join('consumer_information','consumer_information.consumer_id','=','consumer_Login.consumer_id')
                                        ->select('consumer_information.*','consumer_Login.*')->get();

          return  $ConsumerLogin;
     }
     
     public static function ConsumerInfo($consumer_id)
     {
          $ConsumerInfo= ConsumerLogin::join('consumer_information','consumer_information.consumer_id','=','consumer_Login.consumer_id')
                                        ->where('consumer_information.consumer_id','=',$consumer_id)
                                        ->select('consumer_information.*','consumer_Login.*')
                                        ->get();

          return  $ConsumerInfo;
     }
}
