<?php

namespace App\Console\Commands;

use File;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
class ExportDataBaseJSON extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:export-json';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Exporting DataBase...';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $employee =DB::table('employees')
        ->select('*')->get();
	    $fileName = 'employee_json.json';
	    File::put($fileName,$employee);
	    Response::download($fileName);

        return 1;
    }
}
