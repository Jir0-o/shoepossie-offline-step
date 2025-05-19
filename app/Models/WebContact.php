<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebContact
 * 
 * @property int $web_contact_id
 * @property string|null $web_contact_name
 * @property string|null $web_contact_email
 * @property string|null $web_contact_no
 * @property string|null $web_contact_message
 *
 * @package App\Models
 */
class WebContact extends Model
{
	protected $table = 'web_contact';
	protected $primaryKey = 'web_contact_id';
	public $timestamps = false;

	protected $fillable = [
		'web_contact_name',
		'web_contact_email',
		'web_contact_no',
		'web_contact_message'
	];
}
