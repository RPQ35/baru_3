<div wire:poll.10s class="card-body d-flex flex-column mb-3"
    style="overflow-y: scroll; max-height: 90%; margin-bottom: 1rem;">
    {{-- @dd($QueuesActive) --}}

    @forelse ($QueuesActive as $item)
        <div class="card w-100">
            <div class="card-body d-flex flex-row justify-content-between">
                <big>
                    {{ $item->queues_number }}
                </big>
                <div class="d-flex flex-row gap-2 ">
                    <form method="post" action="{{ route('locket.active') }}">
                        <input type="hidden" value="{{ $item->id }}" name="val">
                        @csrf

                        <button class="btn  btn-primary" type="submit" value="next" name="button"
                            autofocus>next</button>
                        <button class="btn  btn-secondary" type="submit" value="recall" name="button">ReCall</button>
                        <button class="btn  btn-danger" type="submit" value="skip" name="button">skip</button>

                    </form>
                    <form action="{{ route('locket.status') }}" method="post">
                        <input type="hidden" value="{{ $item->id }}" name="val">
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
    {{-- @dd($QueuesActive) --}}
    @endforelse



</div>
