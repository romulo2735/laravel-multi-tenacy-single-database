<?php

namespace App\Http\Requests;

use App\Rules\Tenant\TenantUnique;
use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        // $this->segment(2) pega o valor da rota, na posição que ela ocupa.
        // $this->id pegando o valor passado pelo formulário.

        return [
            'title' => [
                'required',
                'min:3',
                'max:100',
                new TenantUnique('posts', $this->segment(2)),
            ],
            'body' => 'required|max:1000',
        ];
    }
}
