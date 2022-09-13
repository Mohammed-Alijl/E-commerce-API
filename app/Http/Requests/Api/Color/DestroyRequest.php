<?php

namespace App\Http\Requests\Api\Color;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Color;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use mysql_xdevapi\Exception;

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
        return auth('dashboard')->check();
    }

    public function run()
    {
        try {
            $color = Color::find($this->id);
            if (!$color)
                return $this->apiResponse(null, 404, 'This color is not exist');
            if ($color->delete())
                return $this->apiResponse(null, 200, 'The color deleted was success');
            return $this->apiResponse(null, 400, 'The color deleted was failed');
        } catch (Exception $ex) {
            return $this->apiResponse(null, 400, $ex->getMessage());
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
            //
        ];
    }

    public function failedAuthorization()
    {
        throw new HttpResponseException($this->apiResponse(null, 401, 'you are not authorize'));
    }
}
