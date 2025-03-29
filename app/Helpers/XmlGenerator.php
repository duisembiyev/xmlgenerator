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

            $type = $xml->addChild('Type');
            $type->addChild('Type_of_declaration', $docData['type_of_declaration'] ?? '');
            $type->addChild('Declaration_gen_procedure_code', $docData['declaration_gen_procedure_code'] ?? '');
            $type->addChild('Type_of_transit_document2', $docData['type_of_transit_document2'] ?? '');
            $type->addChild('Type_of_transit_document3', $docData['transit_document3'] ?? '');

            $xml->addChild('Manifest_reference_number', $docData['manifest_reference_number'] ?? '');
            $xml->addChild('External_flag', $docData['external_flag'] ?? '');
            $xml->addChild('Non_conform_flag', $docData['non_conform_flag'] ?? '');

            $invoice = $xml->addChild('Invoice');
            $invoice->addChild('Invoice_Amount', $docData['invoice_amount'] ?? '');
            $invoice->addChild('Invoice_Currency_Code', $docData['invoice_currency'] ?? '');

        }

        return $root->asXML();
    }
}
