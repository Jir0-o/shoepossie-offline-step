<?php

namespace App\Http\Traits;

use App\Models\ConsumerLogin;
use App\Models\ConsumerInformation;

class ConsumerLogin
{

     public function LoginData()
     {
          return  ConsumerLogin::ConsumerLoginData();
     }

     public function childCount($C_id)
     {

          return ConsumerInformation::childCount($C_id);
     }
}
