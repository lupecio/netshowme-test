<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|regex:/[0-9]{11}/',
            'message' => 'required',
            'file' => 'required|mimes:pdf,doc,docx,odt,txt|max:500'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'O campo nome é obrigatório.',
            'email.required' => 'O campo email é obrigatório.',
            'email.email' => 'O campo email deve ser válido.',
            'phone.required' => 'O campo telefone é obrigatório.',
            'phone.regex' => 'O campo telefone é inválido.',
            'message.required' => 'O campo mensagem é obrigatório.',
            'file.required' => 'O arquivo anexo é obrigatório.',
            'file.mimes' => 'O arquivo anexo deve ser de alguns dos tipos: pdf, doc, docx, odt ou txt.',
            'file.max' => 'O arquivo anexo não pode ser maior que 500kb.'
        ];
    }
}
