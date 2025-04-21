<?php

namespace App\Http\Controllers;

use App\Models\Document;
use App\Models\FormType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{
    public function create()
    {
        return view('documents.create');
    }

    public function store(Request $request)
    {
        $documentData = $request->except(['_token']);

        $document = Document::create([
            'login' => auth()->user()->login,
            'type'  => 'MainForm',
            'data'  => $documentData,
        ]);

        $xmlContent = generateAsycudaXml([$documentData]);

        $fileName = 'asycuda_' . $document->id . '_' . date('Ymd_His') . '.xml';
        Storage::disk('public')->put('doc/' . $fileName, $xmlContent);

        $document->update(['doc_link' => 'doc/' . $fileName]);

        return response($xmlContent, 200)
            ->header('Content-Type', 'application/xml')
            ->header('Content-Disposition', "attachment; filename={$fileName}");
    }

    public function showDocument($id)
    {
        $document = Document::findOrFail($id);
        if ($document->login !== auth()->user()->login) {
            abort(403);
        }
        if (!$document->doc_link) {
            abort(404, 'Документ не найден.');
        }
        $xmlContent = Storage::disk('public')->get($document->doc_link);
        return response($xmlContent, 200)
            ->header('Content-Type', 'application/xml');
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
        $fields   = $formType->addionals['fields'] ?? [];

        $documentData = [];
        foreach ($fields as $field) {
            $fieldName = $field['name'];
            $documentData[$fieldName] = $request->input($fieldName, '');
        }

        $items = $request->input('items', []);
        $documentData['items'] = $items;

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
