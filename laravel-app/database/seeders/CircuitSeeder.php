<?php

namespace Database\Seeders;

use App\Models\Circuit;
use Illuminate\Database\Seeder;

class CircuitSeeder extends Seeder
{
    public function run(): void
    {
        $circuits = [
            ['name' => 'Circuit de Barcelona-Catalunya', 'country_id' => 'es', 'location' => 'Montmeló, Barcelona', 'length' => 4.657, 'turns' => 16, 'capacity' => 140700],
            ['name' => 'Circuit de Monaco', 'country_id' => 'mc', 'location' => 'Monte Carlo', 'length' => 3.337, 'turns' => 19, 'capacity' => 37000],
            ['name' => 'Autodromo Nazionale Monza', 'country_id' => 'it', 'location' => 'Monza, Itàlia', 'length' => 5.793, 'turns' => 11, 'capacity' => 118865],
            ['name' => 'Silverstone Circuit', 'country_id' => 'gb', 'location' => 'Northamptonshire, Anglaterra', 'length' => 5.891, 'turns' => 18, 'capacity' => 150000],
            ['name' => 'Circuit de Spa-Francorchamps', 'country_id' => 'be', 'location' => 'Stavelot, Bèlgica', 'length' => 7.004, 'turns' => 19, 'capacity' => 120000],
            ['name' => 'Nürburgring Nordschleife', 'country_id' => 'de', 'location' => 'Nürburg, Alemanya', 'length' => 20.832, 'turns' => 154, 'capacity' => 150000],
            ['name' => 'Circuit de la Sarthe', 'country_id' => 'fr', 'location' => 'Le Mans, França', 'length' => 13.626, 'turns' => 38, 'capacity' => 250000],
            ['name' => 'Circuit Zandvoort', 'country_id' => 'nl', 'location' => 'Zandvoort, Països Baixos', 'length' => 4.259, 'turns' => 14, 'capacity' => 105000],
            ['name' => 'Autódromo do Algarve', 'country_id' => 'pt', 'location' => 'Portimão, Portugal', 'length' => 4.653, 'turns' => 15, 'capacity' => 45000],
            ['name' => 'Red Bull Ring', 'country_id' => 'at', 'location' => 'Spielberg, Àustria', 'length' => 4.318, 'turns' => 10, 'capacity' => 95000],
            ['name' => 'Hungaroring', 'country_id' => 'hu', 'location' => 'Mogyoród, Hongria', 'length' => 4.381, 'turns' => 14, 'capacity' => 70000],
            ['name' => 'Autodrom Brno', 'country_id' => 'cz', 'location' => 'Brno, República Txeca', 'length' => 5.403, 'turns' => 14, 'capacity' => 50000],
            ['name' => 'Transilvania Motor Ring', 'country_id' => 'ro', 'location' => 'Târgu Mureș, Romania', 'length' => 3.800, 'turns' => 12, 'capacity' => 20000],
            ['name' => 'Athens Circuit', 'country_id' => 'gr', 'location' => 'Atenes, Grècia', 'length' => 3.200, 'turns' => 10, 'capacity' => 15000],
            ['name' => 'Grobnicka', 'country_id' => 'hr', 'location' => 'Rijeka, Croàcia', 'length' => 2.800, 'turns' => 9, 'capacity' => 12000],
            ['name' => 'Scandinavian Raceway', 'country_id' => 'se', 'location' => 'Anderstorp, Suècia', 'length' => 4.025, 'turns' => 8, 'capacity' => 30000],
            ['name' => 'Kymi Ring', 'country_id' => 'fi', 'location' => 'Iitti, Finlàndia', 'length' => 4.600, 'turns' => 12, 'capacity' => 25000],
            ['name' => 'Jyllandsringen', 'country_id' => 'dk', 'location' => 'Silkeborg, Dinamarca', 'length' => 2.400, 'turns' => 7, 'capacity' => 15000],
            ['name' => 'Rudskogen Motorsenter', 'country_id' => 'no', 'location' => 'Halden, Noruega', 'length' => 3.300, 'turns' => 10, 'capacity' => 18000],
        ];

        // Insertar todos sin duplicados
        foreach ($circuits as $circuit) {
            Circuit::firstOrCreate(
                ['name' => $circuit['name']],
                $circuit
            );
        }
    }
}
