<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Post;
use App\Models\DetailPost;
use App\Models\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 100; $i++) { 
            $title = "Lorem Ipsum ".$i;
            $post = Post::create([
                'title' => $title,
                'description' => "Lorem ipsum dolor sit amet consectetur, adipisicing elit. Veritatis assumenda maxime, nisi rem labore quaerat nobis nam adipisci molestiae in fugit rerum veniam asperiores aut velit magni obcaecati sapiente illum? Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ea at, excepturi aliquid culpa earum a, similique accusamus assumenda, alias dolorum recusandae. Obcaecati distinctio voluptatibus, temporibus deserunt exercitationem repudiandae nostrum nesciunt?",
                'path_thumbnail' => 'img-'.$i.'.jpg',
                'slug' => \Str::slug($title),
                'created_by' => "admin"
            ]);

            $detailPost = DetailPost::create([
                'post_id' => $post->id,
		        'category_id' => (int)rand(1, 2)
            ]);
        }
    }
}
