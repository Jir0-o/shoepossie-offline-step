<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class BackofficeLogin
 * 
 * @property int $login_id
 * @property int $office_user_id
 * @property string|null $full_name
 * @property string $user_email
 * @property string $login_user_name
 * @property string $login_user_pass
 * @property string|null $user_image
 * @property int $role_id
 * @property string|null $token
 * @property Carbon|null $last_login
 * @property int $is_active
 * 
 * @property Collection|CartItemReturn[] $cart_item_returns
 *
 * @package App\Models
 */
class BackofficeLogin extends Model
{
	protected $table = 'backoffice_login';
	protected $primaryKey = 'login_id';
	public $timestamps = false;

	protected $casts = [
		'office_user_id' => 'int',
		'role_id' => 'int',
		'is_active' => 'int'
	];

	protected $dates = [
		'last_login'
	];

	protected $hidden = [
		'token'
	];

	protected $fillable = [
		'office_user_id',
		'full_name',
		'user_email',
		'login_user_name',
		'login_user_pass',
		'user_image',
		'role_id',
		'token',
		'last_login',
		'is_active'
	];

	public function cart_item_returns()
	{
		return $this->hasMany(CartItemReturn::class, 'received_by_id');
	}
}
