@php
$firstImgSlider = \App\Models\SettingsTampilanHeaderHomepage::first();
@endphp
<section data-bs-version="5.1" class="header6 cid-tqwUfuWq4L mbr-parallax-background" style="background-image: url('{{!empty($firstImgSlider)?Storage::url($firstImgSlider->path):asset('assets/images/no-image.jpg')}}" id="header6-d">

    

    
    <div class="mbr-overlay" style="opacity: 0.2; background-color: rgb(35, 35, 35);"></div>

    <div class="align-center container">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-10">
                <h1 class="mbr-section-title mbr-fonts-style mbr-white mb-3 display-2"><strong>@yield('title')</strong></h1>
                
                <p class="mbr-text mbr-white mbr-fonts-style display-7">{{env('APP_NAME')}}</p>
                
            </div>
        </div>
    </div>
</section>