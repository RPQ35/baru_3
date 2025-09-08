<div  wire:poll.10s class="card-body d-flex flex-column mb-3" style="overflow-y: scroll; max-height: 90%; margin-bottom: 1rem;">

    @forelse ($QueuesActive as $item)
        <div class="card w-100">
            <div class="card-body d-flex flex-row justify-content-between">
                <big>
                    {{ $item->queues_number }}
                </big>
                <form class="btn-group" >
                    {{-- <button class="btn btn-sm btn-primary" type="submit" value="panggil">panggil</button>
                    <button class="btn btn-sm btn-danger" type="button">ada</button> --}}
                </form>
            </div>
        </div>
    @empty

    @endforelse
</div>
