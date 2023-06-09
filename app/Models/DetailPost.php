<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class DetailPost
 * 
 * @property int $id
 * @property int $post_id
 * @property int $category_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * 
 * @property Category $category
 * @property Post $post
 *
 * @package App\Models
 */
class DetailPost extends Model
{
	protected $table = 'detail_post';

	protected $casts = [
		'post_id' => 'int',
		'category_id' => 'int'
	];

	protected $fillable = [
		'post_id',
		'category_id'
	];

	public function category()
	{
		return $this->belongsTo(Category::class);
	}

	public function post()
	{
		return $this->belongsTo(Post::class);
	}
}
