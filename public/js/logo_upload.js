
function logo_temp(obj) {
    const file = obj.files[0];
    const formData = new FormData();
    const parrents = document.getElementById('parrents');
    formData.append('logo', file);

    fetch('/admin/services/logo', {
            method: 'POST',
            body: formData,
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            }
        })
        .then(response => response.json())
        .then(data => {
            if (document.querySelector('.childer[child="true"]')) {
                document.querySelector('.childer[child="true"]').src = data.url;
            } else {
                var images = document.createElement('img');
                images.style = "max-height:100px;";
                images.className = 'childer';
                images.src = data.url;
                images.setAttribute('child', true);

                parrents.appendChild(images);
            }
        })
        .catch(error => console.error('Error:', error));
};


