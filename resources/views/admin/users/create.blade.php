@extends('layouts.admin')

@section('content')
	<h1>Create User</h1>
	
	<div class="row">
	
		{!! Form::open(['method'=>'POST','action'=>'AdminUsersController@store','files'=>true]) !!}
		    <div class='form-group'>
		        {!! Form::label('name','Name:') !!}
		        {!! Form::text('name',null,['class'=>'form-control']) !!}
		    </div>

		    <div class='form-group'>
		        {!! Form::label('email','Email:') !!}
		        {!! Form::email('email',null,['class'=>'form-control']) !!}
		    </div>

		    <div class='form-group'>
		        {!! Form::label('role_id','Role:') !!}
		        {!! Form::select('role_id',[''=>'Choose Options']+$roles,null,['class'=>'form-control']) !!}
		    </div>

		    <div class='form-group'>
		        {!! Form::label('is_active','Status:') !!}
		        {!! Form::select('is_active',array(0=>'Not Active',1=>'Active'),0,['class'=>'form-control']) !!}
		    </div>

		    <div class='form-group'>
		        {!! Form::label('password','Password:') !!}
		        {!! Form::password('password',['class'=>'form-control']) !!}
		    </div>

		    <div class='form-group'>
		        {!! Form::label('photo_id','Photo:') !!}
		        {!! Form::file('photo_id',null,['class'=>'form-control']) !!}
		    </div>

		    <div class='form-group'>
		        {!! Form::submit('Create User',['class'=>'btn btn-primary']) !!}
		    </div>

			

		{!! Form::close() !!}

	</div>

	<div class="row">
		
		@include('includes.form_error')
	</div>


@stop