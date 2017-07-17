@extends('layouts.admin')

@section('content')
	
	<h1>Users</h1>

	<table class="table">
	  <thead>
	    <tr>
	      <th>Id</th>
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
		      <td>{{$user->name}}</td>
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
