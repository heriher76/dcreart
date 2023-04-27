@extends('layouts.guest.master')
@section('title', $post->title.' - Post')
@section('style')

@endsection
@section('content')
@include('layouts.guest.header.page')
<section data-bs-version="5.1" class="image1 cid-tt1ywtgYVu" id="image1-1n">
    

    
    

    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg-12">
                <div class="image-wrapper">
                    <img src="{{!empty($post->path_thumbnail)?Storage::url($post->path_thumbnail):asset('assets/mobirise-assets/images/no-image.jpg')}}" alt="Mobirise Website Builder">
                    <p class="item-title mbr-fonts-style mt-2 display-7"><em>{{!empty($post->published_at)?$post->published_at->format('d M Y H:i'):$post->created_at->format('d M Y H:i')}} - {{$post->created_by}}</em></p>
                </div>
            </div>
            <div class="col-12 col-lg-12">
                <div class="text-wrapper">
                    <h3 class="mbr-section-title mbr-fonts-style mb-3 display-5">
                        <strong>{{$post->title}}</strong></h3>
                    <div>{!!$post->description!!}</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="slider6 mbr-embla cid-tqx3fnQhkN" id="slider6-15">
    
    
    <div class="position-relative">
        <div class="mbr-section-head">
            <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2"><strong>Latest Posts</strong></h4>
            <h5 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-2 display-5">Read the latest posts</h5>
        </div>
        <div class="embla mt-4" data-skip-snaps="true" data-align="center" data-contain-scroll="trimSnaps" data-loop="true" data-auto-play="true" data-auto-play-interval="4" data-draggable="true">
            <div class="embla__viewport container-fluid">
                <div class="embla__container">
                    @if($latestPosts->total() > 0)
                    @foreach($latestPosts as $lp)
                    <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                        <div class="slide-content">
                            <div class="item-wrapper">
                                <div class="item-img">
                                    <img src="{{!empty($lp->path_thumbnail)?Storage::url($lp->path_thumbnail):asset('assets/mobirise-assets/images/no-image.jpg')}}" alt="{{$lp->post}}" title="">
                                </div>
                            </div>
                            <div class="item-content pt-2">
                                @foreach($lp->detail_posts as $dp)
                                <span class="badge bg-dark">{{ $dp->category->name }}</span>
                                @endforeach
                                <h5 class="item-title mbr-fonts-style display-4"><em>{{!empty($lp->published_at)?$lp->published_at->format('d M Y H:i'):$lp->created_at->format('d M Y H:i')}}</em></h5>
                                <h6 class="item-subtitle mbr-fonts-style mt-1 display-7"><strong>{{Str::limit($lp->title, 70, '...')}}</strong></h6>
                                
                            </div>
                            <div class="mbr-section-btn item-footer mt-2"><a href="{{ route('guest.post.detail', $lp->slug) }}" class="btn item-btn btn-black display-7" target="_blank">Read More &gt;</a></div>
                        </div>
                    </div>
                    @endforeach
                    @else
                    <div class="alert alert-warning">
                        <b>Data belum ada yang dipublish.</b>
                    </div>
                    @endif
                </div>
            </div>
            <button class="embla__button embla__button--prev">
                <span class="mobi-mbri mobi-mbri-arrow-prev mbr-iconfont" aria-hidden="true"></span>
                <span class="sr-only visually-hidden visually-hidden">Previous</span>
            </button>
            <button class="embla__button embla__button--next">
                <span class="mobi-mbri mobi-mbri-arrow-next mbr-iconfont" aria-hidden="true"></span>
                <span class="sr-only visually-hidden visually-hidden">Next</span>
            </button>
        </div>
    </div>
</section>
@endsection
@section('script')
@endsection