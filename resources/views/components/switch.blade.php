@props([
    'name' => 'tes',
    'condition' => 1,
])
<div class="d-flex flex-column">
    <div class="">
        <label class="switch">
            <input type="checkbox" funct="switch{{ $name }}" name="{{ $name }}" {{ $attributes }}
                {{ $condition ? 'checked' : '' }}>
            <span class="slider"></span>
        </label>
    </div>

    <p name="{{ $name }}" class="{{ $condition ? 'text-success' : '' }}">
        {{ $condition ? 'Status: On' : 'Status: Off' }}
    </p>
</div>



@php
   echo '<script>
    const mySwitch'.$name.' = document.querySelector(\'input[funct="switch'.$name.'"]\');
    const statusMessage'.$name.' = document.querySelector("p[name='.$name.']");

    mySwitch'.$name.'.addEventListener("change", function() {
        if (mySwitch'.$name.'.checked) {
            statusMessage'.$name.'.textContent = "Status: On";
            statusMessage'.$name.'.classList.remove("text-black");
            statusMessage'.$name.'.classList.add("text-success");
        } else {
            statusMessage'.$name.'.textContent = "Status: Off";
            statusMessage'.$name.'.classList.remove("text-success");
            statusMessage'.$name.'.classList.add("text-black");
        }
    });
</script>';

@endphp

