<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class FileCkeditor
 * 
 * @property int $id
 * @property string $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 *
 * @package App\Models
 */
class FileCkeditor extends Model
{
	protected $table = 'file_ckeditor';

	protected $fillable = [
		'path'
	];
}
