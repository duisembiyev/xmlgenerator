<?php

if (!function_exists('generateAsycudaXml')) {
    /**
     * @param array $documentsData
     * @return string
     */
    function generateAsycudaXml(array $documentsData = [])
    {
        $root = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="no"?><Documents></Documents>');

        foreach ($documentsData as $docData) {
            $xml = $root->addChild('ASYCUDA');

            $xml->addChild('Spec_circumstance_indicator_code', $docData['spec_circumstance_indicator_code'] ?? '');
            $xml->addChild('Spec_circumstance_indicator_name', $docData['spec_circumstance_indicator_name'] ?? '');
            $xml->addChild('Total_gross_mass_kg', $docData['total_gross_mass'] ?? '');
            $xml->addChild('Unique_consignment_trsp_refer_no', $docData['unique_consignment_trsp_refer_no'] ?? '');
            $xml->addChild('Notify_party_code', $docData['notify_party_code'] ?? '');
            $xml->addChild('Notify_party_name', $docData['notify_party_name'] ?? '');
            $xml->addChild('Arrival_on_customs_territory_date', $docData['arrival_date'] ?? '');
            $xml->addChild('Arrival_on_customs_territory_time', $docData['arrival_time'] ?? '');

            for ($i = 1; $i <= 4; $i++) {
                $xml->addChild("Office_transit_code_{$i}", $docData["office_transit_code_{$i}"] ?? '');
                $xml->addChild("Country_transit_code_{$i}", $docData["country_transit_code_{$i}"] ?? '');
                $xml->addChild("Date_transit_{$i}", $docData["date_transit_{$i}"] ?? '');
            }

            $property = $xml->addChild('Property');
            $property->addChild('Free_text_for_additional_document', $docData['free_text_for_additional_document'] ?? '');
            $property->addChild('Sad_flow', $docData['sad_flow'] ?? '');
            $forms = $property->addChild('Forms');
            $forms->addChild('Number_of_the_form', $docData['number_of_the_form'] ?? '');
            $forms->addChild('Total_number_of_forms', $docData['total_number_of_forms'] ?? '');
            $nbers = $property->addChild('Nbers');
            $nbers->addChild('Number_of_loading_lists', $docData['number_of_loading_lists'] ?? '');
            $nbers->addChild('Total_number_of_items', $docData['total_number_of_items'] ?? '');
            $nbers->addChild('Total_number_of_packages', $docData['total_number_of_packages'] ?? '');
            $nbers->addChild('Total_number_of_consignments', $docData['total_number_of_consignments'] ?? '');

            $identification = $xml->addChild('Identification');
            $officeSegment = $identification->addChild('Office_segment');
            $officeSegment->addChild('Customs_clearance_office_code', $docData['customs_clearance_office_code'] ?? '');
            $departureSegment = $officeSegment->addChild('Departure_segment');
            $departureSegment->addChild('Customs_departure_office_code', $docData['departure_office'] ?? '');
            $destinationSegment = $officeSegment->addChild('Destination_segment');
            $destinationSegment->addChild('Customs_office_of_destination_code', $docData['destination_office'] ?? '');
            $destinationSegment->addChild('Country_of_CUO_of_destination', $docData['destination_country'] ?? '');

            $type = $identification->addChild('Type');
            $type->addChild('Type_of_declaration', $docData['type_of_declaration'] ?? '');
            $type->addChild('Declaration_gen_procedure_code', $docData['declaration_gen_procedure_code'] ?? '');
            $type->addChild('Type_of_transit_document2', $docData['type_of_transit_document2'] ?? '');
            $type->addChild('Type_of_transit_document3', $docData['transit_document3'] ?? '');

            $identification->addChild('Manifest_reference_number', $docData['manifest_reference_number'] ?? '');
            $identification->addChild('External_flag', $docData['external_flag'] ?? '');
            $identification->addChild('Non_conform_flag', $docData['non_conform_flag'] ?? '');

            $arrival = $identification->addChild('Arrival');
            $arrival->addChild('Examination_of_seals', $docData['examination_of_seals'] ?? '');
            $arrival->addChild('Remarks', $docData['remarks'] ?? '');
            $arrival->addChild('Date', $docData['arrival_inner_date'] ?? '');
            $planned = $arrival->addChild('Planned');
            $planned->addChild('Date', $docData['planned_date'] ?? '');

            $reg = $identification->addChild('Registration_from_declaration');
            $reg->addChild('Serial_number_from_declaration', $docData['serial_number_from_declaration'] ?? '');
            $reg->addChild('Number_from_declaration', $docData['number_from_declaration'] ?? '');
            $reg->addChild('Date_from_declaration', $docData['date_from_declaration'] ?? '');

            $assessment = $identification->addChild('Assessment');
            $assessment->addChild('Serial_number', $docData['assessment_serial_number'] ?? '');
            $assessment->addChild('Number', $docData['assessment_number'] ?? '');
            $assessment->addChild('Date', $docData['assessment_date'] ?? '');

            $termination = $identification->addChild('Termination');
            $termination->addChild('Date', $docData['termination_date'] ?? '');

            $invoice = $xml->addChild('Invoice');
            $invoice->addChild('Invoice_Amount', $docData['invoice_amount'] ?? '');
            $invoice->addChild('Invoice_Currency_Code', $docData['invoice_currency'] ?? '');

            $traders = $xml->addChild('Traders');

            $exporter = $traders->addChild('Exporter');
            $exporter->addChild('Exporter_code', $docData['exporter_code'] ?? '');
            $exporter->addChild('EXPORTER_name', $docData['exporter_name'] ?? '');
            $exporter->addChild('EXPORTER_ctyCod', $docData['exporter_ctyCod'] ?? '');
            $exporter->addChild('EXPORTER_regDsc', $docData['exporter_regDsc'] ?? '');
            $exporter->addChild('EXPORTER_regCod', $docData['exporter_regCod'] ?? '');
            $exporter->addChild('EXPORTER_catCod', $docData['exporter_catCod'] ?? '');
            $exporter->addChild('EXPORTER_street', $docData['exporter_street'] ?? '');
            $exporter->addChild('EXPORTER_city', $docData['exporter_city'] ?? '');

            $consignee = $traders->addChild('Consignee');
            $consignee->addChild('Consignee_code', $docData['consignee_code'] ?? '');
            $consignee->addChild('CONSIGNEE_name', $docData['consignee_name'] ?? '');
            $consignee->addChild('CONSIGNEE_ctyCod', $docData['consignee_ctyCod'] ?? '');
            $consignee->addChild('CONSIGNEE_regDsc', $docData['consignee_regDsc'] ?? '');
            $consignee->addChild('CONSIGNEE_regCod', $docData['consignee_regCod'] ?? '');
            $consignee->addChild('CONSIGNEE_catCod', $docData['consignee_catCod'] ?? '');
            $consignee->addChild('CONSIGNEE_street', $docData['consignee_street'] ?? '');
            $consignee->addChild('CONSIGNEE_city', $docData['consignee_city'] ?? '');

            $deliveryParty = $traders->addChild('Delivery_Party');
            $deliveryParty->addChild('Delivery_Party_code', $docData['delivery_party_code'] ?? '');
            $deliveryParty->addChild('CARRIER_name', $docData['carrier_name'] ?? '');
            $deliveryParty->addChild('CARRIER_ctyCod', $docData['carrier_ctyCod'] ?? '');
            $deliveryParty->addChild('CARRIER_regDsc', $docData['carrier_regDsc'] ?? '');
            $deliveryParty->addChild('CARRIER_regCod', $docData['carrier_regCod'] ?? '');
            $deliveryParty->addChild('CARRIER_catCod', $docData['carrier_catCod'] ?? '');
            $deliveryParty->addChild('CARRIER_street', $docData['carrier_street'] ?? '');
            $deliveryParty->addChild('CARRIER_city', $docData['carrier_city'] ?? '');

            $xml->addChild('Driver', $docData['driver'] ?? '');

            $declarant = $xml->addChild('Declarant');
            $declarant->addChild('Declarant_code', $docData['declarant_code'] ?? '');
            $declarant->addChild('DECLARANT_name', $docData['declarant_name'] ?? '');
            $declarant->addChild('DECLARANT_ctyCod', $docData['declarant_ctyCod'] ?? '');
            $declarant->addChild('DECLARANT_regDsc', $docData['declarant_regDsc'] ?? '');
            $declarant->addChild('DECLARANT_regCod', $docData['declarant_regCod'] ?? '');
            $declarant->addChild('DECLARANT_catCod', $docData['declarant_catCod'] ?? '');
            $declarant->addChild('DECLARANT_street', $docData['declarant_street'] ?? '');
            $declarant->addChild('DECLARANT_city', $docData['declarant_city'] ?? '');
            $declarant->addChild('Declarant_representative', $docData['declarant_representative'] ?? '');
            $reference = $declarant->addChild('Reference');
            $reference->addChild('Year', $docData['reference_year'] ?? '');
            $reference->addChild('Number', $docData['reference_number'] ?? '');

            $generalInfo = $xml->addChild('General_information');
            $country = $generalInfo->addChild('Country');
            $export = $country->addChild('Export');
            $export->addChild('Export_country_code', $docData['export_country_code'] ?? '');
            $destination = $country->addChild('Destination');
            $destination->addChild('Destination_country_code', $docData['destination_country_code'] ?? '');

            $transport = $xml->addChild('Transport');
            $means = $transport->addChild('Means_of_transport');
            $border = $means->addChild('Border_information');
            $border->addChild('Mode', $docData['transport_mode'] ?? '');
            $transport->addChild('Container_flag', $docData['container_flag'] ?? '');
            $transport->addChild('Container_flag_additional', $docData['container_flag_additional'] ?? '');
            $place = $transport->addChild('Place_of_loading');
            $place->addChild('Code', $docData['place_of_loading_code'] ?? '');

            $financial = $xml->addChild('Financial');
            $guarantee = $financial->addChild('Guarantee');
            $guarantee->addChild('Code', $docData['guarantee_code'] ?? '');
            $guarantee->addChild('Amount', $docData['guarantee_amount'] ?? '');
            $guarantee->addChild('Country', $docData['guarantee_country'] ?? '');
            $guarantee->addChild('MOG', $docData['mog'] ?? '');

            $incident1 = $xml->addChild('Incident_1');
            $mt1 = $incident1->addChild('Means_of_transport');
            $mt1->addChild('Identity', $docData['incident1_mt_identity'] ?? '');
            $mt1->addChild('Nationality', $docData['incident1_mt_nationality'] ?? '');
            $container1 = $incident1->addChild('Container_segment');
            $container1->addChild('Container_flag', $docData['incident1_container_flag'] ?? '');
            $container1->addChild('Identity', $docData['incident1_container_identity'] ?? '');
            $seals1 = $incident1->addChild('Seals');
            $seals1->addChild('Number', $docData['incident1_seals_number'] ?? '');
            $seals1->addChild('Identity', $docData['incident1_seals_identity'] ?? '');
            $incident1->addChild('Date', $docData['incident1_date'] ?? '');
            $incident1->addChild('Place', $docData['incident1_place'] ?? '');
            $incident1->addChild('Country', $docData['incident1_country'] ?? '');

            $incident2 = $xml->addChild('Incident_2');
            $mt2 = $incident2->addChild('Means_of_transport');
            $mt2->addChild('Identity', $docData['incident2_mt_identity'] ?? '');
            $mt2->addChild('Nationality', $docData['incident2_mt_nationality'] ?? '');
            $container2 = $incident2->addChild('Container_segment');
            $container2->addChild('Container_flag', $docData['incident2_container_flag'] ?? '');
            $container2->addChild('Identity', $docData['incident2_container_identity'] ?? '');
            $seals2 = $incident2->addChild('Seals');
            $seals2->addChild('Number', $docData['incident2_seals_number'] ?? '');
            $seals2->addChild('Identity', $docData['incident2_seals_identity'] ?? '');
            $incident2->addChild('Date', $docData['incident2_date'] ?? '');
            $incident2->addChild('Place', $docData['incident2_place'] ?? '');
            $incident2->addChild('Country', $docData['incident2_country'] ?? '');

            $transit = $xml->addChild('Transit');
            $principal = $transit->addChild('Principal');
            $principal->addChild('Code', $docData['principal_code'] ?? '');
            $principal->addChild('PRINCIPAL_name', $docData['principal_name'] ?? '');
            $principal->addChild('PRINCIPAL_ctyCod', $docData['principal_ctyCod'] ?? '');
            $principal->addChild('PRINCIPAL_regDsc', $docData['principal_regDsc'] ?? '');
            $principal->addChild('PRINCIPAL_regCod', $docData['principal_regCod'] ?? '');
            $principal->addChild('PRINCIPAL_catCod', $docData['principal_catCod'] ?? '');
            $principal->addChild('PRINCIPAL_street', $docData['principal_street'] ?? '');
            $principal->addChild('PRINCIPAL_city', $docData['principal_city'] ?? '');
            $principal->addChild('Representative', $docData['principal_representative'] ?? '');
            $signature = $transit->addChild('Signature');
            $signature->addChild('Place', $docData['transit_signature_place'] ?? '');
            $signature->addChild('Date', $docData['transit_signature_date'] ?? '');
            $sealsTransit = $transit->addChild('Seals');
            $sealsTransit->addChild('Number', $docData['transit_seals_number'] ?? '');
            $sealsTransit->addChild('Type', $docData['transit_seals_type'] ?? '');
            $sealsTransit->addChild('Identity', $docData['transit_seals_identity'] ?? '');
            $transit->addChild('Incidents', $docData['transit_incidents'] ?? '');
            $transit->addChild('Result_of_control', $docData['result_of_control'] ?? '');
            $transit->addChild('Time_limit', $docData['time_limit'] ?? '');

            $images = $xml->addChild('Images');
            $images->addChild('NI1', $docData['ni1'] ?? '');
            $images->addChild('NI2', $docData['ni2'] ?? '');
            $images->addChild('AttachDoc1', $docData['attach_doc1'] ?? '');
            $images->addChild('AttachDoc2', $docData['attach_doc2'] ?? '');
            $images->addChild('AttachDoc3', $docData['attach_doc3'] ?? '');
            $images->addChild('AttachDoc4', $docData['attach_doc4'] ?? '');
            $images->addChild('Driver1', $docData['driver1'] ?? '');
            $images->addChild('Driver2', $docData['driver2'] ?? '');
            $images->addChild('Seal', $docData['seal'] ?? '');

            $item = $xml->addChild('Item');
            $item->addChild('Consignment_number', $docData['consignment_number'] ?? '');
            $item->addChild('Is_new_consignment', $docData['is_new_consignment'] ?? '');
            
            $itemConsignee = $item->addChild('Consignee');
            $itemConsignee->addChild('Consignee_code', $docData['item_consignee_code'] ?? '');
            $itemConsignee->addChild('CONSIGNEE_name', $docData['item_consignee_name'] ?? '');
            $itemConsignee->addChild('CONSIGNEE_ctyCod', $docData['item_consignee_ctyCod'] ?? '');
            $itemConsignee->addChild('CONSIGNEE_regDsc', $docData['item_consignee_regDsc'] ?? '');
            $itemConsignee->addChild('CONSIGNEE_regCod', $docData['item_consignee_regCod'] ?? '');
            $itemConsignee->addChild('CONSIGNEE_catCod', $docData['item_consignee_catCod'] ?? '');
            $itemConsignee->addChild('CONSIGNEE_street', $docData['item_consignee_street'] ?? '');
            $itemConsignee->addChild('CONSIGNEE_city', $docData['item_consignee_city'] ?? '');
            
            $itemExporter = $item->addChild('Exporter');
            $itemExporter->addChild('Exporter_code', $docData['item_exporter_code'] ?? '');
            $itemExporter->addChild('EXPORTER_name', $docData['item_exporter_name'] ?? '');
            $itemExporter->addChild('EXPORTER_ctyCod', $docData['item_exporter_ctyCod'] ?? '');
            $itemExporter->addChild('EXPORTER_regDsc', $docData['item_exporter_regDsc'] ?? '');
            $itemExporter->addChild('EXPORTER_regCod', $docData['item_exporter_regCod'] ?? '');
            $itemExporter->addChild('EXPORTER_catCod', $docData['item_exporter_catCod'] ?? '');
            $itemExporter->addChild('EXPORTER_street', $docData['item_exporter_street'] ?? '');
            $itemExporter->addChild('EXPORTER_city', $docData['item_exporter_city'] ?? '');
            
            $item->addChild('Dangerous_goods_code', $docData['dangerous_goods_code'] ?? '');
            $item->addChild('Dangerous_goods_name', $docData['dangerous_goods_name'] ?? '');
            
            $packages = $item->addChild('Packages');
            $packages->addChild('Number_of_packages', $docData['number_of_packages'] ?? '');
            $packages->addChild('Marks1_of_packages', $docData['marks1_of_packages'] ?? '');
            $packages->addChild('Kind_of_packages_code', $docData['kind_of_packages_code'] ?? '');
            
            $tarification = $item->addChild('Tarification');
            $hscode = $tarification->addChild('HScode');
            $hscode->addChild('Commodity_code', $docData['commodity_code'] ?? '');
            $tarification->addChild('Unit_of_measure_code', $docData['unit_of_measure_code'] ?? '');
            $tarification->addChild('Quantity', $docData['quantity'] ?? '');
            $tarification->addChild('Item_currency_code', $docData['item_currency_code'] ?? '');
            $tarification->addChild('Item_price', $docData['item_price'] ?? '');
            
            if (!empty($docData['attached_documents']) && is_array($docData['attached_documents'])) {
                foreach ($docData['attached_documents'] as $attachedDoc) {
                    $attached = $item->addChild('Attached_documents');
                    $attached->addChild('Attached_document_code', $attachedDoc['code'] ?? '');
                    $attached->addChild('Attached_document_reference', $attachedDoc['reference'] ?? '');
                    $attached->addChild('Attached_document_date', $attachedDoc['date'] ?? '');
                }
            } else {
                $attached = $item->addChild('Attached_documents');
                $attached->addChild('Attached_document_code', $docData['attached_document_code'] ?? '');
                $attached->addChild('Attached_document_reference', $docData['attached_document_reference'] ?? '');
                $attached->addChild('Attached_document_date', $docData['attached_document_date'] ?? '');
            }
            
            $goods = $item->addChild('Goods_description');
            $goods->addChild('Container_1', $docData['container_1'] ?? '');
            $goods->addChild('Container_2', $docData['container_2'] ?? '');
            $goods->addChild('Description_of_goods', $docData['description_of_goods'] ?? '');
            $goods->addChild('Commercial_Description', $docData['commercial_description'] ?? '');
            
            $prevDoc = $item->addChild('Previous_documents');
            $prevDoc->addChild('PrevDocCod', $docData['prev_doc_cod'] ?? '');
            $prevDoc->addChild('PrevDocNbr', $docData['prev_doc_nbr'] ?? '');
            $prevDoc->addChild('PrevDocDat', $docData['prev_doc_dat'] ?? '');
            $prevDoc->addChild('PrevDocMan', $docData['prev_doc_man'] ?? '');
            $prevDoc->addChild('PrevDocNational', $docData['prev_doc_national'] ?? '');
            
            $valuation = $item->addChild('Valuation_item');
            $weight = $valuation->addChild('Weight_itm');
            $weight->addChild('Gross_weight_itm', $docData['gross_weight_itm'] ?? '');
            $weight->addChild('Net_weight_itm', $docData['net_weight_itm'] ?? '');
            
            $xml->addChild('Entry_office_code', $docData['entry_office_code'] ?? '');
            
            $transportMultiple = $xml->addChild('TransportMultiple');
            $transportMultiple->addChild('TptFlg', $docData['tpt_flg'] ?? '');
            $transportMultiple->addChild('TptTrk', $docData['tpt_trk'] ?? '');
            $transportMultiple->addChild('TptTrl', $docData['tpt_trl'] ?? '');
            $transportMultiple->addChild('TptCty', $docData['tpt_cty'] ?? '');
        }

        return $root->asXML();
    }
}
