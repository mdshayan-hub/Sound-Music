@extends('user.welcome')

@section('content')

    <!-- ##### Hero Area Start ##### -->
    <section class="hero-area">
        <div class="hero-slides owl-carousel">
            <!-- Single Hero Slide -->
            <div class="single-hero-slide d-flex align-items-center justify-content-center">
                <!-- Slide Img -->
                <div class="slide-img bg-img" style="background-image: url({{asset('user/img/bg-img/bg-1.jpg')}});"></div>
                <!-- Slide Content -->
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-slides-content text-center">
                                <h6 data-animation="fadeInUp" data-delay="100ms">Latest album</h6>
                                <h2 data-animation="fadeInUp" data-delay="300ms">Beyond Time <span>Beyond Time</span></h2>
                                <a data-animation="fadeInUp" data-delay="500ms" href="/album" class="btn oneMusic-btn mt-50">Discover <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Single Hero Slide -->
            <div class="single-hero-slide d-flex align-items-center justify-content-center">
                <!-- Slide Img -->
                <div class="slide-img bg-img" style="background-image: url({{asset('user/img/bg-img/bg-2.jpg')}});"></div>
                <!-- Slide Content -->
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <div class="hero-slides-content text-center">
                                <h6 data-animation="fadeInUp" data-delay="100ms">Latest album</h6>
                                <h2 data-animation="fadeInUp" data-delay="300ms">Colorlib Music <span>Colorlib Music</span></h2>
                                <a data-animation="fadeInUp" data-delay="500ms" href="#" class="btn oneMusic-btn mt-50">Discover <i class="fa fa-angle-double-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Hero Area End ##### -->

    <!-- ##### Latest Albums Area Start ##### -->
    <section class="latest-albums-area section-padding-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading style-2">
                        <p>See what’s new</p>
                        <h2>Latest Albums</h2>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-lg-9">
                    <div class="ablums-text text-center mb-70">
                        <p>Nam tristique ex vel magna tincidunt, ut porta nisl finibus. Vivamus eu dolor eu quam varius rutrum. Fusce nec justo id sem aliquam fringilla nec non lacus. Suspendisse eget lobortis nisi, ac cursus odio. Vivamus nibh velit, rutrum at ipsum ac, dignissim iaculis ante. Donec in velit non elit pulvinar pellentesque et non eros.</p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <div class="albums-slideshow owl-carousel">


                        @foreach ($albumsid as $alb)
                        
                        <!-- Single Album -->
                        <div class="single-album">
                            <img src="{{asset('storage/'.$alb->album_cover)}}" alt="">
                            <div class="album-info">
                                <a href="#">
                                    <h5>{{$alb->title}}</h5>
                                </a>
                                {{-- <p>{{$alb->description}}</p> --}}
                            </div>
                        </div>
                            
                        @endforeach


                        

 
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Latest Albums Area End ##### -->

    <!-- ##### Buy Now Area Start ##### -->
    <section class="oneMusic-buy-now-area has-fluid bg-gray section-padding-100">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="section-heading style-2">
                        <p>See what’s new</p>
                        <h2>Buy What’s New</h2>
                    </div>
                </div>
            </div>

            <div class="row">

                @foreach ($videos12 as $video12)
                <!-- Single Album Area -->
                <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                    <div class="single-album-area wow fadeInUp" data-wow-delay="100ms">
                        <div class="album-thumb">
                            <img src="{{ asset('storage/' . $video12->music_cover) }}" alt="">
                            <!-- Album Price -->
                            <div class="album-price">
                                <p>$0.90</p>
                            </div>
                            @if (Auth::check())
                            <!-- Play Icon -->
                            <div class="play-icon">
                                <a href="#" onclick="openMediaModal('{{ url('/stream-audio/' . basename($video12->music_file)) }}', '{{ $video12->title }}', '{{ $video12->year }}', '{{ $video12->genre }}', '{{ $video12->language }}', '{{ asset('storage/' . $video12->music_cover) }}')">
                                    <span class="icon-play-button"></span>
                                </a>
                            </div>
                            @else    
                    <!-- Play Icon -->
                        <div class="play-icon">
                         <a href="/login" >
                        <span class="icon-play-button"></span>
                         </a>
                        </div>
                            @endif
                        </div>
                        <div class="album-info">
                            <a href="#">
                                <h5>{{ $video12->title }}</h5>
                            </a>
                            <p>{{ $video12->genre }}</p>
                        </div>
                    </div>
                </div>
                @endforeach
                


