//  ================================================================
//  ========= video autoplayer & set play on last played ===========

const video = document.getElementById('myVideo');
window.addEventListener('DOMContentLoaded', () => {
    video.muted = false;    //mute option for unsuport autoplay
    video.addEventListener('loadedmetadata', () => {
        // start video from saved times
        const savedTime = localStorage.getItem('videoTime');
        if (savedTime) {
            video.currentTime = parseFloat(savedTime);
            setTimeout(() => {
                // check if the video ended
                if (video.currentTime == savedTime) {
                    video.currentTime = parseFloat(0);
                    video.play();
                }
            }, 2000);
        }
        // play video
        video.play().then(() => {}).catch(error => {
            console.error('Autoplay failed:', error);
        });
    });
    // save stoped times from  played video
    window.addEventListener('beforeunload', () => {
        localStorage.setItem('videoTime', video.currentTime);
    });
});


//  ================================================================
//  ========= running text scroller & set start on last stop ========
let marquee = document.getElementById('marquee-text');
let parentWidth = marquee.parentElement.offsetWidth;

let position = parseFloat(localStorage.getItem('marqueePos')) || parentWidth;

function scrollText() {
    position -= 1;
    marquee.style.transform = `translateX(${position}px)`;
    // set position from the last stopped
    if (position < -marquee.offsetWidth) {
        position = parentWidth;
    }
    // save stopped position
    localStorage.setItem('marqueePos', position);
    requestAnimationFrame(scrollText);
}
scrollText();
