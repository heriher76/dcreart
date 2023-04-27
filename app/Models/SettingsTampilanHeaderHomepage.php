<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SettingsTampilanHeaderHomepage
 * 
 * @property int $id
 * @property string|null $title
 * @property string|null $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class SettingsTampilanHeaderHomepage extends Model
{
	protected $table = 'settings_tampilan_header_homepage';

	protected $fillable = [
		'title',
		'path'
	];
}
