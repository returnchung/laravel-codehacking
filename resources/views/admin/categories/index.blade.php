@extends('layouts.admin')

@section('content')
	
	@if (Session::has('deleted_category'))
		
		<p class="bg-danger">{{'\''.session('deleted_category').'\''.' has been deleted.'}}</p>
	@endif

	<h1>Categories</h1>

	<div class="col-sm-3">
		
		{!! Form::open(['method'=>'POST','action'=>'AdminCategoriesController@store']) !!}
		    <div class='form-group'>
		        {!! Form::label('name','Name:') !!}
		        {!! Form::text('name',null,['class'=>'form-control']) !!}
		    </div>

		    <div class='form-group'>
		        {!! Form::submit('Create Category',['class'=>'btn btn-primary']) !!}
		    </div>

		{!! Form::close() !!}

	</div>	

	<div class="col-sm-9">
		
		<table class="table">
		  <thead>
		    <tr>
		      <th>Id</th>
		      <th>Name</th>
		      <th>Created</th>
		      <th>Updated</th>
		    </tr>
		  </thead>
		  <tbody>

		  @if ($categories)
		  	@foreach ($categories as $category)
			  	<tr>
			  		<td>{{$category->id}}</td>
			  		<td><a href="{{route('admin.categories.edit',$category->id)}}">{{$category->name}}</a></td>
			  		<td>{{$category->created_at}}</td>
			  		<td>{{$category->updated_at->diffForHumans()}}</td>
			    </tr>
		  	@endforeach
		  @endif
		    
		  </tbody>



		</table>

	</div>


@endsection