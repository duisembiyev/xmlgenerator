@extends('layouts.app')

@section('content')
<h2>Генерация (MainForm)</h2>

<style>
    .tab-content {
        border: 1px solid #ccc;
        padding: 15px;
        margin-top: -1px;
    }
    .nav-tabs .nav-item .nav-link .close {
        font-size: 16px;
        margin-left: 8px;
    }
</style>

<form method="POST" action="{{ route('documents.store') }}">
    @csrf
    <input type="hidden" name="form_type_id" value="{{ $formType->id }}">

    <ul class="nav nav-tabs" id="documentTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="main-tab" data-bs-toggle="tab" href="#main" role="tab" aria-controls="main" aria-selected="true">
                Main Form
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="add-tab" href="#" onclick="addItemTab(); return false;">+</a>
        </li>
    </ul>

    <div class="tab-content" id="documentTabsContent">
        <div class="tab-pane fade show active" id="main" role="tabpanel" aria-labelledby="main-tab">
            <h4>Основные поля</h4>
            <div id="dynamicFields">
                @foreach($formType->addionals['fields'] as $field)
                    @if(! str_starts_with($field['name'], 'item_'))
                        <div class="form-group">
                            <label for="{{ $field['name'] }}">{{ $field['label'] ?? $field['name'] }}</label>
                            <input 
                                type="{{ $field['type'] ?? 'text' }}"
                                class="form-control"
                                name="{{ $field['name'] }}"
                                id="{{ $field['name'] }}"
                            >
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <br>
    <button type="submit" class="btn btn-success mt-3">Сохранить документ</button>
</form>

