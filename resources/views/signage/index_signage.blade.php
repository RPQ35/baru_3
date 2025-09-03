@extends('signage.signage-body')

{{-- _________________________________________________________________________________________________________________ --}}

{{-- ____________________________ Right side |entertaiment display (video & running text) __________________________ --}}
@section('entertaiment')
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5" style="height: 90vh;">
            <div class="card-body" style="position: relative">
                {{-- =========== video display =================================== --}}
                <video style="max-width: 100%; max-height: 90%;" id="myVideo" src="{{ $video }}" autoplay muted loop>
                </video>
                {{-- ============================================================== --}}
                {{-- =========== running text display ============================= --}}
                <div class="col-xl-12 col-md-6" style=" position: absolute; bottom: 0; left: 0;">
                    <div class="card bg-white text-black mb-4">

                        <div class="card-body marquee-container ">
                            <marquee style="capitalize; font-weight: bolder;">
                                <big class="fs-3">
                                    {{ $text }}
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
