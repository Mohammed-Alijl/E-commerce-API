<?php

namespace App\Http\Requests\Api\LikeProduct;

use App\Http\Controllers\Api\Traits\Api_Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;
use Exception;

class DestroyRequest extends FormRequest
{
    use Api_Response;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('customer')->check() && auth('customer')->user()->tokenCan('customer');
    }

    public function run()
    {
        try {
            $like = DB::table('likes')->where(['user_id' => auth('customer')->id(), 'product_id' => $this->product_id])->first();
            if (!$like)
                return $this->apiResponse(null, 404, __('messages.like.false'));
            if (DB::table('likes')->delete($like->id))
                return $this->apiResponse(null, 200, __('messages.like.delete'));
            return $this->apiResponse(null, 200, __('messages.failed'));
        }catch (Exception $ex){
            return $this->apiResponse(null,500,$ex->getMessage());
        }

    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
        ];
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
}
