<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Crew extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'middlename',
        'lastname',
        'email',
        'address',
        'education',
        'contact',
    ];

    public function documents()
    {
        return $this->hasMany(Document::class, 'crew_id', 'id');
    }

    public function training_courses()
    {
        return $this->hasMany(TrainingCourse::class, 'crew_id', 'id');
    }
}
