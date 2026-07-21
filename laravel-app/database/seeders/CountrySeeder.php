<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountrySeeder extends Seeder
{
    public function run()
    {
        $countries = [
            // Europa Occidental
            ['id' => 'es', 'name' => 'Espanya'],
            ['id' => 'fr', 'name' => 'France'],
            ['id' => 'de', 'name' => 'Alemanya'],
            ['id' => 'it', 'name' => 'Itàlia'],
            ['id' => 'pt', 'name' => 'Portugal'],
            ['id' => 'ie', 'name' => 'Irlanda'],
            ['id' => 'gb', 'name' => 'Regne Unit'],
            ['id' => 'nl', 'name' => 'Països Baixos'],
            ['id' => 'be', 'name' => 'Bèlgica'],
            ['id' => 'lu', 'name' => 'Luxemburg'],
            ['id' => 'ch', 'name' => 'Suïssa'],
            ['id' => 'at', 'name' => 'Àustria'],
            ['id' => 'li', 'name' => 'Liechtenstein'],
            ['id' => 'mc', 'name' => 'Mònaco'],
            ['id' => 'ad', 'name' => 'Andorra'],
            
            // Europa del Norte (Escandinavia)
            ['id' => 'se', 'name' => 'Suècia'],
            ['id' => 'no', 'name' => 'Noruega'],
            ['id' => 'dk', 'name' => 'Dinamarca'],
            ['id' => 'fi', 'name' => 'Finlàndia'],
            ['id' => 'is', 'name' => 'Islàndia'],
            ['id' => 'fo', 'name' => 'Illes Fèroe'],
            
            // Países Bálticos
            ['id' => 'lt', 'name' => 'Lituània'],
            ['id' => 'lv', 'name' => 'Letònia'],
            ['id' => 'ee', 'name' => 'Estònia'],
            
            // Europa Central
            ['id' => 'pl', 'name' => 'Polònia'],
            ['id' => 'cz', 'name' => 'República Txeca'],
            ['id' => 'sk', 'name' => 'Eslovàquia'],
            ['id' => 'hu', 'name' => 'Hongria'],
            ['id' => 'si', 'name' => 'Eslovènia'],
            ['id' => 'hr', 'name' => 'Croàcia'],
            ['id' => 'rs', 'name' => 'Sèrbia'],
            ['id' => 'ba', 'name' => 'Bòsnia i Hercegovina'],
            ['id' => 'me', 'name' => 'Montenegro'],
            ['id' => 'mk', 'name' => 'Macedònia del Nord'],
            ['id' => 'al', 'name' => 'Albània'],
            
            // Europa del Este
            ['id' => 'ru', 'name' => 'Rússia'],
            ['id' => 'ua', 'name' => 'Ucraïna'],
            ['id' => 'by', 'name' => 'Belarús'],
            ['id' => 'md', 'name' => 'Moldàvia'],
            ['id' => 'ro', 'name' => 'Romania'],
            ['id' => 'bg', 'name' => 'Bulgària'],
            ['id' => 'ge', 'name' => 'Geòrgia'],
            ['id' => 'am', 'name' => 'Armènia'],
            ['id' => 'az', 'name' => 'Azerbaidjan'],
            
            // Mediterráneo y Sur de Europa
            ['id' => 'gr', 'name' => 'Grècia'],
            ['id' => 'tr', 'name' => 'Turquia'],
            ['id' => 'cy', 'name' => 'Xipre'],
            ['id' => 'mt', 'name' => 'Malta'],
            ['id' => 'sm', 'name' => 'San Marino'],
            ['id' => 'va', 'name' => 'Ciutat del Vaticà'],
            
            // Micro-estados no reconocidos o dependencias
            ['id' => 'gg', 'name' => 'Guernsey'],
            ['id' => 'je', 'name' => 'Jersey'],
            ['id' => 'im', 'name' => 'Illa de Man'],
            ['id' => 'gi', 'name' => 'Gibraltar'],
        ];

        foreach ($countries as $country) {
            Country::updateOrCreate(
                ['id' => $country['id']],
                ['name' => $country['name']]
            );
        }

    }
}
