@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Usuário</h1>


    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" value="{{ old('nome', $usuario->nome) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" class="form-control" value="{{ old('cpf', $usuario->cpf) }}" maxlength="11" required>
                    <small id="cpfHelp" class="form-text text-muted">Digite apenas números (máximo 11 dígitos).</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email', $usuario->email) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" class="form-control" value="{{ old('data_nascimento', $usuario->data_nascimento) }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" class="form-control" value="{{ old('telefone', $usuario->telefone) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" class="form-control" value="{{ old('cep', $usuario->cep) }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" class="form-control" value="{{ old('estado', $usuario->estado) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" class="form-control" value="{{ old('cidade', $usuario->cidade) }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" class="form-control" value="{{ old('bairro', $usuario->bairro) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" class="form-control" value="{{ old('endereco', $usuario->endereco) }}" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="{{ route('usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const cepInput = document.querySelector('input[name="cep"]');
        const estadoInput = document.querySelector('input[name="estado"]');
        const cidadeInput = document.querySelector('input[name="cidade"]');
        const bairroInput = document.querySelector('input[name="bairro"]');
        const enderecoInput = document.querySelector('input[name="endereco"]');
        const cpfInput = document.querySelector('input[name="cpf"]');

       
        cpfInput.addEventListener('input', function() {
            let cpf = cpfInput.value.replace(/\D/g, ''); 
            if (cpf.length > 11) {
                cpf = cpf.slice(0, 11); 
            }
            cpfInput.value = cpf;
        });

        
        cepInput.addEventListener('blur', function() {
            let cep = cepInput.value.replace(/\D/g, '');
            if (cep.length === 8) {
                fetch(`https://viacep.com.br/ws/${cep}/json/`)
                    .then(response => response.json())
                    .then(data => {
                        if (!data.erro) {
                            estadoInput.value = data.uf;
                            cidadeInput.value = data.localidade;
                            bairroInput.value = data.bairro;
                            enderecoInput.value = data.logradouro;
                        } else {
                            alert('CEP não encontrado!');
                        }
                    })
                    .catch(error => {
                        console.error('Erro ao buscar o CEP:', error);
                        alert('Erro ao buscar o CEP!');
                    });
            } else {
                alert('CEP inválido!');
            }
        });
    });
</script>
@endsection
