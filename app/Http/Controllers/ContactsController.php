<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

use App\Http\Requests\ContactStoreRequest;
use App\Http\Requests\ContactUpdateRequest;

class ContactsController extends Controller
{
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$contacts = Contact::orderBy('name', 'ASC')->get(['id', 'name']);
		return view('contacts.index', compact('contacts'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create()
	{
		return view('contacts.create');
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(ContactStoreRequest $request)
	{
		return Contact::create($request->only('name', 'email', 'contact'));
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id)
	{
		$contact = Contact::findOrfail($id);
		return view('contacts.show', compact('contact'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Contact $contact)
	{
		return view('contacts.edit', compact('contact'));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(ContactUpdateRequest $request, Contact $contact)
	{
		$contact->update($request->only('name', 'email', 'contact'));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Contact $contact)
	{
		$contact->delete();
	}
	 


	public function checkData($data, $type){

		if($type == 1){ // Phone
			$typeSearch = 'contact';
		} else if($type == 2){
			$typeSearch = 'email';
		}

		$contact = Contact::where($typeSearch, $data)->first();
		$url = explode('/', request()->url());
		$id  = last($url);

		if($contact && $contact->id == $id){
			return true;
		} else if(!$contact){
			return true;
		}
		return false;
	}
}
