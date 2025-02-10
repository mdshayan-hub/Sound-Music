@extends('user.welcome')

@section('content')

   <!-- ##### Breadcumb Area Start ##### -->
   <section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{asset('user/img/bg-img/breadcumb3.jpg')}});">
    <div class="bradcumbContent">
        <p>See what’s new</p>
        <h2>Latest Songs</h2>
    </div>
</section>
<!-- ##### Breadcumb Area End ##### -->

<!-- ##### Album Catagory Area Start ##### -->
<section class="album-catagory section-padding-100-0">
    <div class="container">


    </div>
</section>
<!-- ##### Album Catagory Area End ##### -->



<!-- ##### Song Area Start ##### -->
<div class="one-music-songs-area mb-70">
    <div class="container">


        <!-- Browse By Letters -->
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

        

        <div class="row songs-container">
            @foreach ($songs as $song)
                @php
                    $firstLetter = strtoupper(substr($song->title, 0, 1));
                    $filterClass = ctype_alpha($firstLetter) ? strtolower($firstLetter) : 'number';
                @endphp

                <!-- Single Song Area -->
                <div class="col-lg-10 col-md-12 col-sm-12 song-item {{ $filterClass }}">
                    <div class="single-song-area mb-30 d-flex flex-wrap align-items-end">
                        <div class="song-thumbnail">
                            <img src="{{ asset('storage/' . $song->music_cover) }}" alt="{{ $song->title }}">
                        </div>
                        <div class="song-play-area">
                            <div class="song-name">
                                <p>{{ $song->title }}</p>
                            </div>
                            <audio preload="auto" controls>
                                <source src="{{ url('/stream-audio/' . basename($song->music_file)) }}" type="audio/mpeg">
                                Your browser does not support the audio element.
                            </audio>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<!-- ##### Song Area End ##### -->

<!-- Filtering Script -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const filters = document.querySelectorAll(".catagory-menu a");
        const songItems = document.querySelectorAll(".song-item");

        filters.forEach(filter => {
            filter.addEventListener("click", function(e) {
                e.preventDefault();
                const filterClass = this.getAttribute("data-filter");

                if (filterClass === "*") {
                    // Agar "Browse All" select kiya to sab dikhaye
                    songItems.forEach(song => song.style.display = "block");
                } else {
                    // Baaki filters ke liye sirf matching songs dikhaye
                    songItems.forEach(song => {
                        if (song.classList.contains(filterClass.substring(1))) {
                            song.style.display = "block";
                        } else {
                            song.style.display = "none";
                        }
                    });
                }
            });
        });
    });
</script>



    
@endsection