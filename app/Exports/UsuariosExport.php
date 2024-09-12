<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use App\Models\Usuario;

class UsuariosExport implements FromCollection, WithHeadings, WithMapping
{
    protected $usuarios;

    public function __construct($usuarios)
    {
        $this->usuarios = $usuarios;
    }

    public function collection()
    {
        return $this->usuarios;
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nome',
            'Cpf',
            'Data de Nascimento',
            'Email',
            'Telefone',
            'Cep',
            'Endereco',
            'Estado',
            'Cidade',
            'Bairro',
            'Status',
        ];
    }

    public function map($usuario): array
    {
        return [
            $usuario->id,
            $usuario->nome,
            $usuario->cpf,
            $usuario->data_nascimento,
            $usuario->email,
            $usuario->telefone,
            $usuario->cep,
            $usuario->endereco,
            $usuario->estado,
            $usuario->cidade,
            $usuario->bairro,
            $usuario->status,
        ];
    }
}
