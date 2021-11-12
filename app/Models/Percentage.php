<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class percentage extends Model
{
    use HasFactory;

    protected $table="percentage";
    protected $primaryKey="id_percentage";
    protected $fillable = [
        'id_course',
        'id_class',
        'continuous_assessment',
        'exams',
    ];

}
