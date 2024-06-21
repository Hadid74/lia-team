<?php

namespace App\Models;

use App\Observers\OrderObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;
use MongoDB\Laravel\Eloquent\SoftDeletes;
use MongoDB\Laravel\Relations\EmbedsMany;

#[ObservedBy([OrderObserver::class])]
class Order extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'total_price',
        'total_count',
        'products',
        'user_id'
    ];

    public function products(): EmbedsMany
    {
        return $this->embedsMany(Product::class);
    }
}
