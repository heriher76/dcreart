<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class SettingsTampilanKontenAboutu
 * 
 * @property int $id
 * @property string $title
 * @property string $content
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class SettingsTampilanKontenAboutu extends Model
{
	protected $table = 'settings_tampilan_konten_aboutus';

	protected $fillable = [
		'title',
		'content'
	];
}
