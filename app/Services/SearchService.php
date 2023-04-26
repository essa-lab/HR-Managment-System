<?php
namespace App\Services;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SearchService
{
    // public function search(Model $model, array $criteria): array
    // {
    //     $cacheKey = $this->getCacheKey($model, $criteria);

    //     return Cache::remember($cacheKey, now()->addHours(24), function () use ($model, $criteria) {
    //         $query = $model::query();

    //         foreach ($criteria as $field => $value) {
    //             $query->where($field, 'LIKE', "%$value%");
    //         }

    //         return $query->get()->toArray();
    //     });
    // }

    // private function getCacheKey(Model $model, array $criteria): string
    // {
    //     $modelName = class_basename($model);
    //     $criteriaJson = json_encode($criteria);

    //     return "{$modelName}_search_{$criteriaJson}";
    // }

    public function searchEmployee($searcTerm){
        $cacheKey = 'Employee_Search'.$searcTerm;
        $cacheTime = 60;
        return Cache::remember($cacheKey,$cacheTime,function() use ($searcTerm){
            $employees =  Employee::with('department','position')
            ->where('first_name','LIKE','%'.$searcTerm.'%')
            ->get();

            $employeeData = $employees->map(function ($employee) {
                return [
                    'name' => $employee->first_name,
                    'department' =>$employee->department->name,
                    'position'=>$employee->position,
                    'salary'=>$employee->salaray,
                    'manager'=>$employee->department->manager->first_name,
                ];
            });

            return response()->json($employeeData);
        });
    }
}

?>
