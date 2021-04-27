<?php

namespace App\Http\Requests;

use App\Rules\SameId;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ContactUpdateRequest extends FormRequest
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

		$url = explode('/', request()->url());

		return [
			'name'						=> ['required', 'min:5', 'max:255'],
			'contact'					=> ['required', 'min:11', 'max:11', Rule::unique('contacts')->ignore(last($url))],
			'email'						=> ['required', 'min:5', 'max:255', 'email', Rule::unique('contacts')->ignore(last($url))],
		];
	}
	public function attributes()
	{
		return [
			'name'					=> 'Nome',
			'email'					=> 'E-mail',
			'contact'				=> 'Telefone',
		];
	}

	public function messages()
	{
		return [
			'name.required'			=> 'O campo :attribute é obrigatório.',
			'name.min'				=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'name.max'				=> 'O campo :attribute precisa ter no máximo :max caracteres.',

			'email.required'		=> 'O campo :attribute é obrigatório.',
			'email.min'				=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'email.max'				=> 'O campo :attribute precisa ter no máximo :max caracteres.',
			'email.unique'			=> 'Já existe um contato com o e-mail informado.',
			'email.email'			=> 'O e-mail digitado é inválido.',
			
			'contact.required'		=> 'O campo :attribute é obrigatório.',
			'contact.min'			=> 'O campo :attribute precisa ter no mínimo :min caracteres.',
			'contact.max'			=> 'O campo :attribute precisa ter no máximo :max caracteres.',
			'contact.unique'		=> 'Já existe um contato com o telefone informado.',
		];
	}
}
