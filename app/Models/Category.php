<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * 
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|DetailPost[] $detail_posts
 * @property Collection|DetailProject[] $detail_projects
 *
 * @package App\Models
 */
class Category extends Model
{
	protected $table = 'categorys';

	protected $fillable = [
		'name',
		'description'
	];

	public function detail_posts()
	{
		return $this->hasMany(DetailPost::class);
	}

	public function detail_projects()
	{
		return $this->hasMany(DetailProject::class);
	}
}
