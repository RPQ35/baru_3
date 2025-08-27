
        const video = document.getElementById('myVideo');
        window.addEventListener('DOMContentLoaded', () => {
            video.muted = false;
            video.addEventListener('loadedmetadata', () => {
                const savedTime = localStorage.getItem('videoTime');
                console.log(savedTime);
                if (savedTime) {
                    video.currentTime = parseFloat(savedTime);
                    console.log(video.currentTime);
                    setTimeout(() => {
                        if (video.currentTime == savedTime) {
                            video.currentTime = parseFloat(0);
                            video.play();
                        }
                    }, 2000);
                }
                video.play().then(() => {}).catch(error => {
                    console.error('Autoplay failed:', error);
                });
            });
            window.addEventListener('beforeunload', () => {
                localStorage.setItem('videoTime', video.currentTime);
            });
        });


        let marquee = document.getElementById('marquee-text');
        let parentWidth = marquee.parentElement.offsetWidth;
        let position = parseFloat(localStorage.getItem('marqueePos')) || parentWidth;

        function scrollText() {
            position -= 1;
            marquee.style.transform = `translateX(${position}px)`;
            if (position < -marquee.offsetWidth) {
                position = parentWidth;
            }
            localStorage.setItem('marqueePos', position);
            requestAnimationFrame(scrollText);
        }
        scrollText();
