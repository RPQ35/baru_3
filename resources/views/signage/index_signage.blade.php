@extends('signage.signage-body')

{{-- _________________________________________________________________________________________________________________ --}}

{{-- ____________________________ Right side |entertaiment display (video & running text) __________________________ --}}
@section('entertaiment')
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5" style="height: 90vh;">
            <div class="card-body" style="position: relative">
                {{-- =========== video display =================================== --}}
                <video style="max-width: 100%; max-height: 90%;" id="myVideo" muted>
                </video>
                {{-- ============================================================== --}}
                {{-- =========== running text display ============================= --}}
                <div class="col-xl-12 col-md-6" style=" position: absolute; bottom: 0; left: 0;">
                    <div class="card bg-white text-black mb-4">

                        <div class="card-body marquee-container ">
                            <marquee style="capitalize; font-weight: bolder;">
                                <big class="fs-3">
                                    @forelse ($text as $item)
                                        {{ $item }}
                                    @empty
                                        welcome
                                    @endforelse
                                </big>
                            </marquee>
                        </div>


                        <div class="card-footer d-flex align-items-center justify-content-between">
                        </div>
                    </div>
                </div>
                {{-- ============================================================== --}}
            </div>
        </div>
    </div>


    <script>//video auto display and loop
        // Array of video sources
        const videoPlaylist = @json($video);

        const videoPlayer = document.getElementById('myVideo'); // Get the video element
        let currentVideoIndex = 0; // Track the current video index

        function playNextVideo() { // Function to play the next video in the playlist
            if (currentVideoIndex >= videoPlaylist.length) { // Check if reached the end of the playlist
                // Reset to the beginning to create the loop
                currentVideoIndex = 0;
            }

            videoPlayer.src = videoPlaylist[currentVideoIndex]; // Set the new video source

            // Play the video
            videoPlayer.play();

            // Move to the next video for the next time the function is called
            currentVideoIndex++;
        }

        // Add an event listener to the video player
        videoPlayer.addEventListener('ended', playNextVideo);
        playNextVideo(); // Start the playlist by playing the first video
    </script>
@endsection
{{-- _________________________________________________________________________________________________________________ --}}
