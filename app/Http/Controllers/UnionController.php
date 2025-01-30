<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\AuditActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpWord\TemplateProcessor;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

class UnionController extends Controller
{
    private PhpWord $document;
    public function union(Request $request)
    {
        // Validar la entrada
        $validator = Validator::make($request->all(), [
            'auditActivityId' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => 'El ID de actividad de auditoría es requerido.'], 400);
        }
    
        $public_id = $request->input('auditActivityId');
    
        // Obtener la actividad de auditoría
        $auditActivity = AuditActivity::where('public_id', $public_id)->first();
    
        // Manejar el caso en que no se encuentra la actividad
        if (!$auditActivity) {
            return response()->json(['message' => 'Actividad de auditoría no encontrada.'], 404);
        }
    
        // Buscar documentos que contengan "IA-"
        $documentsIA = Document::where('audit_activity_id', $auditActivity->id)
            ->where('name', 'like', '%IA-%')
            ->get();
    
        // Buscar documentos que contengan "Tiene_ceco" sin importar mayúsculas y minúsculas
        $documentsTieneCeco = Document::where('audit_activity_id', $auditActivity->id)
            ->whereRaw('LOWER(name) LIKE ?', ['%tiene_ceco%'])
            ->get();

        // Verificar si se encontraron documentos
        if ($documentsIA->isEmpty() || $documentsTieneCeco->isEmpty()) {
            return response()->json(['message' => 'No se encontraron documentos suficientes para fusionar.'], 404);
        }

        $this->createDocument();

        // // Definir la ruta base
        define("__DIRPATH" , 'C:\Users\pier\Desktop\UAI');

        // // Combinar los documentos
        // $archivo = __DIRNAME . "\\App\\OOXML\\HasNoCECO.ooxml";

        // // Leer todo el contenido del archivo en una cadena
        // $HasNoCECO = file_get_contents(filename: $archivo);

        // $basePath = 'C:\Users\pier\Desktop\UAI\public\storage\\';

        // // Cargar los documentos a fusionar
        // $templateProcessor1 = new TemplateProcessor($basePath . str_replace('public/', '', $documentsIA->first()->path)); 

        // $templateProcessor1->setValue('hasNoCECO', $HasNoCECO);

        // // Guardar el documento resultante
        // $outputPath = 'documento_final.docx'; // Ruta donde se guardará el documento final
        // $templateProcessor1->saveAs($outputPath);

        // // Retornar la respuesta con el archivo generado
        // return response()->json([
        //     'message' => 'Documentos combinados exitosamente.',
        //     'output_file' => url($outputPath), // Devuelve la URL del archivo generado
        // ], 200);
    }

    function createDocument()
    {
        // $this->document = new PhpWord();

        // $documents = ['document1' => '', 'document2' => '']; 

        $html = 'App\\HtmlForDocument\\hasNoCECO.html';

        $phpWord = $this->loadHtmlDocument($html);

        // // Modificar el documento (opcional)
        // $section = $phpWord->getFirstSection();
        // $section->addText('Texto añadido desde PHP');

        // Guardar el documento como Word
        $documentForAdding = IOFactory::createWriter($phpWord, 'Word2007');

        dd($documentForAdding->getPhpWord()->getSections());


        $writer->save('documento_convertido.docx'); 
    }
    
    // function loadDocument(string $nameOfDocument)
    // {
    //     return IOFactory::load($nameOfDocument, $this->document);
    // }

    function loadHtmlDocument(string $nameOfDocument)
    {
        try 
        {
            $file = 'C:\\Users\\pier\\Desktop\\UAI\\' . $nameOfDocument;
            return IOFactory::load($file ,'HTML');
        } 
        
        catch (\Throwable $th) 
        {
            dd($th->getMessage());
        }
    }
}