@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Adicionar Novo Usuário</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

   
    <form action="{{ route('usuarios.store') }}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="nome">Nome</label>
                    <input type="text" name="nome" class="form-control" value="{{ old('nome') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cpf">CPF</label>
                    <input type="text" name="cpf" class="form-control" value="{{ old('cpf') }}" maxlength="11" required>
                    <small id="cpfHelp" class="form-text text-muted">Digite apenas números (máximo 11 dígitos).</small>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="data_nascimento">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" class="form-control" value="{{ old('data_nascimento') }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="telefone">Telefone</label>
                    <input type="text" name="telefone" class="form-control" value="{{ old('telefone') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cep">CEP</label>
                    <input type="text" name="cep" class="form-control" value="{{ old('cep') }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="estado">Estado</label>
                    <input type="text" name="estado" class="form-control" value="{{ old('estado') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="cidade">Cidade</label>
                    <input type="text" name="cidade" class="form-control" value="{{ old('cidade') }}" required>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="bairro">Bairro</label>
                    <input type="text" name="bairro" class="form-control" value="{{ old('bairro') }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="endereco">Endereço</label>
                    <input type="text" name="endereco" class="form-control" value="{{ old('endereco') }}" required>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Salvar</button>
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
    
        const telefoneInput = document.querySelector('input[name="telefone"]');

 

        const telefoneMask = (value) => {
            let numbers = value.replace(/\D/g, ""); // Remove qualquer caractere não numérico

            if (numbers.length > 11) {
                numbers = numbers.slice(0, 11);
            }

            if (numbers.length <= 2) {
                return `(${numbers}`;
            } else if (numbers.length <= 7) {
                return `(${numbers.slice(0, 2)}) ${numbers.slice(2, 6)}${numbers.length > 2 ? '-' + numbers.slice(6) : ''}`;
            } else {
                return `(${numbers.slice(0, 2)}) ${numbers.slice(2, 7)}-${numbers.slice(7)}`;
            }
        };


        if (telefoneInput) {
            telefoneInput.addEventListener('input', function () {
                telefoneInput.value = telefoneMask(telefoneInput.value);
            });
        }

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
