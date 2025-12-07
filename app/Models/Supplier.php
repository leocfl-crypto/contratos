<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Supplier extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'corporate_name',
        'trade_name',
        'tax_id',
        'email',
        'phone',
    ];

    /**
     * Relationship with Contracts
     */
    public function contracts(): HasMany
    {
        return $this->hasMany(Contract::class);
    }
}
