@extends('user.welcome')

@section('content')

   <!-- ##### Breadcumb Area Start ##### -->
   <section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{asset('user/img/bg-img/breadcumb3.jpg')}});">
    <div class="bradcumbContent">
        <p>See what’s new</p>
        <h2>Latest Albums</h2>
    </div>
</section>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Album Catagory Area Start ##### -->
<!-- ##### Album Catagory Area Start ##### -->
<section class="album-catagory section-padding-100-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="browse-by-catagories catagory-menu d-flex flex-wrap align-items-center mb-70">
                    <a href="#" data-filter="*">Browse All</a>
                    @foreach(range('A', 'Z') as $letter)
                        <a href="#" data-filter=".{{ strtolower($letter) }}">{{ $letter }}</a>
                    @endforeach
                    <a href="#" data-filter=".number">0-9</a>
                </div>
            </div>
        </div>

        <div class="row oneMusic-albums">
            @foreach ($albums as $album)
            <div class="col-12 col-sm-4 col-md-3 col-lg-2 single-album-item {{ strtolower(substr($album->title, 0, 1)) }}">
                <div class="single-album">
                    <img src="{{ asset('storage/' . $album->album_cover) }}" alt="{{ $album->title }}">
                    <div class="album-info">
                        <a href="#">
                            <h5>{{ $album->title }}</h5>
                        </a>
                        <p>{{ $album->name }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- ##### Album Catagory Area End ##### -->

<!-- ##### Album Catagory Area End ##### -->



<!-- ##### Buy Now Area Start ##### -->
<div class="oneMusic-buy-now-area mb-100">
    <div class="container">
        <div class="row">


            @foreach ($albums4 as $album4)
            <!-- Single Album Area -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="single-album-area">
                    <div class="album-thumb">
                        <img src="{{asset('storage/'.$album4->album_cover)}}" alt="">
                    </div>
                    <div class="album-info">
                        <a href="#">
                            <h5>{{$album4->name}}</h5>
                        </a>
                        <p>Buble Gum</p>
                    </div>
                </div>
            </div>

            @endforeach

        </div>

        <div class="row">
            <div class="col-12">
                <div class="load-more-btn text-center">
                    <a href="#" class="btn oneMusic-btn">Load More <i class="fa fa-angle-double-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ##### Buy Now Area End ##### -->

<!-- ##### Add Area Start ##### -->



<!-- ##### Song Area Start ##### -->
<div class="one-music-songs-area mb-70">
    <div class="container">
        <div class="row">

            @foreach ($songs4 as $song4)
                            <!-- Single Song Area -->
            <div class="col-12">
                <div class="single-song-area mb-30 d-flex flex-wrap align-items-end">
                    <div class="song-thumbnail">
                        <img src="{{asset('storage/'. $song4->music_cover)}}" alt="">
                    </div>
                    <div class="song-play-area">
                        <div class="song-name">
                            <p>{{$song4->title}}</p>
                        </div>
                        <audio preload="auto" controls>
                            <source src="{{ url('/stream-audio/' . basename($song4->music_file)) }}">
                        </audio>
                    </div>
                </div>
            </div>
            @endforeach



        </div>
    </div>
</div>
<!-- ##### Song Area End ##### -->

    
@endsection