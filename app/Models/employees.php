<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class employees extends Model
{
    use HasFactory;
    protected $table = 'employees';

    protected $fillable = ['age','name','gender','email','hire_date'];

    public $timestamp = false;
    public function empStatus(){
        return $this->belongsTo(employessStatus::class);
    }

}