<!-- Audio Modal -->
<div class="modal fade" id="audioModal" tabindex="-1" aria-labelledby="audioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h5 class="modal-title text-light" id="audioTitle">Now Playing</h5>
                        <p class="mb-0 text-light">
                            <strong id="audioYear">Year:</strong>
                            <strong id="audioGenre">Genre:</strong>
                            <strong id="audioLanguage">Language:</strong>
                        </p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body text-center">
                <!-- Song Cover Image -->
                <div class="d-flex justify-content-center">
                    <img src="{{ url('/stream-audio/' . basename($video12->music_cover)) }}" id="audioCover" class="img-fluid rounded shadow-lg" style="max-width: 60%; height: auto;" alt="Cover">
                </div>
                <!-- Audio Player -->
                <audio controls id="audioPlayer">
                    <source id="audioSource" src="{{ url('/stream-audio/' . basename($video12->music_file)) }}" type="audio/mpeg">
                    Your browser does not support the audio tag.
                </audio>
            </div>
        </div>
    </div>
</div>
    
        </div>
      </div>
    
      
      <!-- Video Modal (Full Screen) -->
<!-- Video Modal -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <div class="d-flex justify-content-between align-items-start">
                    <div>
                        <h6 class="modal-title text-light" id="videoTitle">Video Player |</h6>
                        <p class="mb-0 mt-2 text-light">
                            <strong id="videoYear">Year:</strong>
                            <strong id="videoGenre">Genre:</strong>
                            <strong id="videoLanguage">Language:</strong>
                        </p>
                    </div>
                </div>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body text-center p-3">
                <video controls id="videoPlayer" style="width: 100%;">
                    <source id="videoSource" src="" type="video/mp4">
                    Your browser does not support the video element.
                </video>
            </div>
        </div>
    </div>
</div>
  

  <!-- Modal CSS -->
 
<style>
.modal-backdrop {
    position: unset !important;
}

.btn-close{
    font-size: 20px;
    width: 30px;
    height: 30px;
    background: black;
    color: white;
    
}

.modal-dialog-centered.modal-content {
    background-color: rgba(0, 0, 0, 0.9);
}
</style>

<!-- Modal JS -->
  <script>
    function openMediaModal(filePath, title, year, genre, language, coverPath) {
        if (filePath.endsWith('.mp3')) {
            document.getElementById('audioTitle').innerText = title;
            document.getElementById('audioSource').src = filePath;
            document.getElementById('audioPlayer').load();  // Ensure the new source loads
            document.getElementById('audioCover').src = coverPath;
            document.getElementById('audioYear').innerText = "Year: " + year;
            document.getElementById('audioGenre').innerText = "Genre: " + genre;
            document.getElementById('audioLanguage').innerText = "Language: " + language;

            // Show Audio Modal
            new bootstrap.Modal(document.getElementById('audioModal')).show();
        } else if (filePath.endsWith('.mp4')) {
            document.getElementById('videoTitle').innerText = title;
            document.getElementById('videoSource').src = filePath;
            document.getElementById('videoPlayer').load();  // Ensure the new source loads
            document.getElementById('videoYear').innerText = "Year: " + year;
            document.getElementById('videoGenre').innerText = "Genre: " + genre;
            document.getElementById('videoLanguage').innerText = "Language: " + language;

            // Show Video Modal
            new bootstrap.Modal(document.getElementById('videoModal')).show();
        }
    }
