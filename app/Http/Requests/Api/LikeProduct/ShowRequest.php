<?php

namespace App\Http\Requests\Api\LikeProduct;

use App\Http\Controllers\Api\Traits\Api_Response;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;

class ShowRequest extends FormRequest
{
    use Api_Response;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    public function run()
    {
        $like = DB::table('likes')->where(['user_id' => $this->user_id, 'product_id' => $this->product_id])->first();
        if ($like)
            return $this->apiResponse(['like' => true], '200', 'The user like the product');
        return $this->apiResponse(['like' => false], '200', 'The user does\'nt like the product');

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
}
