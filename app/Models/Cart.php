<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Money\Currency;
use Money\Money;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'session_id',
    ];

    public function total(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->items->reduce(
                fn (Money $total, CartItem $item) =>
                $total->add($item->subtotal),
                new Money(
                    0,
                    new Currency('USD')
                )
            ),
        );
    }

    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
