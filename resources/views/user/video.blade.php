@extends('user.welcome')

@section('content')

<!-- ##### Breadcumb Area Start ##### -->
<section class="breadcumb-area bg-img bg-overlay" style="background-image: url({{ asset('user/img/bg-img/breadcumb3.jpg') }});">
    <div class="bradcumbContent">
        <p>See what’s new</p>
        <h2>Latest Videos</h2>
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
        <div class="row">
            <!-- Search Bar for Filtering -->
            <div class="col-12 mb-4">
                <input type="text" id="videoSearch" class="form-control" placeholder="Search by video title..." onkeyup="filterVideos()">
            </div>
        </div>
        <div class="row" id="videoList">
            @foreach ($videos as $video)
            <!-- Single Album Area -->
            <div class="col-12 col-sm-6 col-md-4 col-lg-2 video-item">
                <div class="single-album-area wow fadeInUp" data-wow-delay="100ms">
                    <div class="album-thumb">
                        <img class="img-fluid rounded shadow-lg" src="{{ asset('storage/' . $video->music_cover) }}" alt="">
                        <!-- Album Price -->
                        <div class="album-price">
                            <p>$0.90</p>
                        </div>
                        <div class="play-icon">
                            <a href="#" onclick="openMediaModal('{{ url('/stream-audio/' . basename($video->music_file)) }}', '{{ $video->title }}', '{{ $video->year }}', '{{ $video->genre }}', '{{ $video->language }}', '{{ asset('storage/' . $video->music_cover) }}')">
                                <span class="icon-play-button"></span>
                            </a>
                        </div>
                    </div>
                    <div class="album-info">
                        <a href="#">
                            <h5 class="video-title">{{ $video->title }}</h5>
                        </a>
                        <p>{{ $video->genre }}</p>
                        <div class="d-flex align-items-center">
                            <button class="btn btn-sm btn-dark text-warning mt-2" onclick="openReviewModal({{ $video->id }}, 'video')">Reviews</button>
                            <div class="stars ml-2 mt-2">
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                                <i class="fa fa-star text-warning"></i>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<!-- ##### Song Area End ##### -->

<!-- Audio Modal -->
<div class="modal fade" id="audioModal" tabindex="-1" aria-labelledby="audioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal">
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
                    <img src="{{ url('/stream-audio/' . basename($video->music_cover)) }}" id="audioCover" class="img-fluid rounded shadow-lg" style="max-width: 100%; height: auto;" alt="Cover">
                </div>
                <!-- Audio Player -->
                <audio controls id="audioPlayer">
                    <source id="audioSource" src="{{ url('/stream-audio/' . basename($video->music_file)) }}" type="audio/mpeg">
                    Your browser does not support the audio tag.
                </audio>
            </div>
        </div>
    </div>
</div>

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

<!-- Custom Styles -->
<style>
    .modal-backdrop {
        position: unset !important;
    }

    .btn-close {
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

<!-- Review Modal -->
<div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-dark ">
                <h5 class="modal-title text-light">Reviews</h5>
                <div class="stars mt-2 ms-0 ps-0">
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                    <i class="fa fa-star text-warning"></i>
                </div>
                
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
            </div>
            <div class="modal-body">
                <div id="reviewsContainer">
                    <!-- Reviews will be loaded here dynamically -->
                </div>
                @if (Auth::check())
                    <form action="{{ route('reviews.store') }}" method="POST" id="reviewForm">
                        @csrf
                        <input type="hidden" id="contentId" name="content_id" value="{{ $content->id ?? '' }}">
                        <input type="hidden" id="contentType" name="content_type" value="song"> <!-- ya 'video' -->
                        
                        <textarea class="form-control mt-2" name="review_text" placeholder="Write your review here..." required></textarea>
                    
                        <select class="form-control mt-2" name="rating" required>
                            <option value="1">1 Star</option>
                            <option value="2">2 Stars</option>
                            <option value="3">3 Stars</option>
                            <option value="4">4 Stars</option>
                            <option value="5">5 Stars</option>
                        </select>
                    
                        <button type="submit" class="btn btn-warning text-dark mt-3">Submit Review</button>
                    </form>
                @else
                    <p class="text-center">Please <a href="{{ route('login') }}">login</a> to submit a review.</p>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    function openReviewModal(contentId, contentType) {
        document.getElementById('contentId').value = contentId;
        document.getElementById('contentType').value = contentType;
        document.getElementById('reviewsContainer').innerHTML = '<p>Loading reviews...</p>';
        fetch(`/reviews/${contentType}/${contentId}`)
            .then(response => response.json())
            .then(data => {
                let reviewsHtml = '';
                data.forEach(review => {
                    reviewsHtml += `<p><strong>${review.user.name}:</strong> ${review.review_text} - <em>${review.rating} Stars</em></p>`;
                });
                document.getElementById('reviewsContainer').innerHTML = reviewsHtml;
            });
        new bootstrap.Modal(document.getElementById('reviewModal')).show();
    }
</script>

<!-- Filtering Script -->
<script>
    function filterVideos() {
        let input = document.getElementById('videoSearch').value.toLowerCase();
        let videos = document.getElementsByClassName('video-item');

        for (let i = 0; i < videos.length; i++) {
            let title = videos[i].getElementsByClassName('video-title')[0].innerText.toLowerCase();
            if (title.includes(input)) {
                videos[i].style.display = "block";
            } else {
                videos[i].style.display = "none";
            }
        }
    }

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

@endsection