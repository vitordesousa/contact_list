@extends('layouts.myLayout')
@section('title')Editar Contato: {{$contact->name}} @endsection
@section('content')
	<contacts-form :contact-data="{{ $contact }}" :errors="{{ json_encode( $errors ) }}" in-edit="true"></contacts-form>
@endsection