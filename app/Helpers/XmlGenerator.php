<?php

if (! function_exists('generateAsycudaXml')) {
    /**
     * @param array $data
     * @return string
     */
    function generateAsycudaXml(array $data = [])
    {
        $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" standalone="no"?><ASYCUDA></ASYCUDA>');

        $node = $xml->addChild('Spec_circumstance_indicator_code');
        $node->addChild('null');

        $node = $xml->addChild('Spec_circumstance_indicator_name');
        $node->addChild('null');

        $xml->addChild('Total_gross_mass_kg', $data['total_gross_mass'] ?? '9095.3');

        $xml->addChild('Unique_consignment_trsp_refer_no')->addChild('null');
        $xml->addChild('Notify_party_code')->addChild('null');
        $xml->addChild('Notify_party_name')->addChild('null');

        $xml->addChild('Arrival_on_customs_territory_date');
        $xml->addChild('Arrival_on_customs_territory_time');

        $xml->addChild('Office_transit_code_1')->addChild('null');
        $xml->addChild('Country_transit_code_1')->addChild('null');
        $xml->addChild('Date_transit_1');
        $xml->addChild('Office_transit_code_2')->addChild('null');
        $xml->addChild('Country_transit_code_2')->addChild('null');
        $xml->addChild('Date_transit_2');
        $xml->addChild('Office_transit_code_3')->addChild('null');
        $xml->addChild('Country_transit_code_3')->addChild('null');
        $xml->addChild('Date_transit_3');
        $xml->addChild('Office_transit_code_4')->addChild('null');
        $xml->addChild('Country_transit_code_4')->addChild('null');
        $xml->addChild('Date_transit_4');

        $property = $xml->addChild('Property');
        $property->addChild('Free_text_for_additional_document')->addChild('null');
        $property->addChild('Sad_flow');
        $forms = $property->addChild('Forms');
        $forms->addChild('Number_of_the_form', '1');
        $forms->addChild('Total_number_of_forms', '1');

        $nbers = $property->addChild('Nbers');
        $nbers->addChild('Number_of_loading_lists', '1');
        $nbers->addChild('Total_number_of_items', '1');
        $nbers->addChild('Total_number_of_packages', '33');
        $nbers->addChild('Total_number_of_consignments', '1');

        $identification = $xml->addChild('Identification');
        $officeSegment = $identification->addChild('Office_segment');
        $officeSegment->addChild('Customs_clearance_office_code')->addChild('null');
        $departureSegment = $officeSegment->addChild('Departure_segment');
        $departureSegment->addChild('Customs_departure_office_code', $data['departure_office'] ?? '39855508');
        $destinationSegment = $officeSegment->addChild('Destination_segment');
        $destinationSegment->addChild('Customs_office_of_destination_code', $data['destination_office'] ?? '10311020');
        $destinationSegment->addChild('Country_of_CUO_of_destination', $data['destination_country'] ?? 'RU');

        $type = $xml->addChild('Type');
        $type->addChild('Type_of_declaration')->addChild('null');
        $type->addChild('Declaration_gen_procedure_code')->addChild('null');
        $type->addChild('Type_of_transit_document2')->addChild('null');
        $type->addChild('Type_of_transit_document3', $data['transit_document3'] ?? 'ИМ');

        $xml->addChild('Manifest_reference_number')->addChild('null');
        $xml->addChild('External_flag', 'false');
        $xml->addChild('Non_conform_flag', 'false');

        $invoice = $xml->addChild('Invoice');
        $invoice->addChild('Invoice_Amount', $data['invoice_amount'] ?? '48533.76');
        $invoice->addChild('Invoice_Currency_Code', $data['invoice_currency'] ?? 'USD');

        return $xml->asXML();
    }
}
