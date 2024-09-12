<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';

    protected $fillable = [
        'nome', 'cpf', 'email', 'data_nascimento', 'telefone', 'cep', 'estado', 'cidade', 'bairro', 'endereco', 'status'
    ];

    // Adiciona 'data_nascimento' à lista de campos de data
    protected $dates = ['data_nascimento'];
}
