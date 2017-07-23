@extends('layouts.admin')

@section('content')
	
	@if (Session::has('deleted_user'))
		
		<p class="bg-danger">{{'\''.session('deleted_user').'\''.' has been deleted.'}}</p>
	@endif

	<h1>Users</h1>

	<table class="table">
	  <thead>
	    <tr>
	      <th>Id</th>
	      <th>Photo</th>
	      <th>Name</th>
	      <th>Email</th>
	      <th>Role</th>
	      <th>Status</th>
	      <th>Created</th>
	      <th>Updated</th>
	    </tr>
	  </thead>
	  <tbody>

	  @if ($users)
	  	@foreach ($users as $user)
		  	<tr>
		      <th scope="row">{{$user->id}}</th>
		      <th><img height="24px" src="{{$user->photo ? $user->photo->file : '/images/defaultuser.png'}}"></img></th>
		      <td><a href="{{route('admin.users.edit',$user->id)}}">{{$user->name}}</a></td>
		      <td>{{$user->email}}</td>
		      <td>{{$user->role_id == NULL ? 'User has no role' : $user->role->name}}</td>
		      <td>{{$user->is_active == 1 ? 'Active' : 'NotActive'}}</td>
		      <td>{{$user->created_at}}</td>
		      <td>{{$user->updated_at->diffForHumans()}}</td>
		    </tr>
	  	@endforeach
	  @endif
	    
	  </tbody>
	</table>


@stop
