<?php

namespace App\Http\Requests\Api\LikeProduct;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Http\Resources\LikeResource;
use App\Http\Resources\Product\IndexResource;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\DB;

class IndexRequest extends FormRequest
{
    use Api_Response;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('customer')->check() || auth('dashboard')->check();
    }

    public function run()
    {
        try {
            if (auth('customer')->check())
                return $this->userRun();
            if (auth('dashboard')->check())
                return $this->adminRun();
        } catch (Exception $ex) {
            return $this->apiResponse(null, 400, $ex->getMessage());
        }
    }

    private function adminRun()
    {
        return $this->apiResponse(LikeResource::collection(DB::table('likes')->get()), 200, 'The products the users like');
    }

    private function userRun()
    {
        return $this->apiResponse(IndexResource::collection((auth('api')->user()->products)), 200, 'The products the user love');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
        ];
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, 'you are not authorized'));
    }
}
