<?php

namespace App\Http\Controllers\API;

use App\Imports\ImportEmployee;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Employees;
use App\Http\Resources\employee as EmployeeResource;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Facades\Excel;
use Validator;
class EmployeeController extends BaseController{
    public function index(){
        $employee = Employees::all();
        return $this->sendResponse(EmployeeResource::collection($employee),'Employee retrive Successfully.');
    }
    public function show($id){
        $employee = Employees::find($id);
        if(is_null($employee)){
            return $this->sendError('Employee Not Found!');
        }
        return $this->sendResponse(new EmployeeResource($employee),'Employee Retrive Successfully.');
    }
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
            'email'=> 'required'
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $employee = Employees::create($input);

        return $this->sendResponse(new EmployeeResource($employee), 'Employee Created Successfully.');
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'name' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $employee = Employees::find($id);

        $employee->name = $input['name'];
        $employee->email = $input['email'];
        $employee->gender = $input['gender'];
        $employee->hire_date = $input['hire_date'];
        $employee->save();

        return $this->sendResponse(new EmployeeResource($employee), 'Employee Updated Successfully.');
    }

    public function destroy($id){
        $employee = Employees::find($id);
        if(is_null($employee)){
            return $this->sendError('Employee Not Found!');
        }
        $employee->delete();
        return $this->sendResponse([], 'Employee Deleted Successfully.');
    }

    public function exportEmployee(Request $request){
        $employee =json_decode(DB::table('employees')
        ->join('employess_statuses','employees.id','=','employess_statuses.emp_id')
        ->join('jobs','employess_statuses.job_id','=','jobs.id')
        ->select('employees.name','employees.age','employees.gender','employees.hire_date','employess_statuses.salary','employess_statuses.manager_id','jobs.job_name')
        ->get(),true);

        $filename = "employee.csv";
        $handle = fopen($filename, 'w+');
        fputcsv($handle, array('name', 'age', 'gender', 'hire_date','salary','manager_id','job_name'));

        foreach($employee as $row) {

            fputcsv($handle, array($row['name'], $row['age'], $row['gender'], $row['hire_date'],$row['salary'],$row['manager_id'],$row['job_name']));
        }

        fclose($handle);

        $headers = array(
        'Content-Type' => 'text/csv',
        );

        return Response::download($filename, 'employee.csv', $headers);
    }
    public function importEmployee(Request $request){
        return Excel::import(new ImportEmployee, $request->file('file')->store('files'));
    }
}
