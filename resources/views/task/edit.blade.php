@extends('layout')

@section('content')


<form action="{{ route('task.update', [ 'id' => $task->id ] ) }}" method="POST" enctype="multipart/form-data">
    {{ csrf_field() }}
	<input type="hidden" name="task_id" value="{{ $task->id }}">

<!--
    @foreach( $projects as $project)
    <hr>
    	<strong>Project Name: </strong> {{ $project->project_name }} 
    	<strong>Project ID: </strong> {{ $project->id }} 
    	<strong>Task->Project->ID: </strong> {{  $task->project->id }}

    <hr>
    @endforeach
-->


    <div class="col-md-8">

    	<div class="form-group">
    		<label>Edit Task Title</label>
			<input type="text" class="form-control"  name="task_title" value="{{ $task->task_title }}">
		</div>

		<div class="form-group">
           	<input type="file" class="form-control" name="photos[]" multiple>
       	</div>

    	<div class="form-group">
    		<label>Edit task</label>
			<textarea class="form-control" rows="5" id="summernote" name="task">{{ $task->task }}</textarea>
		</div>

		<div class="form-group">
		@if( count($taskfiles) > 0  )
		<label>Files</label>
		<ul class="fileslist">
           	@foreach( $taskfiles as $file) 
			    <li>{{ $file->filename }} <span>&nbsp;&nbsp;</span> <a class="btn btn-danger" href="{{ route('task.deletefile', [ 'id' => $file->id]) }}">
			   		<span class="glyphicon glyphicon-trash" aria-hidden="true"></span></a>
				</li>
			@endforeach
		</ul>
		@endif
       	</div>

	</div>

	<div class="col-md-4">


        <div class="form-group">
			 <label>Assigned to User <span class="glyphicon glyphicon-user" aria-hidden="true"></span></label>

              <select name="user_id" id="user_id" class="form-control">
                    @foreach( $users as $user)
                        <option value="{{ $user->id }}" 
                          @if( $task->user->id == $user->id )
                                selected
                          @endif
                          >{{ $user->name }}
                      	</option>
                    @endforeach
              </select>
        </div>

        <div class="form-group">
			 <label>Assigned to Project <span class="glyphicon glyphicon-pushpin" aria-hidden="true"></span></label>

              <select name="project_id" id="project_id" class="form-control">
                    @foreach( $projects as $project)
                        <option value="{{ $project->id }}" 
                          @if( $task->project->id == $project->id )
                                selected
                          @endif
                          >{{ $project->project_name }}
                      	</option>
                    @endforeach
              </select>
        </div>

	
		<div class="form-group">
			<label>Edit Priority <span class="glyphicon glyphicon-warning-sign" aria-hidden="true"></span></label>
			<select name="priority" class="form-control">
				@if( $task->priority == 0 )
			  		<option value="0" selected>Normal</option>
			  		<option value="1">High</option>
			    @else
			  		<option value="0">Normal</option>
			  		<option value="1" selected>High</option>
			  	@endif
			</select>
		</div>

		<div class="form-group">
			<label>Edit Status <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span></label>
			<select name="completed" class="form-control">
				@if( $task->completed == 0 )
			  		<option value="0" selected>Not Completed</option>
			  		<option value="1">Completed</option>
			  	@else
			  		<option value="0">Not Completed</option>
			  		<option value="1" selected>Completed</option>
			  	@endif
			</select>
		</div>


        <div class="form-group">
            <label>Edit Due Date <span class="glyphicon glyphicon-calendar" aria-hidden="true"></span></label>
     
                <div class='input-group date' id='datetimepicker1'>
					<input type='text' class="form-control" name="duedate" value="{{ $task->duedate }}">
					<span class="input-group-addon">
					<span class="glyphicon glyphicon-calendar"></span>
					</span>
				</div>
        </div>
		


		<div class="btn-group">
			<input class="btn btn-primary" type="submit" value="Submit">
			<a class="btn btn-default" href="{{ redirect()->getUrlGenerator()->previous() }}">Go Back</a>
		</div>

	</div>




</form>

@stop


@section('styles')

	<link rel="stylesheet" href="{{ asset('css/summernote.css') }}">
	<link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.min.css') }}">
@stop


@section('scripts')
	<script src="{{ asset('js/summernote.min.js') }}"></script>  

    <script src="{{ asset('js/moment.js') }}"></script> 

    <script src="{{ asset('js/bootstrap-datepicker.min.js') }}"></script>  

	<script>
		jQuery(document).ready(function() {
		  jQuery('#summernote').summernote({ height: 300 });
		});

		jQuery('#datetimepicker1').datetimepicker( {
			defaultDate:'now',  // defaults to today
			format: 'YYYY-MM-DD hh:mm:ss',  // YEAR-MONTH-DAY hour:minute:seconds
			minDate:new Date()  // Disable previous dates, minimum is todays date
		});

	</script>




@stop
