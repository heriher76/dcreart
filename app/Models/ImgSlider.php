<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ImgSlider
 * 
 * @property int $id
 * @property string $title
 * @property string $path
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|ContentSlider[] $content_sliders
 * @property Collection|ProjectSlider[] $project_sliders
 *
 * @package App\Models
 */
class ImgSlider extends Model
{
	protected $table = 'img_slider';

	protected $fillable = [
		'title',
		'path'
	];

	public function content_sliders()
	{
		return $this->hasMany(ContentSlider::class);
	}

	public function project_sliders()
	{
		return $this->hasMany(ProjectSlider::class);
	}
}
