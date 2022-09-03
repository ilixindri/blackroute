<?php

namespace App\Http\Livewire\Clientes;

use Livewire\Component;

class Novo extends Component
{
    public $nome;
    public $email;
    public $rg;
    public $cpf;
    public $phone;
    public $whatsapp;
    public $data_nascimento;
    public $sexo;

    public function save()
    {
        $cliente = new Cliente();
        $cliente->nome = $this->nome;
        $cliente->email = $this->email;
        $cliente->rg = $this->rg;
        $cliente->cpf = $this->cpf;
        $cliente->phone = $this->phone;
        $cliente->whatsapp = $this->whatsapp;
        $cliente->data_nascimento = $this->data_nascimento;
        $cliente->sexo = $this->sexo;
        $cliente->save();
    }
    
    public function render()
    {
        // return view('livewire.clientes.form')->layout('layouts.app');
        return view('livewire.clientes.form');
    }
}