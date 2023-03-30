<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Employees;
use App\Http\Resources\employee as EmployeeResource;
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
}
