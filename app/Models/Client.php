<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Client extends BaseModel
{
    use SoftDeletes;

    protected $fillable = ['firstName', 'email'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    public function contacts()
    {
        return $this->hasMany(ClientContact::class);
    }
}
