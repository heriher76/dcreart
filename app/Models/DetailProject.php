<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailProject
 * 
 * @property int $id
 * @property int $project_id
 * @property int $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property Project $project
 *
 * @package App\Models
 */
class DetailProject extends Model
{
	protected $table = 'detail_project';

	protected $casts = [
		'project_id' => 'int',
		'category_id' => 'int'
	];

	protected $fillable = [
		'project_id',
		'category_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function project()
	{
		return $this->belongsTo(Project::class);
	}
}
