<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $table = 'audit_trail';

    protected $fillable = [
        'action_type',
        'table_name',
        'record_id',
        'old_value',
        'new_value',
        'user_id',
    ];
}
