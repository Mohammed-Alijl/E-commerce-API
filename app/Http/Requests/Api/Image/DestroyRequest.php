<?php

namespace App\Http\Requests\Api\Image;

use App\Http\Controllers\Api\Traits\Api_Response;
use App\Models\Image;
use App\Traits\imageTrait;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Exception;

class DestroyRequest extends FormRequest
{
    use Api_Response, imageTrait;

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('dashboard')->check() && auth('dashboard')->user()->tokenCan('dashboard');
    }

    public function run()
    {
        try {
            $image = Image::find($this->id);
            if (!$image)
                return $this->apiResponse(null, 404, __('messages.image.found'));
            if ($image->delete()) {
                $this->delete_image('img/products/' . $image->image);
                return $this->apiResponse(null, 200, __('messages.image.delete'));
            }
            return $this->apiResponse(null, 500, __('messages.failed'));
        } catch (Exception $ex) {
            return $this->apiResponse(null, 500, $ex->getMessage());
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
        throw new HttpResponseException($this->apiResponse(null, 401, __('messages.authorization')));
    }
}
