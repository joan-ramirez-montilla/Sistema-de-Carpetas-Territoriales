<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\PeopleImport;

class ImportPeople extends Command
{
    protected $signature = 'import:people';
    protected $description = 'Importar personas desde Excel';

    public function handle()
    {
        Excel::import(
            new PeopleImport,
            storage_path('people.xlsx')
        );

        $this->info('Importación de personas completada');
    }
}
