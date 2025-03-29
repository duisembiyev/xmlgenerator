@extends('layouts.app')

@section('content')
<h2>Создать новый документ</h2>
<form method="POST" action="{{ route('documents.store') }}" id="docForm">
    @csrf
    <div class="mb-3">
        <label for="form_type_id" class="form-label">Тип документа</label>
        <select name="form_type_id" id="form_type_id" class="form-select">
            <option value="">-- Выберите тип --</option>
            @foreach($formTypes as $ft)
                <option value="{{ $ft->id }}">{{ $ft->type }}</option>
            @endforeach
        </select>
    </div>

    <div id="dynamicFields"></div>

    <button type="submit" class="btn btn-success mt-3">Сохранить документ</button>
</form>

<script>
    let formTypes = @json($formTypes);

    const formTypeSelect = document.getElementById('form_type_id');
    const dynamicFieldsContainer = document.getElementById('dynamicFields');

    formTypeSelect.addEventListener('change', function () {
        dynamicFieldsContainer.innerHTML = '';

        let selectedId = parseInt(this.value);
        if (!selectedId) return;

        let selectedForm = formTypes.find(ft => ft.id === selectedId);
        if (!selectedForm || !selectedForm.addionals) return;

        let fields = selectedForm.addionals.fields || [];

        fields.forEach(field => {
            let div = document.createElement('div');
            div.classList.add('mb-3');

            let label = document.createElement('label');
            label.classList.add('form-label');
            label.textContent = field.label || field.name;

            let input = document.createElement('input');
            input.classList.add('form-control');
            input.name = field.name;
            input.type = field.type || 'text';

            div.appendChild(label);
            div.appendChild(input);
            dynamicFieldsContainer.appendChild(div);
        });
    });
</script>
@endsection
