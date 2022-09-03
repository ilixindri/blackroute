<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use App\Models\Cliente;

class Editar extends Component
{
    public $cliente;

    protected $listeners = ['flash_edit' => 'flash'];

    public function flash()
    {
        session()->flash('message', __('Cliente Atualizado'));
    }

    public function mount(Cliente $cliente)
    {
        $this->cliente = $cliente;
    }

    public function render()
    {
        return view('livewire.clientes.form');
    }
}