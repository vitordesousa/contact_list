@extends('layouts.myLayout')
@section('title')Visualizar Contato: {{$contact->name}} @endsection
@section('content')
	<contacts-form :contact-data="{{ $contact }}" :errors="{{ json_encode( $errors ) }}" in-show="true"></contacts-form>
@endsection