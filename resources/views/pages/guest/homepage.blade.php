@extends('layouts.guest.master')
@section('title', 'Homepage')
@section('style')

@endsection
@section('content')
@include('layouts.guest.header.homepage')
<section data-bs-version="5.1" class="gallery5 mbr-gallery cid-tt1psCukrn" id="gallery5-1l">
    

    
    <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(250, 250, 250);">
    </div>

    <div class="container">
        <div class="mbr-section-head">
            <h3 class="mbr-section-title mbr-fonts-style align-center m-0 display-2"><strong>Our Projects</strong></h3>
            <h4 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-2 display-5">See Our Projects</h4>
        </div>
        <div class="row mbr-gallery mt-4">
            @foreach($projects as $project)
            <div class="col-12 col-md-6 col-lg-6 item gallery-image">
                <div class="item-wrapper">
                    <img class="w-100" src="{{!empty($project->path_thumbnail)?Storage::url($project->path_thumbnail):Storage::url($project->project_sliders[0]->img_slider->path)}}" alt="" data-slide-to="0" data-bs-slide-to="0" data-target="#lb-{{$project->slug}}" data-bs-target="#lb-{{$project->slug}}">
                </div>
                @foreach($project->detail_projects as $dp)
                <span class="badge bg-dark text-light">{{$dp->category->name}}</span>
                @endforeach
                <h6 class="mbr-item-subtitle mbr-fonts-style align-center mb-2 mt-2 display-7">
                    {{$project->title}} <br><a href="{{route('guest.project.detail', $project->slug)}}" class="text-primary">Read More</a>
                </h6>
            </div>
            @endforeach
        </div>

    </div>
</section>

<section data-bs-version="5.1" class="slider6 mbr-embla cid-tqwOEQiJny" id="slider6-3">
    
    
    <div class="position-relative">
        <div class="mbr-section-head">
            <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2"><strong>Recent Post</strong></h4>
            <h5 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-2 display-5">Read the latest post</h5>
        </div>
        <div class="embla mt-4" data-skip-snaps="true" data-align="center" data-contain-scroll="trimSnaps" data-loop="true" data-auto-play="true" data-auto-play-interval="3" data-draggable="true">
            <div class="embla__viewport container-fluid">
                <div class="embla__container">
                    @foreach($posts as $post)
                    <div class="embla__slide slider-image item" style="margin-left: 1rem; margin-right: 1rem;">
                        <div class="slide-content">
                            <div class="item-wrapper">
                                <div class="item-img">
                                    <img src="{{!empty($post->path_thumbnail)?Storage::url($post->path_thumbnail):asset('assets/mobirise-assets/images/no-image.jpg')}}" alt="{{$post->title}}" title="">
                                </div>
                            </div>
                            <div class="item-content align-center">
                                @foreach($post->detail_posts as $dp)
                                <span class="badge bg-dark text-light">{{$dp->category->name}}</span>
                                @endforeach
                                <h5 class="item-title mbr-fonts-style display-4"><em>{{$post->published_at->format('d M Y H:i')}}</em></h5>
                                <h6 class="item-subtitle mbr-fonts-style mt-1 display-7"><strong>{{ $post->title }}</strong></h6>
                                
                            </div>
                            <div class="mbr-section-btn item-footer mt-2"><a href="{{route('guest.post.detail', $post->slug)}}" class="btn item-btn btn-black-outline display-7" target="_blank">Read More &gt;</a></div>
                        </div>
                    </div>
                    @endforeach
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

<section data-bs-version="5.1" class="form4 cid-tqwS2bSi7j mbr-fullscreen" id="form4-7">

    

    

    <div class="container">
        <div class="row content-wrapper justify-content-center">
            <div class="col-lg-3 offset-lg-1 mbr-form" data-form-type="formoid">
                <form action="https://mobirise.eu/" method="POST" class="mbr-form form-with-styler" data-form-title="Form Name"><input type="hidden" name="email" data-form-email="true" value="sTOQQyJ6bGeAhz6/G3DfSak/IQJTjwHklm3C2Icg0HpDLIlh02nQ1bPHVXfxhZLuAfFlGQsJHBxko5bUEpc35gFmNCGaYUadKpBdnLQKxMC8YeyWyOC+bZbeCgQ+A1V/">
                    <div class="row">
                        <div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Thanks for filling out the form!</div>
                        <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                            Oops...! some problem!
                        </div>
                    </div>
                    <div class="dragArea row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <h1 class="mbr-section-title mb-4 display-2">
                                <strong>Contact Us</strong>
                            </h1>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <p class="mbr-text mbr-fonts-style mb-4 display-7">
                                Fill this form and we'll get back to you soon.</p>
                        </div>
                        <div class="col-lg-12 col-md col-12 form-group mb-3" data-for="name">
                            <input type="text" name="name" placeholder="Name" data-form-field="name" class="form-control" value="" id="name-form4-7">
                        </div>
                        <div class="col-lg-12 col-md col-12 form-group mb-3" data-for="email">
                            <input type="email" name="email" placeholder="Email" data-form-field="email" class="form-control" value="" id="email-form4-7">
                        </div>
                        <div class="col-12 col-md-auto mbr-section-btn"><button type="submit" class="btn btn-black display-4">Submit</button></div>
                    </div>
                </form>
            </div>
            <div class="col-lg-7 offset-lg-1 col-12">
                <div class="image-wrapper bg-dark">
                    <img class="w-100" src="{{asset('/')}}assets/images/logo-dcreartdesign.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>

@if(count($ourClients) > 0)
<section data-bs-version="5.1" class="clients1 cid-tt1FQOpY3L" id="clients1-1u">
    
    <div class="images-container container-fluid">
        <div class="mbr-section-head">
            <h3 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2">
                <strong>Our Clients</strong>
            </h3>
            
            
        </div>
        <div class="row justify-content-center mt-4">
            @for($i = 0; $i < count($ourClients); $i++)
            <div class="col-md-3 card">
                <img src="{{Storage::url($ourClients[$i]->path)}}" alt="$ourClients[$i]->title">
            </div>
            @endfor
        </div>
    </div>
</section>
@endif

@endsection
@section('script')
@endsection