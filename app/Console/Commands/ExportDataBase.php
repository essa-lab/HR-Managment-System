<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
class ExportDataBase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:export';

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
        $employee =json_decode(DB::table('employees')
        ->select('*')->get(),true);
        $jobs =json_decode(DB::table('jobs')
        ->select('*')->get(),true);
        $empStatues =json_decode(DB::table('employess_statuses')
        ->select('*')->get(),true);


        $filename = "emp.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('name', 'age', 'gender', 'hire_date','created_at','updated_at'));

        foreach($employee as $row) {

            fputcsv($handle, array($row['name'], $row['age'], $row['gender'], $row['hire_date'],$row['created_at'],$row['updated_at']));
        }

        fclose($handle);

        $headers = array(
        'Content-Type' => 'text/csv',
        );
        Response::download($filename, 'emp.csv', $headers);
        //jobs
        $filename = "jobs.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('name','created_at','updated_at'));

        foreach($jobs as $row) {

            fputcsv($handle, array($row['job_name'],$row['created_at'],$row['updated_at']));
        }

        fclose($handle);

        $headers = array(
        'Content-Type' => 'text/csv',
        );
        Response::download($filename, 'jobs.csv', $headers);

        //EMPStatues
        $filename = "empStatus.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('emp_ID', 'job_id', 'Manager_id', 'salary','created_at','updated_at'));

        foreach($empStatues as $row) {

            fputcsv($handle, array($row['emp_id'], $row['job_id'], $row['manager_id'], $row['salary'],$row['created_at'],$row['updated_at']));
        }

        fclose($handle);

        $headers = array(
        'Content-Type' => 'text/csv',
        );
        Response::download($filename, 'empStatus.csv', $headers);

        return 1;
    }
}
