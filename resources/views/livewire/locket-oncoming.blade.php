<div wire:poll.10s class="card-body d-flex flex-column mb-3"
    style="overflow-y: scroll; max-height: 90%; margin-bottom: 1rem;">
    @forelse ($QueuesComing as $item)
        <div class="card w-100">
            <div class="card-body d-flex flex-row justify-content-between">
                <big>
                    {{ $item->queues_number }}
                </big>
                <div class="d-flex flex-row gap-2 ">
                    <button class="btn btn-sm btn-primary" onclick="update(this)" value="call"
                        data-val="{{ $item->id }}">panggil</button>
                    <form action="{{ route('locket.status') }}" method="post">
                        <input type="hidden" value="{{ $item->id }}" name="val">
                        <input type="hidden" name="difer" value="ya">
                        @csrf
                        <div class="btn-group d-flex flex-row flex-fill ">
                            <button class="btn btn-sm btn-success flex-fill" type="submit" value="proggres"
                                name="button">proggres</button>
                            <button class="btn btn-sm btn-info flex-fill" type="submit" value="stage"
                                name="button">stage</button>
                            <button class="btn btn-sm btn-warning flex-fill" type="submit" value="end"
                                name="button">end</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    @empty
    @endforelse

    <script>
        function update(obj) {
            const BtnValues = obj.value;
            const val = obj.getAttribute('data-val');
            console.log(val);
            const formData = new FormData();

            // Correct way to append multiple values
            formData.append('BtnValue', BtnValues);
            formData.append('val', val);

            fetch('/lockets/app/oncoming/', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
                    window.location.href = '/lockets/app';
                })
                .catch(error => {
                    console.error('Fetch error:', error);
                });
        }
    </script>
</div>
