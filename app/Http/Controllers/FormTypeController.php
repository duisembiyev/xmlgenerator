<?php

namespace App\Http\Controllers;

use App\Models\FormType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormTypeController extends Controller
{
    public function index()
    {
        $formTypes = FormType::orderBy('created_at', 'desc')->get();
        return view('form_types.index', compact('formTypes'));
    }

    public function create()
    {
        return view('form_types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'addionals' => 'nullable',
        ]);

        $jsonData = $request->addionals ? json_decode($request->addionals, true) : null;

        FormType::create([
            'type' => $request->type,
            'addionals' => $jsonData,
            'created_by' => Auth::user()->login,
        ]);

        return redirect()->route('form_types.index')->with('success', 'Новый тип формы создан!');
    }

    public function edit($id)
    {
        $formType = FormType::findOrFail($id);
        return view('form_types.edit', compact('formType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required',
            'addionals' => 'nullable',
        ]);

        $formType = FormType::findOrFail($id);

        $jsonData = $request->addionals ? json_decode($request->addionals, true) : null;

        $formType->update([
            'type' => $request->type,
            'addionals' => $jsonData,
        ]);

        return redirect()->route('form_types.index')->with('success', 'Тип формы обновлён!');
    }

    public function destroy($id)
    {
        $formType = FormType::findOrFail($id);
        $formType->delete();

        return redirect()->route('form_types.index')->with('success', 'Тип формы удалён!');
    }
}
