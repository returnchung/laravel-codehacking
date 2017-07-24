@extends('layouts.admin')

@section('content')
	
	<h1>Medias</h1>	
	
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

	  @if ($photos)
	  	@foreach ($photos as $photo)
		  	<tr>
		  		<td>{{$photo->id}}</td>
		  		<td><img height="50" src="{{$photo->file ? $photo->file : '/images/defaultposts.png'}}"></td>
		  		<td>{{$photo->created_at}}</td>
		  		<td>{{$photo->updated_at->diffForHumans()}}</td>
		  		<td>
			  		{!! Form::open(['method'=>'DELETE','action'=>['AdminMediasController@destroy',$photo->id]]) !!}
						{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
					{!! Form::close() !!}
				</td>
		    </tr>
	  	@endforeach
	  @endif
	    
	  </tbody>

	</table>

@endsection