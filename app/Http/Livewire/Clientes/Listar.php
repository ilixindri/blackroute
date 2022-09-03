<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use App\Models\Cliente;

class Listar extends Component
{
    // public $clientes;

    // public function mount()
    // {
    //     $clientes = Cliente::all();
    // }
    
    public function render()
    {
        $clientes = Cliente::all()->toArray();
        // dd(gettype($clientes));
        // dd($clientes);
        // return view('livewire.clientes.listar', ['clientes' => $clientes]);
        // return view('livewire.clientes.listar')->with(compact('clientes'));
        // return view('livewire.clientes.listar')->with('clientes', $clientes);
        return view('livewire.clientes.listar', compact('clientes'));
    }
}