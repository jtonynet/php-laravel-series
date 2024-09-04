<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SeriesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nome' => ['required', 'min:3'],
            'cover' => ['mimes:jpeg,png,gif', 'extensions:jpg,jpeg,png,gif']
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'O Campo nome e obrigatorio',
            'nome.min' => 'O Campo nome precisa de pelo menos :min caracteres',
            'cover.mimes' => 'A imagem precisa ser jpeg, png ou gif',
            'cover.extensions' => 'A imagem precisa ter a extensao jpeg, png ou gif',
        ];
    }
}
