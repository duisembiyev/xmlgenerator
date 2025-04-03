<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\FormType;

class FormTypeSeeder extends Seeder
{
    public function run()
    {
        if (FormType::where('type', 'MainForm')->exists()) {
            return;
        }

        FormType::create([
            'type'       => 'MainForm',
            'addionals'  => [
                'fields' => [
                    ['name' => 'title', 'label' => 'Заголовок', 'type' => 'text'],
                    ['name' => 'description', 'label' => 'Описание', 'type' => 'textarea'],
                ]
            ],
            'created_by' => 'system'
        ]);
    }
}
