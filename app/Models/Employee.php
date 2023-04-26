<?php

namespace App\Models;

use App\Services\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    protected $fillable = ['id','first_name', 'last_name', 'email', 'phone_number', 'hire_date', 'salary', 'department_id', 'position_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function salary()
    {
        return $this->hasOne(Salary::class);
    }

    public function trainings()
    {
        return $this->belongsToMany(Training::class)->withTimestamps();
    }
}
