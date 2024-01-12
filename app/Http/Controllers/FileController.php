<?php
 
namespace App\Http\Controllers;
 
use App\Http\Resources\AgendaResource;
use Illuminate\Http\Resources\Json\JsonResource;
 
class FileController extends Controller
{
    /**
     * Show the form to create a new blog post.
     */
    public function show($file)
    {
        $caminhoArquivo = storage_path('app/public/' . $file);
        if (file_exists($caminhoArquivo)) {
            return response()->download($caminhoArquivo);
        } else {
            abort(404, 'Arquivo não encontrado.');
        }
    }
        
}