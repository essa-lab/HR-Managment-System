<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employessStatus extends Model
{
    use HasFactory;

    public function jobs(){
        return $this->hasMany(jobs::class);
    }

    public function employee(){
        return $this->hasMany(employees::class);
    }

    protected $fillable =['emp_id','job_id','manager_id','salary'];
    // protected $primaryKey = ['emp_id','job_id'];

}
