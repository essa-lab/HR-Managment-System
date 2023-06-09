<?php

namespace App\Http\Controllers\API;


use App\Models\employees;
use App\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\employessStatus as EmployeeStatus;
use App\Http\Resources\EmployeeStatus as EmpStatusResource;
use Illuminate\Support\Facades\Mail;
use Validator;

class EmployeeStatusController extends BaseController{
    private Service $service;
    public function __construct(Service $service){
        $this->service=$service;
    }
    public function index(){
        $empStat = EmployeeStatus::all();
        return $this->sendResponse(EmpStatusResource::collection($empStat),'Employee Status retrive Successfully.');
    }
    public function show($id){

        $empStat = $this->service->show($id);
        if(is_null($empStat)){
            return $this->sendError('Employee Status Not Found!');
        }
        return $this->sendResponse($empStat,'Employee Status Retrive Successfully.');
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
            'job_id' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $empStat = EmployeeStatus::find($id);
        $empStat->emp_id = $input['emp_id'];
        $empStat->job_id = $input['job_id'];
        $empStat->salary= $input['salary'];
        $empStat->manager_id = $input['manager_id'];
        $empStat->save();

        if(!is_null($empStat->salary)){
            echo "hi";
            $emp = employees::find($input['emp_id']);
            $data = [
                'name' => $emp->name,
                'email'=> $emp->email,
                'salary'=>$input['salary']
            ];
            Mail::send('view.view', $data, function ($message) use ($data) {
                $message->from('no-reply@example.com', 'Salary Update');
                $message->to($data['email']);
                $message->subject('Salary Update: ' . $data['name'].' Your New Salary is '. $data['salary']);
            });
        }
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

    public function getManagers($id){

        $empStat = $this->service->getManagers($id);
        if(is_null($empStat)){
            return $this->sendError('Employee Status Not Found!');
        }
        return $this->sendResponse($empStat,'Employee Status Retrive Successfully.');
    }
    public function getManagersSalary($id){

        $empStat = $this->service->getManagerSalaries($id);
        if(is_null($empStat)){
            return $this->sendError('Employee Status Not Found!');
        }
        return $this->sendResponse($empStat,'Employee Status Retrive Successfully.');
    }

    public function searchQuery(Request $request){

        $input = $request->query('q');
        $empStat = $this->service->getEmployeesByQuery($input);

        if(is_null($empStat)){
            return $this->sendError('Employee Status Not Found!');
        }
        return $this->sendResponse($empStat,'Employee Status Retrive Successfully.');
    }
}
