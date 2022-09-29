<livewire:clientes.form-section submit="save">
    <x-slot name="title">
        {{ __('Dados Pessoais') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Digite os dados pessoais do cliente.') }}
    </x-slot>

    <x-slot name="title">
        {{ __('Endere&ccedil;o') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Digite o endere&ccedil;o do cliente.') }}
    </x-slot>

    <x-slot name="form1">
        @livewire('clientes.personal-data-form')
    </x-slot>
    <x-slot name="form1">
        @livewire('clientes.address-form')
    </x-slot>
</livewire:clientes.form-section>