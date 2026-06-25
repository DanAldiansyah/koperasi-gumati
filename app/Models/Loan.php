<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Loan extends Model
{
    protected $fillable = [
        'user_id',
        'amount_loaned',
        'remaining_loan',
        'status',
        'loan_date',
    ];

    protected $casts = [
        'amount_loaned' => 'decimal:2',
        'remaining_loan' => 'decimal:2',
        'loan_date' => 'date',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function payments(): HasMany
    {
        return $this->hasMany(LoanPayment::class);
    }
}
