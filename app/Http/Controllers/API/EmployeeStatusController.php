<?php

namespace App\Http\Controllers\API;


use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\employessStatus as EmployeeStatus;
use App\Http\Resources\EmployeeStatus as EmpStatusResource;
use Validator;

class EmployeeStatusController extends BaseController{
    public function index(){
        $empStat = EmployeeStatus::all();
        return $this->sendResponse(EmpStatusResource::collection($empStat),'Employee Status retrive Successfully.');
    }
    public function show($id){
        $empStat = EmployeeStatus::find($id);
        if(is_null($empStat)){
            return $this->sendError('Employee Status Not Found!');
        }
        return $this->sendResponse(new EmpStatusResource($empStat),'Employee Status Retrive Successfully.');
    }
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'emp_id' => 'required',
            'job_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $empStat = EmployeeStatus::create($input);

        return $this->sendResponse(new EmpStatusResource($empStat), 'Employee Status Created Successfully.');
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'emp_id' => 'required',
            'job_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $empStat = EmployeeStatus::find($id);
        $empStat->empStat_name = $input['empStat_name'];
        $empStat->save();

        return $this->sendResponse(new EmpStatusResource($empStat), 'Employee Status Updated Successfully.');
    }

    public function destroy($id){
        $empStat = EmployeeStatus::find($id);
        if(is_null($empStat)){
            return $this->sendError('Employee Status Not Found!');
        }
        $empStat->delete();
        return $this->sendResponse([], 'Employee Status Deleted Successfully.');
    }
}
