<?php
namespace App;
use App\Models\employessStatus;
use App\Models\employees;
use App\Models\jobs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Service{
    public function show($id){

        $empStatus = employessStatus::find($id);
        $job = jobs::find($empStatus->job_id);
        $emp = employees::find($empStatus->emp_id);

        return [
            'name'=>$emp->name,
            'age'=>$emp->age,
            'salaray'=>$empStatus->salary,
            'gender'=>$emp->gender,
            'hired_date'=>$emp->hire_date,
            'job_title'=>$job->job_name,
        ];
    }
    public function getManagers($id){
        $emp = employessStatus::find($id);
        $managers =[];
        while(!is_null($emp->manager_id)){
            $manager = employees::find((string)$emp->manager_id);
            array_unshift($managers,["name"=>$manager->name,"id"=>$manager->id]);
            $id = $manager->id;
            $emp = employessStatus::find($id);
        }
        return $managers;
    }
    public function getManagerSalaries($id){
        $managers = $this->getManagers($id);
        $ids = array_column($managers, 'id');
        $managersSalaries = json_decode(DB::table('employess_statuses')->select('emp_id as id','salary')->whereIn('emp_id',$ids)->get());

        $result = array_merge( $managers, $managersSalaries );
        $result= array_group_by($result,'id');
        $obj_merged=[];
        foreach ($result as $res){
            array_push($obj_merged,(object) array_merge((array) $res[0], (array) $res[1]));
        }
        return $obj_merged;
    }
    public function getEmployeesByQuery($query){
        $emp = employees::where('name','like','%'.$query.'%')->paginate(10);
        return $emp;
    }
}
