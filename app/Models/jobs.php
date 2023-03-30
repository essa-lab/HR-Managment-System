<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class jobs extends Model
{
    use HasFactory;

    protected $table = 'jobs';
    protected $fillable = ['job_name'];
    public function empStatus(){
        return $this->belongsTo(employessStatus::class);
    }
}
