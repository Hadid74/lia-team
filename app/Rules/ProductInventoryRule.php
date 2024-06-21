<?php

namespace App\Rules;

use App\Contracts\Repositories\ProductRepositoryContract;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ProductInventoryRule implements ValidationRule
{
    public function __construct(
        private ProductRepositoryContract $productRepository
    )
    {
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $product=$this->productRepository->show($value['_id']);
        if ($product->inventory<$value['inventory']){
            $fail($product->name . ' does not have inventory');
        }elseif ($product->name!=$value['name']||$product->price!=$value['price']){
            $fail($value['name'] . ' does not match');
        }
    }


}
