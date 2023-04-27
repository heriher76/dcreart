@extends('layouts.user')
@section('title', "Preview - ".$data->title)
@section('content')
@include('layouts.header.header1')
<section data-bs-version="5.1" class="image2 cid-tqx308CKT8" id="image2-13">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-12 col-lg">
                <div class="text-wrapper">
                    @foreach($data->detail_posts as $detail_post)
                        <a href="#" target="_blank">
                            <span class="badge bg-dark pull-right">
                                {{$detail_post->category->name}}
                            </span>
                        </a>
                        @endforeach
                    <h3 class="mbr-section-title mbr-fonts-style mb-0 display-5">
                        <strong>{{$data->title}}</strong></h3>
                        
                        <p class="mbr-text mbr-fonts-style display-8">
                        {{$data->created_at->format('l, d/m/Y H:i:s')}} - {{ $data->created_by }} 
                        </p>
                        @if(!empty($data->path_thumbnail))
                        <div class="col-12 col-lg-12">
                            <div class="image-wrapper">
                                <img src="{{Storage::url($data->path_thumbnail)}}" alt="Mobirise Website Builder">
                                <p class="mbr-description mbr-fonts-style mt-1 mb-5 align-center display-9">
                                    {{$data->title}}</p>
                            </div>
                        </div>
                        @endif
                    <p class="mbr-text mbr-fonts-style display-7">
                        {!!$data->description!!}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="slider6 mbr-embla cid-tqx3fnQhkN" id="slider6-15">
    
    
    <div class="position-relative">
        <div class="mbr-section-head">
            <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2"><strong>Our News</strong></h4>
            <h5 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-2 display-5">Read the latest news about Mobirise</h5>
        </div>
        <div class="embla mt-4" data-skip-snaps="true" data-align="center" data-contain-scroll="trimSnaps" data-auto-play-interval="5" data-draggable="true">
            <div class="embla__viewport container-fluid">
                <div class="embla__container">
                    <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                        <div class="slide-content">
                            <div class="item-wrapper">
                                <div class="item-img">
                                    <img src="{{asset('assets')}}/images/product5.jpg" alt="Mobirise Website Builder" title="">
                                </div>
                            </div>
                            <div class="item-content">
                                <h5 class="item-title mbr.-fonts-style display-4"><em>Jan 10, 2025</em></h5>
                                <h6 class="item-subtitle mbr-fonts-style mt-1 display-7"><strong>Easy and Simple</strong></h6>
                                <p class="mbr-text mbr-fonts-style mt-3 display-7">Mobirise Page Maker is a free and simple
                                    website builder - just drop site blocks to your page, add content and style it!</p>
                            </div>
                            <div class="mbr-section-btn item-footer mt-2"><a href="" class="btn item-btn btn-black-outline display-7" target="_blank">Read More &gt;</a></div>
                        </div>
                    </div>
                    <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                        <div class="slide-content">
                            <div class="item-wrapper">
                                <div class="item-img">
                                    <img src="{{asset('assets')}}/images/product4.jpg" alt="Mobirise Website Builder" title="">
                                </div>
                            </div>
                            <div class="item-content">
                                <h5 class="item-title mbr-fonts-style display-4"><em>Jan 09, 2025</em></h5>
                                <h6 class="item-subtitle mbr-fonts-style mt-1 display-7"><strong>Automagically Mobile</strong>
                                </h6>
                                <p class="mbr-text mbr-fonts-style mt-3 display-7">Mobirise Site Creator offers a huge
                                    collection of 3500+ site blocks, templates and themes with thousands flexible options. <br>
                                </p>
                            </div>
                            <div class="mbr-section-btn item-footer mt-2"><a href="" class="btn item-btn btn-black-outline display-7" target="_blank">Read More &gt;</a></div>
                        </div>
                    </div>
                    <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                        <div class="slide-content">
                            <div class="item-wrapper">
                                <div class="item-img">
                                    <img src="{{asset('assets')}}/images/product3.jpg" alt="Mobirise Website Builder" title="">
                                </div>
                            </div>
                            <div class="item-content">
                                <h5 class="item-title mbr-fonts-style display-4"><em>Jan 08, 2025</em></h5>
                                <h6 class="item-subtitle mbr-fonts-style mt-1 display-7"><strong>Boost Your Ranking</strong></h6>
                                <p class="mbr-text mbr-fonts-style mt-3 display-7">Mobirise Page Maker is a free and simple
                                    website builder - just drop site blocks to your page, add content and style it!</p>
                            </div>
                            <div class="mbr-section-btn item-footer mt-2"><a href="" class="btn item-btn btn-black-outline display-7" target="_blank">Read More &gt;</a></div>
                        </div>
                    </div>
                    <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                        <div class="slide-content">
                            <div class="item-wrapper">
                                <div class="item-img">
                                    <img src="{{asset('assets')}}/images/product4.jpg" alt="Mobirise Website Builder" title="">
                                </div>
                            </div>
                            <div class="item-content">
                                <h5 class="item-title mbr-fonts-style display-4"><em>Jan 08, 2025</em></h5>
                                <h6 class="item-subtitle mbr-fonts-style mt-1 display-7"><strong>Boost Your Ranking</strong></h6>
                                <p class="mbr-text mbr-fonts-style mt-3 display-7">Mobirise Page Maker is a free and simple
                                    website builder - just drop site blocks to your page, add content and style it!</p>
                            </div>
                            <div class="mbr-section-btn item-footer mt-2"><a href="" class="btn item-btn btn-primary-outline display-7" target="_blank">Read More &gt;</a></div>
                        </div>
                    </div>
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