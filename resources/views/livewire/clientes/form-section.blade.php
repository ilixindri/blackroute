{{-- @props(['submit']) --}}

{{-- <div {{ $attributes->merge(['class' => 'md:grid md:grid-cols-3 md:gap-6']) }}> --}}
<div class='md:grid md:grid-cols-3 md:gap-6'>
    <livewire:section-title :func="'section1()'">
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </livewire:section-title>
    <livewire:section-title func="section2()">
        <x-slot name="title">{{ $title }}</x-slot>
        <x-slot name="description">{{ $description }}</x-slot>
    </livewire:section-title>
    <script>
        function section1() {
            document.getElementById('form2').style.display = 'none';
            document.getElementById('form1').style.display = 'block';
        }
        function section2() {
            document.getElementById('form2').style.display = 'block';
            document.getElementById('form1').style.display = 'none';
        }
    </script>

    <div id="form1" class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="{{ $submit }}">
            {{ $form1 }}
        </form>
    </div>
    <div id="form2" class="mt-5 md:mt-0 md:col-span-2">
        <form wire:submit.prevent="{{ $submit }}">
            {{ $form2 }}
        </form>
    </div>
</div>