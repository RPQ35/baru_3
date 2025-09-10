
        

        // Tutup success modal
        function closeSuccess() {
            const modal = document.getElementById('successModal');
            modal.style.display = "none";
            window.location.href='/kiosk';
        }
    <script src="{{asset('js/keyboard.js')}}"></script>
    // Tutup success modal
    function closeSuccess() {
        const modal = document.getElementById('successModal');
        modal.style.display = "none";
        location.reload(); // langsung refresh kalau klik OK
    }

    // Kalau ada success modal, set auto refresh
    const successModal = document.getElementById('successModal');
    if (successModal) {
        let counter = 5; // detik
        const countdown = document.getElementById('countdown');
        const interval = setInterval(() => {
            counter--;
            countdown.textContent = counter;
            if (counter <= 0) {
                clearInterval(interval);
                location.reload(); // refresh halaman
            }
        }, 1000);
    }
    document.addEventListener("DOMContentLoaded", function() {
    const form = document.querySelector('#inputModal form');
    const input = document.getElementById('vehicleInput');

    form.addEventListener('submit', function(e) {
        const value = input.value.trim();

        // Cek kosong
        if (!value) {
            e.preventDefault();
            alert("Nomor kendaraan wajib diisi!");
            return;
        }

        // Cek tag HTML/script
        if (/[<>]/.test(value)) {
        e.preventDefault();
        alert("Nomor kendaraan tidak boleh tag html maupun script");
        return;
    }


        // Cek link / URL
        if (/https?:\/\//i.test(value)) {
            e.preventDefault();
            alert("Nomor kendaraan tidak boleh berupa link/URL!");
            return;
             }
    });
});
