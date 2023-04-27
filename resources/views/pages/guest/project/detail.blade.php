@extends('layouts.guest.master')
@section('title', $project->title.' - Project')
@section('style')

@endsection
@section('content')
@include('layouts.guest.header.page')
<section data-bs-version="5.1" class="image1 cid-tt1ywtgYVu" id="image1-1n">
    

    
    

    <div class="container-fluid">
        <div class="row align-items-center">
            <div class="col-12 col-lg-12">
                <div class="pt-4 pb-4">
                    <h3 class="mbr-section-title mbr-fonts-style display-5 mb-0"><strong>{{$project->title}}</strong></h3>
                    @foreach($project->detail_projects as $dp)
                    <span class="badge bg-dark">{{ $dp->category->name }}</span>
                    @endforeach
                </div>
                <div class="image-wrapper">
                <section data-bs-version="5.1" class="slider1 cid-tqwP64ME3k hide-xs" id="slider1-5">
        
                    <div class="carousel slide carousel-fade" id="tqx4GzN3Fn" data-ride="carousel" data-bs-ride="carousel" data-interval="5000" data-bs-interval="5000">
                        <ol class="carousel-indicators">
                        @for($i = 0; $i < count($project->project_sliders);$i++)
                            <li data-slide-to="{{$i}}" data-bs-slide-to="{{$i}}" class="active" data-target="#tqx4GzN3Fn" data-bs-target="#tqx4GzN3Fn"></li>
                        @endfor
                            
                            
                        </ol>
                        <div class="carousel-inner">
                            @for($i = 0; $i < count($project->project_sliders);$i++)
                            <div class="carousel-item slider-image item {{($i==0)?'active':null}}">
                                <div class="item-wrapper">
                                    <img class="img-responsive" src="{{Storage::url($project->project_sliders[$i]->img_slider->path)}}" alt="slide-{{$i}}" data-slide-to="{{$i+1}}" data-bs-slide-to="{{$i+1}}" >
                                    
                                    <div class="carousel-caption bg-dark" style="opacity: 0.5;">
                                        <h5 class="mbr-section-subtitle mbr-fonts-style display-5">
                                            <strong>{{$project->project_sliders[$i]->img_slider->title}}</strong><br>
                                            <small class="display-9">{{env('APP_NAME')}}</small><br>
                                        <a href="{{Storage::url($project->project_sliders[$i]->img_slider->path)}}" target="_blank" class="btn btn-light">Lihat</a>
                                        </h5>
                                        
                                        
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                        <a class="carousel-control carousel-control-prev" role="button" data-slide="prev" data-bs-slide="prev" href="#tqx4GzN3Fn">
                            <span class="mobi-mbri mobi-mbri-arrow-prev" aria-hidden="true"></span>
                            <span class="sr-only visually-hidden">Previous</span>
                        </a>
                        <a class="carousel-control carousel-control-next" role="button" data-slide="next" data-bs-slide="next" href="#tqx4GzN3Fn">
                            <span class="mobi-mbri mobi-mbri-arrow-next" aria-hidden="true"></span>
                            <span class="sr-only visually-hidden">Next</span>
                        </a>
                    </div>
                </section>
                </div>
            </div>
            <div class="col-12 col-lg-12">
                <div class="pt-4 pb-4">
                    {!!$project->description!!}
                </div>
            </div>
        </div>
    </div>
</section>

<section data-bs-version="5.1" class="slider6 mbr-embla cid-tqx3fnQhkN" id="slider6-15">
    
    
    <div class="container-fluid">
        <div class="mbr-section-head">
            <h4 class="mbr-section-title mbr-fonts-style align-center mb-0 display-2"><strong>Latest projects</strong></h4>
            <h5 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-2 display-5">Read the latest projects</h5>
        </div>
        <div class="row mbr-gallery mt-4">
            @foreach($latestprojects as $project)
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-6 mt-3">
                <div class="card bg-dark text-light">
                    <div class="card-body">
                        <div class="item-wrapper">
                        <img class="w-100" src="{{($project->path_thumbnail != null)?Storage::url($project->path_thumbnail):Storage::url($project->project_sliders[0]->img_slider->path)}}" alt="">
                    </div>
                    </div>
                    <div class="card-footer">
                        <div class="align-left">
                        @foreach($project->detail_projects as $dp)
                                <a href="{{$dp->category->name}}" target="_blank">
                                    <span class="badge bg-light text-dark">{{$dp->category->name}}</span>
                                </a>
                         @endforeach
                        <h5 class="text-left mt-3">{{ $project->title }}</h5>
                        </div>
                        <div class="align-center">
                            
                            <a href="{{ route('guest.project.detail', $project->slug) }}" class="btn item-btn btn-white-outline btn-block">Lihat Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if($latestprojects->hasPages())
            <div class="btn-group pull-left">
                <div class="btn btn-default">
                <a href="{{$latestprojects->onFirstPage()?'#onFirstPage':$latestprojects->previousPageUrl()}}" class="btn {{$latestprojects->onFirstPage()?'btn-light':'btn-dark'}} text-bold"><i class="mbri-arrow-prev"></i> Previous</a>
                <a href="{{($latestprojects->currentPage() == $latestprojects->lastPage())?'#onLastPage':$latestprojects->nextPageUrl()}}" class="btn {{($latestprojects->currentPage() == $latestprojects->lastPage())?'btn-light':'btn-dark'}}">Next <i class="mbri-arrow-next"></i></a>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
@section('script')
@endsection