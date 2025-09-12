function video_temp(obj) {
    document.getElementById('subm').disabled =true;
    const file = obj.files[0];
    const formData = new FormData();
    const parrents = obj.parentNode;
    formData.append('video', file);

    fetch('/admin/video/upload', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            // console.log(data.path);
            document.getElementById('subm').disabled = false;

            if (document.querySelector('.w-100[child="true"]')) {
                document.querySelector('.w-100[child="true"]').src = data.path;
            } else {
                var videos = document.createElement('video');
                videos.className = "w-100 w-xl-75";
                videos.src = data.path;
                videos.controls = true;
                videos.setAttribute('child', 'true');

                parrents.appendChild(videos);
            }
        })
        .catch(error => console.error('Error:', error));
}