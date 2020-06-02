<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TodotaskRequest extends FormRequest
{
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
        if ($this->method() === 'POST') {
            return [
                'task' => 'required|string|max:255',
                'task_description' => 'required|string|max:64000',
                'finished' => ['integer', Rule::in([0,1])]
            ];
        }
        elseif ($this->method() === 'PUT') {
            return [
                'task' => 'string|max:255',
                'task_description' => 'string|max:64000',
                'finished' => ['integer', Rule::in([0,1])]
            ];
        }
        else {
            throw new \HttpRequestMethodException('Invalid HTTP method specified for the route');
        }
    }
}
