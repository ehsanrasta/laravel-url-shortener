<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ShowShortLink extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // todo: auth
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'short' => 'required',
        ];
    }

    public function all($keys = null)
    {
        $data = parent::all($keys);
        $data['short'] = $this->route('short');
        return $data;
    }
}
