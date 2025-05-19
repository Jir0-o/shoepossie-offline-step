<?php

namespace App\Http\Traits;

use App\Models\ConsumerLogin;

class ConsumerLoginTrait
{

     public function LoginData()
     {
          return  ConsumerLogin::ConsumerLoginData();
     }
}
