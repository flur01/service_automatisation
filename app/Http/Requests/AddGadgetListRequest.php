<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddGadgetListRequest extends FormRequest
{
    /**
     * Get data to be validated from the request.
     *
     * @return array
     */

    protected function validationData()
    {
        $result = $this->all();
        $result['extension'] = $this->list->getClientOriginalExtension();
        return $result;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            'list' => 'required',
            'extension' => ['required','in:xlsx,xls']
        ];
    }

    /**
     * Custom error message.
     *
     * @return array
     */

    public function messages()
    {
        return [
            'list.required' => 'Оберіть файл',
            'extension.in' => ' Не вірний формат файлу',
        ];

    }
}
