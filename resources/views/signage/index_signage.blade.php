@extends('signage.signage-body')

{{-- _________________________________________________________________________________________________________________ --}}

{{-- ____________________________ Right side |entertaiment display (video & running text) __________________________ --}}
@section('entertaiment')
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5" style="height: 90vh;">
            <div class="card-body">
                {{-- =========== video display =================================== --}}
                <video style="max-width: 100%; max-height: 90%;" id="myVideo" src="{{ $video }}" autoplay muted loop>
                </video>
                {{-- ============================================================== --}}
                {{-- =========== running text display ============================= --}}
                <div class="col-xl-12 col-md-2">
                    <div class="card bg-white text-black mb-4">

                        <div class="card-body marquee-container">
                            {{-- <big id="marquee-text" style="text-transform: capitalize; font-weight: bolder;">
                                {{ $text }}
                            </big> --}}
                            <marquee style="capitalize; font-weight: bolder;">
                                <big>
                                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Culpa dignissimos, sapiente
                                    distinctio quidem est ducimus minima unde neque qui, amet exercitationem. Quaerat soluta
                                    expedita tenetur, dolore vitae illum fugit quo!
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
@endsection
{{-- _________________________________________________________________________________________________________________ --}}
