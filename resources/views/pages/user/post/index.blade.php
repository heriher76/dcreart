@extends('layouts.user')
@section('title', 'Posts')
@section('content')
@include('layouts.header.header1')
<section data-bs-version="5.1" class="features10 cid-tsWXGgF83Y" id="features11-1i">
    <!---->
    

    
    
    <div class="container-fluid">
        <div class="title">
            <h3 class="mbr-section-title mbr-fonts-style mb-4 display-2">
                <strong>Product List</strong>
            </h3>
            
        </div>
        @foreach($posts as $post)
        <div class="card">
            <div class="card-wrapper">
                <div class="row align-items-center">
                    <div class="col-12 col-md-3">
                        <div class="image-wrapper">
                            <img src="assets/images/product1.jpg" alt="Mobirise Website Builder" title="">
                        </div>
                    </div>
                    <div class="col-12 col-md">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-12">
                                @foreach($post->detail_posts as $detail_post)
                                <a href="#" target="_blank">
                                    <span class="badge bg-dark pull-right">
                                        {{$detail_post->category->name}}
                                    </span>
                                </a>
                                @endforeach
                                </div>
                                <div class="col-12">
                                    <div class="top-line">
                                        <h4 class="card-title mbr-fonts-style display-5"><strong>{{Str::limit($post->title, 50, '..')}}</strong></h4>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="bottom-line">
                                        <a href="" class="btn btn-dark">Read More ></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        {{$posts->links()}}
    </div>
</section>

@endsection