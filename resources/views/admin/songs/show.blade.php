@extends('admin.layout')

@section('content')
<div class="container mt-2">
    <div class="card shadow-lg border-0">
        <!-- Card Header with Song Details -->
        <div class="card-header bg-dark text-white">
            <div class="d-flex justify-content-between align-items-start">
                <div>
                    <h2 class="mb-0 text-light">{{ $song->title }}</h2>
                    <p class="mb-0 mt-2">
                        <strong>Album:</strong> {{ $song->album_title ?? 'No Album' }} |
                        <strong>Year:</strong> {{ $song->year }} |
                        <strong>Genre:</strong> {{ $song->genre }} |
                        <strong>Language:</strong> {{ $song->language }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Card Body with Media Container -->
        <div class="row justify-content-center align-items-center">
            <div class="col-lg-8 d-flex justify-content-center align-items-center">
                <div class="card-body w-100">
                    <div class="media-container d-flex flex-column justify-content-center align-items-center text-center p-3 bg-light rounded shadow-sm">
                        @if(Str::endsWith($song->music_file,'.mp4'))
                            <!-- Video Player -->
                            <video width="100%" controls  class="rounded border">
                                <source src="{{ url('/stream-audio/' . basename($song->music_file)) }}" type="video/mp4">
                                Your browser does not support the video element.
                            </video>
                        @else
                            <!-- Audio Player with Cover Image -->
                            <img src="{{ asset('storage/' . $song->music_cover) }}" class="w-75 rounded mb-3" height="40%"  alt="Cover">
            
                            @if(Str::endsWith($song->music_file,'.mp3'))
                            <audio controls preload="metadata" class="w-100 rounded shadow-lg">
                                <source src="{{ url('/stream-audio/' . basename($song->music_file)) }}" type="audio/mpeg">
                                    Your browser does not support the audio tag.
                            </audio>
                            
                            @else
                                <p class="text-danger mt-3">Invalid file type.</p>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function () {
                let audio = document.querySelector("audio");
                let video = document.querySelector("video");
            
                if (audio) {
                    audio.addEventListener("loadedmetadata", function () {
                        console.log("Audio Duration: " + audio.duration);
                    });
            
                    audio.addEventListener("timeupdate", function () {
                        console.log("Current Time: " + audio.currentTime);
                    });
            
                    audio.addEventListener("ended", function () {
                        console.log("Audio Ended");
                    });
                }
            
                if (video) {
                    video.addEventListener("loadedmetadata", function () {
                        console.log("Video Duration: " + video.duration);
                    });
            
                    video.addEventListener("timeupdate", function () {
                        console.log("Current Time: " + video.currentTime);
                    });
            
                    video.addEventListener("ended", function () {
                        console.log("Video Ended");
                    });
                }
            });
            </script>
            

        <!-- Card Footer -->
        <div class="card-footer bg-dark text-center text-white py-3">
            <p class="mb-0">Enjoy listening and watching your favorite music and videos!</p>
        </div>
    </div>
</div>  
@endsection
