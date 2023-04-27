@extends('layouts.guest.master')
@section('title', 'About Us')
@section('style')

@endsection
@section('content')
@include('layouts.guest.header.page')
<section data-bs-version="5.1" class="features6 cid-tqwVXzhISZ mbr-parallax-background" id="features7-t">
    <!---->
    

    
    <div class="mbr-overlay" style="opacity: 0.3; background-color: rgb(250, 250, 250);">
    </div>
    <div class="container-fluid">
        <div class="card-wrapper">
            <div class="row align-items-center flex-row-reverse">
                <div class="col-12 col-lg-4">
                    <div class="image-wrapper bg-dark">
                        <img src="{{asset('/')}}assets/images/logo-dcreartdesign.png">
                    </div>
                </div>
                <div class="col-12 col-lg">
                    <div class="text-box">
                        <h5 class="mbr-title mbr-fonts-style display-2">
                            <strong>{{!empty($kontenAboutUs)?$kontenAboutUs->title:null}}</strong></h5>
                        <div class="mbr-text mbr-fonts-style display-7">{!! !empty($kontenAboutUs)?$kontenAboutUs->content:null !!}</div>
                    
                    </div>
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