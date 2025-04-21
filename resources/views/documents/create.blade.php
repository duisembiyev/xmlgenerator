@extends('layouts.app')

@section('content')
    <h2>ASTANA-1 Транзитная декларация</h2>

    <style>
        .custom-table {
            width: 100%;
            border: 1px solid #009900;
            border-collapse: collapse;
            font-size: 12px;
            background: #e8f9ee;
        }

        .custom-table th,
        .custom-table td {
            border: 1px solid #009900;
            padding: 4px;
            vertical-align: top;
        }

        .nav-tabs .nav-link {
            font-weight: bold;
        }

        .tab-content {
            border: 1px solid #009900;
            padding: 10px;
            margin-top: -1px;
            background: #f5fdf5;
        }

        input[type=text],
        input[type=date],
        select,
        textarea {
            width: 100%;
            border: none;
            background: transparent;
            padding: 2px;
            box-sizing: border-box;
            font-size: 12px;
            font-family: inherit;
        }

        textarea {
            resize: vertical;
        }
    </style>

    @php
        $tabs = [
            'tab-main' => 'ПИ, УП, ТД',
            'tab-1821' => 'Графы 18,21',
            'tab-44' => 'Графа 44',
            'tab-scan' => 'Скан.док.',
            'tab-analysis' => 'Страница анализа',
            'tab-fee' => 'Информация о тамож. сборе',
        ];
    @endphp

    <form method="POST" action="{{ route('documents.store') }}">
        @csrf

        <ul class="nav nav-tabs" role="tablist">
            @foreach($tabs as $id => $label)
                <li class="nav-item">
                    <a class="nav-link @if($loop->first) active @endif" id="{{ $id }}-link" data-bs-toggle="tab"
                        href="#{{ $id }}" role="tab">{{ $label }}</a>
                </li>
            @endforeach
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-main" role="tabpanel">
                <table class="custom-table">
                    <tr>
                        <td colspan="2" rowspan="2" style="background:#003366;color:#fff;text-align:center;">ASTANA-1</td>
                        <td colspan="6"></td>
                        <td>
                            1 Декларация<br>
                            <input type="text" name="type_of_declaration">
                        </td>
                        <td>
                            MDP<br>
                            <input type="text" name="declaration_gen_procedure_code">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6"></td>
                        <td>
                            3 Формы №<br>
                            <input type="text" name="number_of_the_form">
                        </td>
                        <td>
                            Всего форм<br>
                            <input type="text" name="total_number_of_forms">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">2 Отправитель/Экспортер</td>
                        <td>№ TIR EPD<br><input type="text" name="unique_consignment_trsp_refer_no"></td>
                        <td>Всего консигн.<br><input type="text" name="total_number_of_consignments"></td>
                        <td>Всего пак.<br><input type="text" name="total_number_of_packages"></td>
                        <td>Вес брутто<br><input type="text" name="total_gross_mass"></td>
                        <td colspan="2">
                            7 Справ. номер<br>
                            <input type="text" name="manifest_reference_number" value="2025">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="11">
                            <strong>Exporter:</strong><br>
                            Код<br><input type="text" name="exporter_code"><br>
                            Наименование<br><input type="text" name="exporter_name"><br>
                            Страна<br><input type="text" name="exporter_ctyCod"><br>
                            Рег. опис.<br><input type="text" name="exporter_regDsc"><br>
                            Рег. код<br><input type="text" name="exporter_regCod"><br>
                            Кат. код<br><input type="text" name="exporter_catCod"><br>
                            Улица<br><input type="text" name="exporter_street"><br>
                            Город<br><input type="text" name="exporter_city">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">8 Получатель</td>
                        <td colspan="7"></td>
                    </tr>
                    <tr>
                        <td colspan="11">
                            <strong>Consignee:</strong><br>
                            Код<br><input type="text" name="consignee_code"><br>
                            Наименование<br><input type="text" name="consignee_name"><br>
                            Страна<br><input type="text" name="consignee_ctyCod"><br>
                            Рег. опис.<br><input type="text" name="consignee_regDsc"><br>
                            Рег. код<br><input type="text" name="consignee_regCod"><br>
                            Кат. код<br><input type="text" name="consignee_catCod"><br>
                            Улица<br><input type="text" name="consignee_street"><br>
                            Город<br><input type="text" name="consignee_city">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="11">
                            <strong>Delivery/Carrier:</strong><br>
                            Код<br><input type="text" name="delivery_party_code"><br>
                            Наименование<br><input type="text" name="carrier_name"><br>
                            Страна<br><input type="text" name="carrier_ctyCod"><br>
                            Рег. опис.<br><input type="text" name="carrier_regDsc"><br>
                            Рег. код<br><input type="text" name="carrier_regCod"><br>
                            Кат. код<br><input type="text" name="carrier_catCod"><br>
                            Улица<br><input type="text" name="carrier_street"><br>
                            Город<br><input type="text" name="carrier_city"><br>
                            Водитель<br><input type="text" name="driver">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="5">
                            14 Декларант №<br>
                            <input type="text" name="declarant_code">
                        </td>
                        <td colspan="6">
                            Наименование<br>
                            <input type="text" name="declarant_name">
                        </td>
                    </tr>
                    <tr>
                        <td>15 Страна отправления</td>
                        <td><input type="text" name="export_country_code"></td>
                        <td>16 Страна назначения</td>
                        <td><input type="text" name="destination_country_code"></td>
                        <td colspan="3">Планир. дата прибытия<br><input type="date" name="planned_date"></td>
                        <td colspan="3"></td>
                    </tr>

                    <tr>
                        <td colspan="5">18 Дата прибытия на тамож. тер.<br><input type="date"
                                name="arrival_on_customs_territory_date"></td>
                        <td colspan="6">Время<br><input type="text" name="arrival_on_customs_territory_time"></td>
                    </tr>

                    <tr>
                        <td colspan="11">
                            <strong>Property / Additional doc:</strong><br>
                            Free text<br><textarea name="free_text_for_additional_document" rows="2"></textarea><br>
                            SAD flow<br><input type="text" name="sad_flow">
                        </td>
                    </tr>

                    <tr>
                        <td colspan="4">22 Инвойс сумма</td>
                        <td colspan="3"><input type="text" name="invoice_amount"></td>
                        <td colspan="4">Код валюты<br><input type="text" name="invoice_currency"></td>
                    </tr>

                    <tr>
                        <td colspan="11"><strong>31 Грузовые места и описание товаров</strong></td>
                    </tr>
                    <tr>
                        <td colspan="11">
                            <table class="custom-table" style="width:100%;">
                                <tr>
                                    <td>1</td>
                                    <td><input type="text" name="description_of_goods"></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><input type="text" name="commercial_description"></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><input type="text" name="container_1"></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td>—</td>
                        <td colspan="2">32 Consignment №</td>
                        <td colspan="3"><input type="text" name="consignment_number"></td>
                        <td>33 HS code</td>
                        <td colspan="4"><input type="text" name="commodity_code"></td>
                    </tr>
                    <tr>
                        <td>—</td>
                        <td colspan="3">Вес брутто (кг)</td>
                        <td colspan="3"><input type="text" name="gross_weight_itm"></td>
                        <td>Ед. изм.</td>
                        <td colspan="3"><input type="text" name="unit_of_measure_code"></td>
                    </tr>
                    <tr>
                        <td>—</td>
                        <td colspan="4">Цена за ед.</td>
                        <td colspan="6"><input type="text" name="item_price"></td>
                    </tr>

                    <tr>
                        <td colspan="3">40 Общая декл./Предш. док.</td>
                        <td colspan="8"><input type="text" name="previous_doc"></td>
                    </tr>
                    <tr>
                        <td colspan="4">41 Доп. ед. изм.</td>
                        <td colspan="3"><input type="text" name="additional_unit"></td>
                        <td>42 Цена товара</td>
                        <td colspan="3"><input type="text" name="item_price"></td>
                    </tr>
                    <tr>
                        <td colspan="11"><strong>44 Дополн. информация:</strong><br><textarea name="supplementary_info"
                                rows="2"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="7"></td>
                        <td>Код ДИ<br><input type="text" name="di_code"></td>
                        <td colspan="3">Статус списания<br><input type="text" name="writeoff_status"></td>
                    </tr>

                    <tr>
                        <td colspan="11"><strong>55 Перегрузка</strong></td>
                    </tr>
                    <tr>
                        <td>Место и страна</td>
                        <td colspan="3"><input type="text" name="reload_place_country"></td>
                        <td colspan="2">Идент. рег. нового ТС<br><input type="text" name="new_ts_reg"></td>
                        <td>К...<br><input type="checkbox" name="reload_checkbox"></td>
                        <td colspan="3">(1) № нового контейнера<br><input type="text" name="new_container_no"></td>
                    </tr>
                    <tr>
                        <td colspan="11">(1) Указать 1 если ДА или 0 если НЕТ</td>
                    </tr>

                    <tr>
                        <td colspan="11"><strong>F ПОДТВЕРЖДЕНИЕ КОМПЕТЕНТНЫХ ОРГАНОВ</strong></td>
                    </tr>
                    <tr>
                        <td>Новые пломбы № officer<br><input type="text" name="new_seal_officer"></td>
                        <td>Идент.<br><input type="text" name="new_seal_id"></td>
                        <td>office<br><input type="text" name="new_office"></td>
                        <td colspan="8">ИДК не пройден!</td>
                    </tr>

                    <tr>
                        <td colspan="4">50 Принципал №<br><input type="text" name="principal_code"></td>
                        <td colspan="3">Подпись<br><input type="text" name="principal_signature"></td>
                        <td colspan="4">С ОРГАН ОТПРАВЛЕНИЯ</td>
                    </tr>

                    <tr>
                        <td>51 Намер. органы транзита</td>
                        <td colspan="4"><input type="text" name="transit_authorities"></td>
                        <td colspan="6">Представленный: Место и дата<br><input type="text" name="represent_place_date"></td>
                    </tr>

                    <tr>
                        <td>52 Гарантия</td>
                        <td colspan="3"><input type="text" name="guarantee_code"></td>
                        <td colspan="7"><input type="text" name="guarantee_amount"></td>
                    </tr>

                    <tr>
                        <td colspan="11"><strong>D ОТМЕТКИ ОРГАНА ОТПРАВЛЕНИЯ</strong></td>
                    </tr>
                    <tr>
                        <td>Результат<br><input type="text" name="export_result"></td>
                        <td colspan="2">Кол-во и тип пломб<br><input type="text" name="seal_count_type"></td>
                        <td>№ пломбы<br><input type="text" name="seal_number"></td>
                        <td>Срок транзита (дн.)<br><input type="text" name="transit_days"></td>
                        <td>Срок транзита (дата)<br><input type="date" name="transit_date"></td>
                        <td colspan="4">Имя сотрудника таможни<br><input type="text" name="officer_name"></td>
                    </tr>

                    <tr>
                        <td colspan="11"><strong>I КОНТРОЛЬ ОРГАНА НАЗНАЧЕНИЯ</strong></td>
                    </tr>
                    <tr>
                        <td>Дата прибытия<br><input type="date" name="control_arrival_date"></td>
                        <td>Проверка пломб<br><input type="text" name="seal_inspection"></td>
                        <td>Дата подтв.<br><input type="date" name="confirm_date"></td>
                        <td>№ подтв.<br><input type="text" name="confirmation_no"></td>
                        <td colspan="6">Комм.<br><textarea name="comments" rows="1"></textarea></td>
                    </tr>
                    <tr>
                        <td>Подпись<br><input type="text" name="control_signature"></td>
                        <td colspan="3">Печать<br><input type="text" name="control_seal"></td>
                        <td colspan="6"></td>
                    </tr>
                </table>
            </div>

            <div class="tab-pane fade" id="tab-1821" role="tabpanel">
                <div class="section-title">Графы 18,21</div>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Графа 18 – Транспорт</th>
                            <th>reg № ТС</th>
                            <th>Номер прицепа</th>
                            <th>Страна</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><input type="text" name="tpt_flg"></td>
                            <td><input type="text" name="tpt_trk"></td>
                            <td><input type="text" name="tpt_trl"></td>
                            <td><input type="text" name="tpt_cty"></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td><input type="text" name="transport2_mode"></td>
                            <td><input type="text" name="transport2_reg"></td>
                            <td><input type="text" name="transport2_trailer"></td>
                            <td><input type="text" name="transport2_country"></td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="tab-44" role="tabpanel">
                <div class="section-title">Графа 44: Прилагаемые документы</div>
                <table class="table table-bordered">
                    <tr>
                        <td>Тип ТД</td>
                        <td><input type="text" name="td_type"></td>
                        <td>Справ. номер ТО</td>
                        <td><input type="text" name="control_office_reference"></td>
                        <td colspan="2">Идентификация декларации</td>
                        <td>Спр. номер декларанта</td>
                        <td><input type="text" name="declarant_reference" value="2025"></td>
                        <td>К-во товаров</td>
                        <td><input type="text" name="goods_count"></td>
                    </tr>
                    <tr>
                        <td>Декларант</td>
                        <td colspan="3"><input type="text" name="declarant_code_tab44"></td>
                        <td colspan="6"><textarea name="declarant_name_tab44" rows="2"></textarea></td>
                    </tr>
                    <tr>
                        <td colspan="10">КАЗАХСТАН, ТУРКЕСТАНСКАЯ ОБЛ.</td>
                    </tr>
                </table>
                <button type="button" class="btn btn-sm btn-primary">Добавить запись</button>
            </div>

            <div class="tab-pane fade" id="tab-scan" role="tabpanel">
                <div class="section-title">ТД – Сканированные документы</div>
                <div class="row mb-2">
                    <div class="col-md-3"><input type="file" name="attach_doc1" multiple></div>
                    <div class="col-md-9 text-end"><button type="button" class="btn btn-sm btn-success">Загрузить</button>
                    </div>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Название файла</th>
                            <th>Статус</th>
                        </tr>
                    </thead>
                    <tbody id="scanned-list"></tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="tab-analysis" role="tabpanel">
                <div class="section-title">Вид контроля: Таможенный</div>
                <textarea name="analysis_instructions" rows="3"></textarea>
                <table class="table table-bordered mt-2">
                    <thead>
                        <tr>
                            <th>№</th>
                            <th>Вид контроля</th>
                            <th>Комментарий</th>
                            <th>Код инспектора</th>
                            <th>ФИО УДЛ</th>
                            <th>Время</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>

            <div class="tab-pane fade" id="tab-fee" role="tabpanel">
                <div class="section-title">Информация о платежах</div>
                <div class="form-check mb-2">
                    <input class="form-check-input" type="checkbox" id="third-party-payment" name="third_party_payment">
                    <label class="form-check-label" for="third-party-payment">Оплата третьим лицом</label>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Товар</th>
                            <th>Вид платежа</th>
                            <th>Описание</th>
                            <th>Код</th>
                            <th>Сумма к оплате</th>
                            <th>Сумма к возврату</th>
                            <th>Способ</th>
                            <th>Номер док.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><input name="payment_item"></td>
                            <td><input name="payment_type"></td>
                            <td><input name="payment_description"></td>
                            <td><input name="payment_code"></td>
                            <td><input name="payment_amount"></td>
                            <td><input name="payment_return"></td>
                            <td><input name="payment_method"></td>
                            <td><input name="payment_doc_number"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <button type="submit" class="btn btn-success mt-3">Сохранить документ</button>
    </form>
@endsection