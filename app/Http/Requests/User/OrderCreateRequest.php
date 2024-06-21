<?php

namespace App\Http\Requests\User;

use App\Contracts\Repositories\ProductRepositoryContract;
use App\Repositories\ProductRepository;
use App\Rules\ProductInventoryRule;
use Illuminate\Foundation\Http\FormRequest;

class OrderCreateRequest extends FormRequest
{
private int $totalPrice=0;
private int $totalCount=0;
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
//        dd($this->request);
        return [
            'products'=>['required','array'],
            'products.*'=>['array',new ProductInventoryRule(app(ProductRepositoryContract::class))],
            'products.*._id'=>['required','string','exists:products,_id'],
            'products.*.name'=>['required','string'],
            'products.*.price'=>['required','integer'],// send me each product price without considering count
            'products.*.inventory'=>['required','integer','min:1'],
        ];
    }

    protected function passedValidation()
    {

        foreach ($this->products as $request){
           $this->totalPrice+=$request['price'] * $request['inventory'];
           $this->totalCount+=$request['inventory'];
        }
        return $this->merge([
            'total_price'=>$this->totalPrice,
            'total_count'=>$this->totalCount,
            'user_id'=>auth()->id()
            ]);
    }
}
