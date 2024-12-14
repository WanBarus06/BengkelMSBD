<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StaffListView extends Model
{
    protected $table = 'staff_list_view'; // Nama VIEW di database
    public $timestamps = false; // VIEW biasanya tidak memiliki kolom timestamps
}