</script>
  
  
                





            </div>


            @if (Auth::check())
            <div class="row">
                <div class="col-12">
                    <div class="load-more-btn text-center wow fadeInUp" data-wow-delay="300ms">
                        <a href="/user/video" class="btn oneMusic-btn">Load More <i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
            @else 
            <div class="row">
                <div class="col-12">
                    <div class="load-more-btn text-center wow fadeInUp" data-wow-delay="300ms">
                        <a href="/login" class="btn oneMusic-btn">Load More <i class="fa fa-angle-double-right"></i></a>
                    </div>
                </div>
            </div>
            @endif 



        </div>
    </section>
    <!-- ##### Buy Now Area End ##### -->

    <!-- ##### Featured Artist Area Start ##### -->
    <section class="featured-artist-area section-padding-100 bg-img bg-overlay bg-fixed" style="background-image: url({{asset('user/img/bg-img/bg-4.jpg')}});">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-12 col-md-5 col-lg-4">
                    <div class="featured-artist-thumb">
                        <img src="{{asset('storage/'. $songs[0]->music_cover)}}" alt="">
                    </div>
                </div>
                <div class="col-12 col-md-7 col-lg-8">
                    <div class="featured-artist-content">
                        <!-- Section Heading -->
                        <div class="section-heading white text-left mb-30">
                            <p>See what’s new</p>
                            <h2>{{$songs[0]->title}}</h2>
                        </div>
                        <p>{{$songs[0]->music_type}}</p>
                        <div class="song-play-area">
                            <div class="song-name">
                                <p>{{$songs[0]->title}}</p>
                            </div>
                            <audio preload="auto" controls>
                                <source src="{{ url('/stream-audio/' . basename($songs[0]->music_file)) }}">
                                   
                            </audio>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Featured Artist Area End ##### -->

    <!-- ##### Miscellaneous Area Start ##### -->
    <section class="miscellaneous-area section-padding-100-0">
        <div class="container">
            <div class="row">
                <!-- ***** Weeks Top ***** -->
                <div class="col-12 col-lg-4">
                    <div class="weeks-top-area mb-100">
                        <div class="section-heading text-left mb-50 wow fadeInUp" data-wow-delay="50ms">
                            <p>See what’s new</p>
                            <h2>Latest Albums's</h2>
                        </div>

                        @foreach ($albums6 as $alb6)
                        <!-- Single Top Item -->
                        <div class="single-top-item d-flex wow fadeInUp" data-wow-delay="100ms">
                            <div class="thumbnail">
                                <img src="{{asset('storage/'. $alb6->album_cover)}}" alt="">
                            </div>
                            <div class="content-">
                                <h6>{{ $alb6->title }}</h6>
                                <p>{{$alb6->name}}</p>
                            </div>
                        </div>
                            
                        @endforeach


                        

                    </div>
                </div>

                <!-- ***** New Hits Songs ***** -->
                <div class="col-12 col-lg-4">
                    <div class="new-hits-area mb-100">
                        <div class="section-heading text-left mb-50 wow fadeInUp" data-wow-delay="50ms">
                            <p>See what’s new</p>
                            <h2>New Hits</h2>
                        </div>
                        @foreach ($songs6 as $song6)
                        
                        <!-- Single Top Item -->
                        <div class="single-new-item d-flex align-items-center justify-content-between wow fadeInUp" data-wow-delay="100ms">
                            <div class="first-part d-flex align-items-center">
                                <div class="thumbnail">
                                    <img src="{{asset('storage/'.$song6->music_cover)}}" alt="">
                                </div>
                                <div class="content-">
                                    <h6>{{$song6->title}}</h6>
                                    <p>{{$song6->year}}</p>
                                </div>
                            </div>
                            <audio preload="auto" controls>
                                <source src="{{asset('storage/' . $song6->music_file)}}">
                            </audio>
                        </div>
                            
                        @endforeach


                    </div>
                </div>

                <!-- ***** Popular Artists ***** -->
                <div class="col-12 col-lg-4">
                    <div class="popular-artists-area mb-100">
                        <div class="section-heading text-left mb-50 wow fadeInUp" data-wow-delay="50ms">
                            <p>See what’s new</p>
                            <h2>Popular Artist</h2>
                        </div>

                        @foreach ($artists6 as $artist6)
                        <!-- Single Artist -->
                        <div class="single-artists d-flex align-items-center wow fadeInUp" data-wow-delay="100ms">
                            <div class="thumbnail">
                                <img src="{{asset('storage/'.$artist6->image)}}" alt="">
                            </div>
                            <div class="content-">
                                <p>{{$artist6->name}}</p>
                            </div>
                        </div>
                            
                        @endforeach




                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ##### Miscellaneous Area End ##### -->

    
@endsection