<section data-bs-version="5.1" class="slider1 cid-tqwP64ME3k mbr-fullscreen" id="slider1-5">
    <div class="carousel slide" id="tt1WGghIdu" data-ride="carousel" data-bs-ride="carousel" data-interval="4000" data-bs-interval="4000">
        <ol class="carousel-indicators">
            @if($imgSlider->count() < 1)
            <li data-slide-to="0" data-bs-slide-to="0" class="active" data-target="#tt1WGghIdu" data-bs-target="#tt1WGghIdu"></li>
            @endif
            @for($i=0;$i < count($imgSlider); $i++)
            <li data-slide-to="{{$i}}" data-bs-slide-to="{{$i}}" class="active" data-target="#tt1WGghIdu" data-bs-target="#tt1WGghIdu"></li>
            @endfor
            
            
        </ol>
        <div class="carousel-inner">
        @if($imgSlider->count() < 1)
        <div class="carousel-item slider-image item active">
                <div class="item-wrapper">
                    <img class="d-block w-100" src="{{asset('assets/images/no-image.jpg')}}" alt="null" data-slide-to="0" data-bs-slide-to="0">
                    
                    <div class="carousel-caption text-black">
                        <h5 class="mbr-section-subtitle mbr-fonts-style display-5">
                            <strong>Tidak ada gambar</strong></h5>
                            <small class="mbr-section-subtitle mbr-fonts-style display-8">{{env('APP_NAME')}}</small>
                        
                    </div>
                </div>
            </div>
        @endif

        @for($i=0;$i < count($imgSlider); $i++)
            
            <div class="carousel-item slider-image item {{($i==0)?'active':null}}">
                <div class="item-wrapper">
                    <img class="d-block w-100" src="{{($imgSlider[$i]->path != null)?Storage::url($imgSlider[$i]->path):asset('assets/images/no-image.jpg')}}" alt="{{$imgSlider[$i]->title}}" data-slide-to="{{$i+1}}" data-bs-slide-to="{{$i+1}}">
                    
                    <div class="carousel-caption">
                        <h5 class="mbr-section-subtitle mbr-fonts-style display-5">
                            <strong>{{$imgSlider[$i]->title}}</strong></h5>
                            <small class="mbr-section-subtitle mbr-fonts-style display-8">{{env('APP_NAME')}}</small>
                        
                    </div>
                </div>
            </div>
        
        @endfor
        </div>
        <a class="carousel-control carousel-control-prev" role="button" data-slide="prev" data-bs-slide="prev" href="#tt1WGghIdu">
            <span class="mobi-mbri mobi-mbri-arrow-prev" aria-hidden="true"></span>
            <span class="sr-only visually-hidden">Previous</span>
        </a>
        <a class="carousel-control carousel-control-next" role="button" data-slide="next" data-bs-slide="next" href="#tt1WGghIdu">
            <span class="mobi-mbri mobi-mbri-arrow-next" aria-hidden="true"></span>
            <span class="sr-only visually-hidden">Next</span>
        </a>
    </div>
</section>