<script>
    let itemCount = 0;

    function addItemTab() {
        let tabId = 'item-tab-' + itemCount;
        
        let newTab = document.createElement('li');
        newTab.className = 'nav-item';
        newTab.setAttribute('role', 'presentation');
        let newTabLink = document.createElement('a');
        newTabLink.className = 'nav-link';
        newTabLink.id = tabId + '-link';
        newTabLink.setAttribute('data-bs-toggle', 'tab');
        newTabLink.href = '#' + tabId;
        newTabLink.setAttribute('role', 'tab');
        newTabLink.setAttribute('aria-controls', tabId);
        newTabLink.setAttribute('aria-selected', 'false');
        newTabLink.innerHTML = 'Вкладка ' + (itemCount + 1) + ' <button type="button" class="close" onclick="removeItemTab(\'' + tabId + '\'); return false;">&times;</button>';
        newTab.appendChild(newTabLink);

        let addTab = document.getElementById('add-tab').parentElement;
        addTab.parentNode.insertBefore(newTab, addTab);

        let tabContent = document.createElement('div');
        tabContent.className = 'tab-pane fade';
        tabContent.id = tabId;
        tabContent.setAttribute('role', 'tabpanel');
        tabContent.setAttribute('aria-labelledby', tabId + '-link');

        tabContent.innerHTML = `
        <h4>Поля для Item</h4>

        <div class="form-group">
            <label>Consignment number</label>
            <input type="text" class="form-control" name="items[${itemCount}][consignment_number]">
        </div>

        <div class="form-group">
            <label>Is new consignment?</label>
            <input type="checkbox" name="items[${itemCount}][is_new_consignment]" value="1">
        </div>

        <hr>
        <h5>Consignee</h5>
        <div class="form-group">
            <label>Consignee code</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_consignee_code]">
        </div>
        <div class="form-group">
            <label>CONSIGNEE_name</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_consignee_name]">
        </div>
        <div class="form-group">
            <label>CONSIGNEE_ctyCod</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_consignee_ctyCod]">
        </div>
        <div class="form-group">
            <label>CONSIGNEE_regDsc</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_consignee_regDsc]">
        </div>
        <div class="form-group">
            <label>CONSIGNEE_regCod</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_consignee_regCod]">
        </div>
        <div class="form-group">
            <label>CONSIGNEE_catCod</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_consignee_catCod]">
        </div>
        <div class="form-group">
            <label>CONSIGNEE_street</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_consignee_street]">
        </div>
        <div class="form-group">
            <label>CONSIGNEE_city</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_consignee_city]">
        </div>

        <hr>
        <h5>Exporter</h5>
        <div class="form-group">
            <label>Exporter_code</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_exporter_code]">
        </div>
        <div class="form-group">
            <label>EXPORTER_name</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_exporter_name]">
        </div>
        <div class="form-group">
            <label>EXPORTER_ctyCod</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_exporter_ctyCod]">
        </div>
        <div class="form-group">
            <label>EXPORTER_regDsc</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_exporter_regDsc]">
        </div>
        <div class="form-group">
            <label>EXPORTER_regCod</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_exporter_regCod]">
        </div>
        <div class="form-group">
            <label>EXPORTER_catCod</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_exporter_catCod]">
        </div>
        <div class="form-group">
            <label>EXPORTER_street</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_exporter_street]">
        </div>
        <div class="form-group">
            <label>EXPORTER_city</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_exporter_city]">
        </div>

        <hr>
        <h5>Dangerous goods</h5>
        <div class="form-group">
            <label>Dangerous_goods_code</label>
            <input type="text" class="form-control" name="items[${itemCount}][dangerous_goods_code]">
        </div>
        <div class="form-group">
            <label>Dangerous_goods_name</label>
            <input type="text" class="form-control" name="items[${itemCount}][dangerous_goods_name]">
        </div>

        <hr>
        <h5>Packages</h5>
        <div class="form-group">
            <label>Number_of_packages</label>
            <input type="text" class="form-control" name="items[${itemCount}][number_of_packages]">
        </div>
        <div class="form-group">
            <label>Marks1_of_packages</label>
            <input type="text" class="form-control" name="items[${itemCount}][marks1_of_packages]">
        </div>
        <div class="form-group">
            <label>Kind_of_packages_code</label>
            <input type="text" class="form-control" name="items[${itemCount}][kind_of_packages_code]">
        </div>

        <hr>
        <h5>Tarification</h5>
        <div class="form-group">
            <label>Commodity_code</label>
            <input type="text" class="form-control" name="items[${itemCount}][commodity_code]">
        </div>
        <div class="form-group">
            <label>Unit_of_measure_code</label>
            <input type="text" class="form-control" name="items[${itemCount}][unit_of_measure_code]">
        </div>
        <div class="form-group">
            <label>Quantity</label>
            <input type="text" class="form-control" name="items[${itemCount}][quantity]">
        </div>
        <div class="form-group">
            <label>Item_currency_code</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_currency_code]">
        </div>
        <div class="form-group">
            <label>Item_price</label>
            <input type="text" class="form-control" name="items[${itemCount}][item_price]">
        </div>

        <hr>
        <h5>Attached documents</h5>
        <div class="form-group">
            <label>Attached_document_code</label>
            <input type="text" class="form-control" name="items[${itemCount}][attached_document_code]">
        </div>
        <div class="form-group">
            <label>Attached_document_reference</label>
            <input type="text" class="form-control" name="items[${itemCount}][attached_document_reference]">
        </div>
        <div class="form-group">
            <label>Attached_document_date</label>
            <input type="date" class="form-control" name="items[${itemCount}][attached_document_date]">
        </div>

        <hr>
        <h5>Goods description</h5>
        <div class="form-group">
            <label>Container_1</label>
            <input type="text" class="form-control" name="items[${itemCount}][container_1]">
        </div>
        <div class="form-group">
            <label>Container_2</label>
            <input type="text" class="form-control" name="items[${itemCount}][container_2]">
        </div>
        <div class="form-group">
            <label>Description_of_goods</label>
            <input type="text" class="form-control" name="items[${itemCount}][description_of_goods]">
        </div>
        <div class="form-group">
            <label>Commercial_Description</label>
            <input type="text" class="form-control" name="items[${itemCount}][commercial_description]">
        </div>

        <hr>
        <h5>Previous documents</h5>
        <div class="form-group">
            <label>PrevDocCod</label>
            <input type="text" class="form-control" name="items[${itemCount}][prev_doc_cod]">
        </div>
        <div class="form-group">
            <label>PrevDocNbr</label>
            <input type="text" class="form-control" name="items[${itemCount}][prev_doc_nbr]">
        </div>
        <div class="form-group">
            <label>PrevDocDat</label>
            <input type="date" class="form-control" name="items[${itemCount}][prev_doc_dat]">
        </div>
        <div class="form-group">
            <label>PrevDocMan</label>
            <input type="text" class="form-control" name="items[${itemCount}][prev_doc_man]">
        </div>
        <div class="form-group">
            <label>PrevDocNational</label>
            <input type="text" class="form-control" name="items[${itemCount}][prev_doc_national]">
        </div>

        <hr>
        <h5>Valuation item</h5>
        <div class="form-group">
            <label>Gross_weight_itm</label>
            <input type="text" class="form-control" name="items[${itemCount}][gross_weight_itm]">
        </div>
        <div class="form-group">
            <label>Net_weight_itm</label>
            <input type="text" class="form-control" name="items[${itemCount}][net_weight_itm]">
        </div>
        `;
        document.getElementById('documentTabsContent').appendChild(tabContent);

        var triggerEl = document.getElementById(tabId + '-link');
        var tabInstance = new bootstrap.Tab(triggerEl);
        tabInstance.show();

        itemCount++;
    }

    function removeItemTab(tabId) {
        let tabLink = document.getElementById(tabId + '-link');
        if (tabLink) {
            let li = tabLink.parentElement;
            li.parentNode.removeChild(li);
        }
        let tabContent = document.getElementById(tabId);
        if (tabContent) {
            tabContent.parentNode.removeChild(tabContent);
        }
        var mainTabEl = document.getElementById('main-tab');
        var mainTab = new bootstrap.Tab(mainTabEl);
        mainTab.show();
    }
</script>
@endsection
