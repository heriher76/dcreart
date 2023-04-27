<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectSlider
 * 
 * @property int $id
 * @property int $img_slider_id
 * @property int $project_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property ImgSlider $img_slider
 * @property Project $project
 *
 * @package App\Models
 */
class ProjectSlider extends Model
{
	protected $table = 'project_slider';

	protected $casts = [
		'img_slider_id' => 'int',
		'project_id' => 'int'
	];

	protected $fillable = [
		'img_slider_id',
		'project_id'
	];

	public function img_slider()
	{
		return $this->belongsTo(ImgSlider::class);
	}

	public function project()
	{
		return $this->belongsTo(Project::class);
	}
}
