@extends('layouts.myLayout')
@section('title')Adicionar Contato @endsection
@section('content')
	<contacts-form  :errors="{{ json_encode( $errors ) }}"></contacts-form>
@endsection