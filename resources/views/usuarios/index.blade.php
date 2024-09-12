@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Usuários</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <div class="text-right mb-3">   
        <a href="{{ route('usuarios.export', array_merge(request()->query(), ['format' => 'csv'])) }}" class="btn btn-primary mt-3">Exportar CSV</a>
        <a href="{{ route('usuarios.export', array_merge(request()->query(), ['format' => 'xls'])) }}" class="btn btn-primary mt-3">Exportar XLS</a>
        <a href="{{ route('usuarios.export.pdf', request()->query()) }}" class="btn btn-primary mt-3">Exportar PDF</a>
    </div>

    <form action="{{ route('usuarios.index') }}" method="GET" class="mb-3">
        <div class="row">         
            <div class="col-md-6 col-sm-12 mb-2">
                <div class="input-group">
                    <input type="text" name="pesquisa" value="{{ $pesquisa ?? '' }}" placeholder="Pesquisar usuário..." class="form-control">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-primary">Pesquisar</button>
                    </div>
                </div>
            </div>

            <div class="col-md-3 col-sm-6 mb-2">
                <select name="status" class="form-control">
                    <option value="">Todos os Status</option>
                    <option value="ativo" {{ request('status') == 'ativo' ? 'selected' : '' }}>Ativo</option>
                    <option value="inativo" {{ request('status') == 'inativo' ? 'selected' : '' }}>Inativo</option>
                </select>
            </div>

            <div class="col-md-3 col-sm-6 mb-2">
                <button type="submit" class="btn btn-secondary w-100">Filtrar</button>
            </div>
        </div>
    </form>

    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Cpf</th>
                    <th>Status</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->nome }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td>{{ $usuario->cpf }}</td>
                        <td>{{ $usuario->status }}</td>
                        <td>
                            <div  role="group">
                                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                                <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">Nenhum usuário encontrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="text-right">
        <a href="{{ route('usuarios.create') }}" class="btn btn-success mt-3">Adicionar Novo Usuário</a>
    </div>
</div>
@endsection

@section('styles')
<style>
    .btn-group {
        display: flex;
        gap: 10px; 
        align-items: center;
    }

    .btn-group .btn {
        text-align: right;
    }
</style>
@endsection