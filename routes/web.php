<?php

use App\Http\Controllers\UsuarioController;
use App\Exports\UsuariosExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Usuario;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

Route::get('/', [UsuarioController::class, 'index']);

Route::resource('usuarios', UsuarioController::class);

Route::get('/usuarios/export/pdf', [UsuarioController::class, 'exportPdf'])->name('usuarios.export.pdf');

Route::get('usuarios/export/{format}', function($format) {
    // Pegar parâmetros de filtro da requisição (se houver)
    $pesquisa = request('pesquisa');
    $status = request('status');

    // Aplicar os filtros na consulta
    $usuarios = Usuario::query();

    if ($pesquisa) {
        $usuarios->where('nome', 'like', "%{$pesquisa}%")
                 ->orWhere('email', 'like', "%{$pesquisa}%");
    }

    if ($status) {
        $usuarios->where('status', $status);
    }

    // Executa a consulta para obter os usuários filtrados
    $usuarios = $usuarios->get();

    // Exportar o arquivo no formato solicitado (CSV ou XLS)
    if ($format === 'csv' || $format === 'xls') {
        return Excel::download(new UsuariosExport($usuarios), 'usuarios.'.$format);
    }

    return abort(404); // Retorna erro se o formato não for suportado
})->name('usuarios.export');
