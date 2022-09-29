<?php

namespace App\Http\Requests\Api\product;

use App\Http\Resources\Product\IndexResource;
use App\Models\Product;
use Exception;
use Illuminate\Foundation\Http\FormRequest;

class IndexRequest extends FormRequest
{


    public function authorize()
    {
        return true;
    }

    public function run()
    {
        try {
            if (auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard'))
                return IndexResource::collection(Product::paginate($this->paginate_num ?? config('constants.ADMIN_PAGINATION')));
            return IndexResource::collection(Product::paginate(config('constants.CUSTOMER_PAGINATION')));
        } catch (Exception $ex) {
            return $this->apiResponse(null, 500, $ex->getMessage());
        }
    }

    public function rules()
    {
        return [
            //
        ];
    }


}

