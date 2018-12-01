<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends Model
{
    use SoftDeletes;

    protected $fillable = ['first_name', 'email'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function contacts()
    {
        return $this->hasMany(ClientContact::class);
    }
}
