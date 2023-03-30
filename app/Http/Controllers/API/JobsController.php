<?php
namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\jobs;
use App\Http\Resources\jobs as JobResource;
use Validator;
class JobsController extends BaseController{
    public function index(){
        $jobs = Jobs::all();
        return $this->sendResponse(JobResource::collection($jobs),'Jobs retrive Successfully.');
    }
    public function show($id){
        $job = Jobs::find($id);
        if(is_null($job)){
            return $this->sendError('Job Not Found!');
        }
        return $this->sendResponse(new JobResource($job),'Job Retrive Successfully.');
    }
    public function store(Request $request)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'job_name' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $job = Jobs::create($input);

        return $this->sendResponse(new JobResource($job), 'Jobs Created Successfully.');
    }
    public function update(Request $request, $id)
    {
        $input = $request->all();

        $validator = Validator::make($input, [
            'job_name' => 'required',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }
        $job = Jobs::find($id);
        $job->job_name = $input['job_name'];
        $job->save();

        return $this->sendResponse(new JobResource($job), 'Job Updated Successfully.');
    }

    public function destroy($id){
        $job = Jobs::find($id);
        if(is_null($job)){
            return $this->sendError('Job Not Found!');
        }
        $job->delete();
        return $this->sendResponse([], 'Job Deleted Successfully.');
    }
}
