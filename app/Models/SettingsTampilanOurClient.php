<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SettingsTampilanOurClient
 * 
 * @property int $id
 * @property string $title
 * @property string $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class SettingsTampilanOurClient extends Model
{
	protected $table = 'settings_tampilan_our_clients';

	protected $fillable = [
		'title',
		'path'
	];
}
