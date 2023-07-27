<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingCourse extends Model
{
    use HasFactory;

    public function crew()
    {
        return $this->belongsTo(Crew::class, 'crew_id', 'id');
    }
}
