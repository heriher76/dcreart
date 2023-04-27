<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Post
 * 
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string|null $path_thumbnail
 * @property string $slug
 * @property string $created_by
 * @property string|null $last_updated_by
 * @property bool $published
 * @property Carbon|null $published_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Collection|DetailPost[] $detail_posts
 *
 * @package App\Models
 */
class Post extends Model
{
	protected $table = 'posts';

	protected $casts = [
		'published' => 'bool'
	];

	protected $dates = [
		'published_at'
	];

	protected $fillable = [
		'title',
		'description',
		'path_thumbnail',
		'slug',
		'created_by',
		'last_updated_by',
		'published',
		'published_at'
	];

	public function detail_posts()
	{
		return $this->hasMany(DetailPost::class);
	}
}
