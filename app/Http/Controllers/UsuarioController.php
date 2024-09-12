<?php

namespace App\Http\Controllers;
use PDF;
use App\Models\Usuario;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function index(Request $request)
    {
        $pesquisa = $request->get('pesquisa');
        $status = $request->get('status');
    
        $query = Usuario::query();
    
        if ($pesquisa) {
            $query->where('nome', 'like', '%' . $pesquisa . '%')
                  ->orWhere('email', 'like', '%' . $pesquisa . '%');
        }
    
        if ($status) {
            $query->where('status', $status);
        }
        try{

            $usuarios = $query->get();
        } catch (\Exception $e) {
            $usuarios = [];
        }
      
    
        return view('usuarios.index', compact('usuarios', 'pesquisa', 'status'));
    }
    

    public function create()
    {
        return view('usuarios.create');
    }

    public function store(Request $request)
    {

        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|string|size:11|unique:usuarios,cpf',
            'email' => 'required|email|unique:usuarios,email',
            'data_nascimento' => 'required|date',
            'telefone' => 'required',
            'cep' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'endereco' => 'required',
        ]);
    
 
        Usuario::create($request->all());
        
      
        return redirect()->route('usuarios.index')->with('success', 'Usuário criado com sucesso!');
    }
    
    public function edit(Usuario $usuario)
    {
        return view('usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, Usuario $usuario)
    {

        $request->validate([
            'nome' => 'required',
            'cpf' => 'required|string|size:11|unique:usuarios,cpf,' . $usuario->id, 
            'email' => 'required|email|unique:usuarios,email,' . $usuario->id, 
            'data_nascimento' => 'required|date',
            'telefone' => 'required',
            'cep' => 'required',
            'estado' => 'required',
            'cidade' => 'required',
            'bairro' => 'required',
            'endereco' => 'required',
        ]);


        $usuario->update($request->all());
        
    
        return redirect()->route('usuarios.index')->with('success', 'Usuário atualizado com sucesso!');
    }

    public function destroy(Usuario $usuario)
    {

        $usuario->update(['status' => 'Inativo']);

  
        return redirect()->route('usuarios.index')->with('success', 'Usuário desativado com sucesso!');
    }
public function exportPdf(Request $request)
{
 
    $pesquisa = $request->input('pesquisa');
    $status = $request->input('status');

  
    $usuarios = Usuario::query();

    if ($pesquisa) {
        $usuarios->where('nome', 'like', "%{$pesquisa}%")
                 ->orWhere('email', 'like', "%{$pesquisa}%");
    }

    if ($status) {
        $usuarios->where('status', $status);
    }

   
    $usuarios = $usuarios->get();

   
    $pdf = PDF::loadView('usuarios.pdf', compact('usuarios'));


    return $pdf->download('usuarios.pdf');
}

}
