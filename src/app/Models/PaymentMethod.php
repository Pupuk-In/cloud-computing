<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = 'payment_methods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'fee',
        'created_at',
        'updated_at'
    ];

    /**
     * Get the transactions for the payment method.
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
