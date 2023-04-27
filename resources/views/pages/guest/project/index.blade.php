@extends('layouts.guest.master')
@section('title', 'Projects')
@section('style')

@endsection
@section('content')
@include('layouts.guest.header.page')
<section data-bs-version="5.1" class="gallery5 mbr-gallery cid-tqxpklgh9E" id="gallery5-16">
    

    
    <div class="mbr-overlay" style="opacity: 0.8; background-color: rgb(250, 250, 250);">
    </div>

    <div class="container">
        <div class="mbr-section-head">
            <h3 class="mbr-section-title mbr-fonts-style align-center m-0 display-2"><strong>Our Projects</strong></h3>
            <h4 class="mbr-section-subtitle mbr-fonts-style align-center mb-0 mt-2 display-5">See Our Projects</h4>
        </div>
        <div class="row mbr-gallery mt-4">
            @foreach($projects as $project)
            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 mt-3">
                <div class="card bg-dark text-light">
                    <div class="card-body">
                        <div class="item-wrapper">
                            <a href="{{ route('guest.project.detail', $project->slug) }}"><img class="w-100" src="{{($project->path_thumbnail != null)?Storage::url($project->path_thumbnail):Storage::url($project->project_sliders[0]->img_slider->path)}}" alt=""></a>
                        
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
                            
                            <a href="{{ route('guest.project.detail', $project->slug) }}" class="btn item-btn btn-white-outline btn-xs"><small>Lihat Selengkapnya</small></a>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            @if($projects->hasPages())
            <div class="btn-group pull-left">
                <div class="btn btn-default">
                <a href="{{$projects->onFirstPage()?'#onFirstPage':$projects->previousPageUrl()}}" class="btn {{$projects->onFirstPage()?'btn-light':'btn-dark'}} text-bold"><i class="mbri-arrow-prev"></i> Previous</a>
                <a href="{{($projects->currentPage() == $projects->lastPage())?'#onLastPage':$projects->nextPageUrl()}}" class="btn {{($projects->currentPage() == $projects->lastPage())?'btn-light':'btn-dark'}}">Next <i class="mbri-arrow-next"></i></a>
                </div>
            </div>
            @endif
        </div>
    </div>
</section>
@endsection
@section('script')
@endsection