@extends('layouts.admin')


@section('content')
	
	<h1>Upload Media</h1>

	{!! Form::open(['method'=>'POST','action'=>'AdminMediasController@store','class'=>'dropzone', 'id'=>'my-awesome-dropzone']) !!}

	{!! Form::close() !!}
	
	
@endsection
