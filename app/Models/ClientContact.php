<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class ClientContact extends BaseModel
{
    use SoftDeletes;

    protected $fillable = ['address', 'postcode'];

    protected $hidden = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
