<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserListView extends Model
{
    protected $table = 'user_list_view'; // Nama VIEW di database
    public $timestamps = false; // VIEW biasanya tidak memiliki kolom timestamps
}
