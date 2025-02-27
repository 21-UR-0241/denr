<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table = 'activitylog';
    
    protected $fillable = [
        'id',
        'datetime',
        'editor',
        'edittedApplication',
        'fieldEditted',
        'applicationType',
        'modificationType',  
        'oldValue',
        'newValue',  
        'applicantName'  
    ];
}
