<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use HasFactory;
class Tsa extends Model
{
    protected $table = 'tsa';
    
    protected $fillable = [
        'id_tsa',
        'applicant_name',
        'applicant_number',
        'patented_subsisting',
        'location',
        'survey_no',
        'cleared_old',
        'remarks',        
    ];
}
