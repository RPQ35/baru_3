@extends('layouts.body')
@section('title', 'running text')
@section('head')
    <style>
        .font {
            font-family: 'Roboto';
            font-style: normal;
            font-weight: 400;
            font-stretch: 100%;
            font-display: swap;
            src: url(https://fonts.gstatic.com/s/roboto/v48/KFO7CnqEu92Fr1ME7kSn66aGLdTylUAMa3iUBGEe.woff2) format('woff2');
            unicode-range: U+0301, U+0400-045F, U+0490-0491, U+04B0-04B1, U+2116;
        }

        /* The main marquee container */
        .marquee-container {
            width: 100%;
            overflow: hidden;
            white-space: nowrap;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            border-radius: 1rem;
        }

        /* The content that will be animated */
        .marquee-content {
            display: inline-block;
            will-change: transform;
            animation: marquee-scroll linear infinite;
        }

        /* Dynamically generated keyframes will be injected here */
        @keyframes marquee-scroll {
            from {
                transform: translateX(100%);
            }

            to {
                transform: translateX(-100%);
            }
        }
    </style>
@endsection
@section('main')

    <main>
        <div class="container-fluid px-4">
            <x-breadcrumb title="Runing Text" breadcrumb="Runinng Text" href="" button="false" />

            {{-- Running text tampil --}}
            @if ($data)
                <x-card size="12" footer="false" bgcolor="bg-white" text="text-black" title="">
                    {{ $data }}
                </x-card>
            @endif
            <button class="btn btn-primary " type="button" funct="OpenModal">
                Edit Running Text
            </button>
            <br>
            <br>
            <br>

            {{-- Panggil component (popup modal) --}}
            <x-NewModal potition="center">
                <form action="{{ route('running_text.store') }}" method="post">
                    @csrf
                    {{-- The marquee content inside the modal --}}

                    <div id="marquee-container" class="relative bg-gray-100 p-4 rounded-xl">
                        <span class="fs-6 bolder" style="capitalize; font-weight: bolder;">preview running </span>
                        <div id="marquee-content-container" class="marquee-container">
                            <span id="marquee-content" class="marquee-content text-xl font-bold text-gray-700 p-2">
                                Start typing to see the text scroll here!
                            </span>
                        </div>
                    </div>
                    <span class="fs-6 bolder" style="capitalize; font-weight: bolder;">Input Text </span>
                    <textarea name="text" id="text-input" class="form-control" rows="3" required onchange="test(this)">{{ $data }}</textarea>

                    <x-slot name="footer">
                        <x-modal-foot-button />
                </form>
                </x-slot>
            </x-NewModal>

        </div>
    </main>


    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const textInput = document.getElementById('text-input');
            const marqueeContainer = document.getElementById('marquee-content-container');
            const marqueeContent = document.getElementById('marquee-content');
            const styleTagId = 'dynamic-marquee-style';

            // Function to update the marquee animation based on text content
            function updateMarquee() {
                const text = textInput.value || "Start typing to see the text scroll here!";

                // Update the content of the single element
                marqueeContent.textContent = text;

                // Get the container's and content's widths
                const containerWidth = marqueeContainer.offsetWidth;
                const contentWidth = marqueeContent.scrollWidth;

                // Define the speed in pixels per second
                const speed = 60;

                // Calculate the duration based on travel distance (content width + container width)
                const duration = (contentWidth + containerWidth) / speed;

                // Find or create the style element for keyframes
                let style = document.getElementById(styleTagId);
                if (!style) {
                    style = document.createElement('style');
                    style.id = styleTagId;
                    document.head.appendChild(style);
                }

                // Generate the CSS for the animation, making it seamless
                style.innerHTML = `
                    @keyframes marquee-scroll {
                        from { transform: translateX(${containerWidth}px); }
                        to { transform: translateX(-${contentWidth}px); }
                    }
                `;

                // Apply the animation and duration
                marqueeContent.style.animation = `marquee-scroll ${duration}s linear infinite`;
            }

            // Listen for user input to update the marquee
            textInput.addEventListener('input', updateMarquee);

            // Run the function initially on page load
            updateMarquee();
        });
    </script>
@endsection