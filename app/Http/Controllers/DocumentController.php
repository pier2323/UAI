<?php

namespace App\Http\Controllers;

use App\Models\Document; // Asegúrate de importar el modelo
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function upload(Request $request)
    {
        // Validar el archivo
        $request->validate([
            'file' => 'required|file|mimes:doc,docx,xls,xlsx|max:2048', // Máximo 2MB
        ]);

        // Almacenar el archivo en la carpeta 'Documen' dentro de 'public'
        $path = $request->file('file')->storeAs('public/Documen', $request->file('file')->getClientOriginalName());

        // Guardar el nombre y la ruta en la base de datos
        Document::create([
            'name' => $request->file('file')->getClientOriginalName(),
            'path' => $path,
        ]);

        return back()->with('success', 'Documento subido correctamente: ' . $path);
    }

    public function index()
    {
        $files = Document::all(); // Obtener todos los documentos de la base de datos
        return view('archivador', compact('files')); // Asegúrate de que estás pasando $files a la vista
    }
}