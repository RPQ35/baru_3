{{--
structur nya --

        <x-table title='title'>
            <x-slot name="thead">
                </x-slot>

            <x-slot name="tbody">
                </x-slot>
        </x-table>

--}}

@props([
    'title'=>"DataTable Example",
])

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        {{ $title }}
    </div>
    <div class="card-body">
        <table id="datatablesSimple">
            <thead>
                    {{ $thead }}


            </thead>
            <tfoot>
                    {{ $thead }}


            </tfoot>
            <tbody>
                    {{ $tbody }}

            </tbody>
            
        </table>
    </div>
</div>
