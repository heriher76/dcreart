@foreach($posts as $post)
<div style="border: 1px solid; padding: 5px; margin-bottom: 5px;">
    <label for="">{{$post->title}}</label><br>
    @foreach($post->detail_posts as $dp)
    <tt>{{$dp->category->name}}</tt>
    @endforeach
    <p>{{$post->description}}</p>
</div>
@endforeach