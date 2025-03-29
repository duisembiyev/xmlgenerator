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

        $documentData = [];
        foreach ($fields as $field) {
            $fieldName = $field['name'];
            $documentData[$fieldName] = $request->input($fieldName, '');
        }

        Document::create([
            'login' => Auth::user()->login,
            'type'  => $formType->type,
            'data'  => $documentData,
        ]);

        return redirect()->route('documents.index')->with('success', 'Документ сохранён.');
    }

    public function index()
    {
        $documents = Document::where('login', Auth::user()->login)
                             ->orderBy('created_at', 'desc')
                             ->get();
        return view('documents.index', compact('documents'));
    }

    public function edit($id)
    {
        $document = Document::findOrFail($id);
        if ($document->login !== Auth::user()->login) {
            abort(403);
        }
        $formTypes = FormType::all();
        return view('documents.edit', compact('document', 'formTypes'));
    }

    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);
        if ($document->login !== Auth::user()->login) {
            abort(403);
        }
        $request->validate([
            'form_type_id' => 'required|exists:form_types,id',
        ]);
        $formType = FormType::findOrFail($request->form_type_id);
        $fields = $formType->addionals['fields'] ?? [];
        $documentData = [];
        foreach ($fields as $field) {
            $fieldName = $field['name'];
            $documentData[$fieldName] = $request->input($fieldName, '');
        }
        $document->update([
            'type' => $formType->type,
            'data' => $documentData,
        ]);
        return redirect()->route('documents.index')->with('success', 'Документ обновлён.');
    }

    public function destroy($id)
    {
        $document = Document::findOrFail($id);

        if ($document->login !== Auth::user()->login) {
            abort(403);
        }

        $document->delete();

        return redirect()->route('documents.index')->with('success', 'Документ удалён.');
    }

    public function generateAll()
    {
        $documents = Document::where('login', Auth::user()->login)->get();

        $documentsData = $documents->map(function ($doc) {
            return array_merge(['type' => $doc->type], $doc->data ?? []);
        })->toArray();

        $xmlContent = generateAsycudaXml($documentsData);

        $fileName = 'asycuda_' . date('Ymd_His') . '.xml';
        return response($xmlContent)
            ->header('Content-Type', 'application/xml')
            ->header('Content-Disposition', 'attachment; filename='.$fileName);
    }
}
