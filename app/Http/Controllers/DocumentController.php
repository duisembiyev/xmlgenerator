<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\FormType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DocumentController extends Controller
{
    public function create()
    {
        $formTypes = FormType::all();
        return view('documents.create', compact('formTypes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'form_type_id' => 'required|exists:form_types,id',
        ]);

        $formType = FormType::findOrFail($request->form_type_id);
        $fields = $formType->addionals['fields'] ?? [];

        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><document></document>');
        $xml->addChild('type', $formType->type);

        $dataNode = $xml->addChild('data');
        foreach ($fields as $field) {
            $fieldName = $field['name'];
            $value = $request->input($fieldName, '');
            $dataNode->addChild($fieldName, htmlspecialchars($value));
        }

        $xmlContent = $xml->asXML();
        
        //TODO: нужно подкорректировать и расширить
        //$xmlContent = generateAsycudaXml($data); //Это для того что б по щаблону астана1 делался генерация

        $fileName = 'doc_' . Str::random(8) . '.xml';
        $filePath = 'documents/' . $fileName;
        \Storage::disk('public')->put($filePath, $xmlContent);

        Document::create([
            'login' => Auth::user()->login,
            'type'  => $formType->type,
            'file_name' => $filePath,
        ]);

        return redirect()->route('documents.index')->with('success', 'Документ сгенерирован!');
    }

    public function index()
    {
        $documents = Document::where('login', Auth::user()->login)
                             ->orderBy('created_at', 'desc')
                             ->get();
        return view('documents.index', compact('documents'));
    }

    public function download($id)
    {
        $document = Document::findOrFail($id);

        if ($document->login !== Auth::user()->login) {
            abort(403);
        }

        $filePath = public_path('storage/' . $document->file_name);
        if (!file_exists($filePath)) {
            abort(404);
        }

        return response()->download($filePath);
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        if ($document->login !== Auth::user()->login) {
            abort(403);
        }

        $filePath = public_path('storage/' . $document->file_name);
        if (file_exists($filePath)) {
            unlink($filePath);
        }

        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Документ удалён.');
    }
}
