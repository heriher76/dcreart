@extends('layouts.guest.master')
@section('title', 'Posts')
@section('style')

@endsection
@section('content')
@include('layouts.guest.header.page')
<section data-bs-version="5.1" class="gallery3 cid-tt1DJKajRI" id="gallery3-1t">
    
    
    <div class="container">
        <div class="mbr-section-head">
            <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                <strong>Our Posts</strong></h4>
            <h5 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-2 display-5">Read Our Posts</h5>
        </div>
        <div class="row mt-4">
            @if($posts->total() > 0)
            @foreach($posts as $post)
            <div class="item features-image сol-12 col-md-6 col-lg-4">
                <div class="item-wrapper">
                    <div class="item-img">
                        <img src="{{!empty($post->path_thumbnail)?Storage::url($post->path_thumbnail):asset('assets/mobirise-assets/images/no-image.jpg')}}" alt="{{$post->title}}">
                    </div>
                    <div class="item-content pt-2">
                        @foreach($post->detail_posts as $dp)
                        <span class="badge bg-dark pull-right mr-1">{{$dp->category->name}}</span>
                        @endforeach
                        <p class="item-title mbr-fonts-style mt-2 mb-0 display-7"><em>{{$post->published_at->format('d M Y H:i')}}</em></p>
                        <h6 class="item-subtitle mt-0 mbr-fonts-style display-7 text-justify">
                            <strong>{{Str::limit($post->title, 70, '...')}}</strong></h6>
                        
                    </div>
                    <div class="mbr-section-btn item-footer mt-2"><a href="{{route('guest.post.detail', $post->slug)}}" class="btn btn-dark item-btn display-7" target="_blank">Read more</a></div>
                </div>
            </div>
            @endforeach
            @else
            <div class="alert alert-warning">
                <b>Data belum ada yang dipublish.</b>
            </div>
            @endif
            @if($posts->hasPages())
            <div class="btn-group pull-left">
                <div class="btn btn-default">
                <a href="{{$posts->onFirstPage()?'#onFirstPage':$posts->previousPageUrl()}}" class="btn {{$posts->onFirstPage()?'btn-light':'btn-dark'}} text-bold"><i class="mbri-arrow-prev"></i> Previous</a>
                <a href="{{($posts->currentPage() == $posts->lastPage())?'#onLastPage':$posts->nextPageUrl()}}" class="btn {{($posts->currentPage() == $posts->lastPage())?'btn-light':'btn-dark'}}">Next <i class="mbri-arrow-next"></i></a>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
@section('script')
@endsection