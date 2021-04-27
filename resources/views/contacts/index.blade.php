@extends('layouts.myLayout')
@section('title')Meus contatos @endsection
@section('content')
	<contacts-index :contacts="{{ $contacts }}"></contacts-index>
@endsection