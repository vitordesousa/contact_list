<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

use App\Models\Contact;


class SameId implements Rule
{
	/**
	 * Create a new rule instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		//
	}

	/**
	 * Determine if the validation rule passes.
	 *
	 * @param  string  $attribute
	 * @param  mixed  $value
	 * @return bool
	 */
	public function passes($attribute, $value)
	{
		$url = explode('/', request()->url());
		$id = last($url);

		$contact = Contact::find($id);
		if(!$contact){
			return true;
		} else if($attribute == "contact"){
			if($contact->contact == $value) {
				return true;
			}
			return false;
		} else if($attribute == "email"){
			if($contact->email == $value) {
				return true;
			}
			return false;
		}
	}

	/**
	 * Get the validation error message.
	 *
	 * @return string
	 */
	public function message()
	{
		return 'A informação digitada já existe em outro contato';
	}
}
