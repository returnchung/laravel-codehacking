@extends('layouts.admin')

@section('content')
	
	<h1>Medias</h1>	

	{!! Form::open(['method'=>'POST','action'=>'AdminMediasController@deleteMedias','class'=>'form-inline','id'=>'media-form']) !!}

	    {{-- <div class='form-group'>
	        {!! Form::select('Delete',[''=>'Delete All'],null,['class'=>'form-control','name'=>'checkBoxArrayCollection']) !!}
	    </div> --}}

	<table class="table">
	  <thead>
	    <tr>
	    	<th><input type="checkbox" id="options"></th>
	    	<th>Id</th>
	      	<th>Name</th>
	      	<th>Created</th>
	      	<th>Updated</th>
	      	<th>
	      		<div class='form-group'>
			        {!! Form::submit('Delete All',['class'=>'btn btn-danger', 'name'=>'delete_all', 'id'=>'delete_all', "disabled"=>"disabled"]) !!}
			    </div>	

	      	</th>
	    </tr>
	  </thead>
	  <tbody>

	  @if ($photos)
	  	@foreach ($photos as $photo)
		  	<tr>
		  		<td><input type="checkbox" class="checkBoxes" name="checkBoxArray[]" value="{{$photo->id}}" onclick=checkForm()></td>
		  		<td>{{$photo->id}}</td>
		  		<td><img height="50" src="{{$photo->file ? $photo->file : '/images/defaultposts.png'}}"></td>
		  		<td>{{$photo->created_at}}</td>
		  		<td>{{$photo->updated_at->diffForHumans()}}</td>
		  		<td>
			  		{!! Form::open(['method'=>'DELETE','action'=>['AdminMediasController@destroy',$photo->id]]) !!}
						{!! Form::submit('Delete',['class'=>'btn btn-danger']) !!}
					{!! Form::close() !!}
					{{-- <div class='form-group'>
						<input type="hidden" name="photo" value="{{$photo->id}}">
						{!! Form::submit('Delete',['class'=>'btn btn-danger', 'name'=>'delete_single']) !!}
					</div> --}}
					
				</td>
		    </tr>
	  	@endforeach
	  @endif
	    
	  </tbody>

	</table>

	{!! Form::close() !!}	

	@section('scripts')
		
		<script type="text/javascript">
			
			$('document').ready(function(){

				$('#options').click(function(){
					if(this.checked){
						// console.log('hello');
						$('.checkBoxes').each(function(){
							this.checked = true;
						});
						$('#delete_all').prop('disabled', false);
						
					}else{
						// console.log('bye');
						$('.checkBoxes').each(function(){
							this.checked = false;
						});
						$('#delete_all').prop('disabled', true);	
					}
				});

			});
			
			function checkForm (){
				$count=0;
				$("#media-form").find(".checkBoxes").each(function(){
				    if ($(this).prop('checked')==true){ 
				        $count++;
				    }
				});
				if($count>0){
					$('#delete_all').prop('disabled', false);
				}else{
					$('#delete_all').prop('disabled', true);
				}
				// console.log($count);			    
			}

		</script>

	@endsection

@endsection