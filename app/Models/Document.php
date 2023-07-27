<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    protected $fillable = [
        'crew_id',
        'code',
        'name',
        'document_number',
        'issued',
        'expiry',
        'remarks'
    ];

    public function crew()
    {
        return $this->belongsTo(Crew::class, 'crew_id', 'id');
    }
}
