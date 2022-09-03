<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;
use App\Models\Cliente;

class EditInformationForm extends Component
{
    public $nome;
    public $email;
    public $rg;
    public $cpf;
    public $phone;
    public $whatsapp;
    public $data_nascimento;
    public $sexo;
    public $clienteId;

    public function mount(Cliente $cliente)
    {
        $this->nome = $cliente->nome;
        $this->email = $cliente->email;
        $this->rg = $cliente->rg;
        $this->cpf = $cliente->cpf;
        $this->phone = $cliente->phone;
        $this->whatsapp = $cliente->whatsapp;
        $this->data_nascimento = $cliente->data_nascimento;
        $this->sexo = $cliente->sexo;
        $this->clienteId = $cliente->id;
    }

    public function save()
    {
        $cliente = Cliente::find($this->clienteId);
        $cliente->nome = $this->nome;
        $cliente->email = $this->email;
        $cliente->rg = $this->rg;
        $cliente->cpf = $this->cpf;
        $cliente->phone = $this->phone;
        $cliente->whatsapp = $this->whatsapp;
        $cliente->data_nascimento = $this->data_nascimento;
        $cliente->sexo = $this->sexo;
        $cliente->save();
        // $this->emit('flash_edit'); # componente filho some
        // $this->emitUp('flash_edit'); # componente filho some
        // $this->emitTo('Editar', 'flash_edit'); # nao acontece nada
        flash('Your request was successful!')->success()->livewire($this);
        // return view('livewire.clientes.edit-information-form'); # nao resolve o erro do componente sumir
    }

    public function render()
    {
        return view('livewire.clientes.edit-information-form');
    }
}