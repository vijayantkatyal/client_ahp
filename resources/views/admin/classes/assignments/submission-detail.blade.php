@extends('_layouts.admin')
@section('title','Assignment')
@section('header')

@endsection

@section('content')

<div class="container-xl">
	<!-- Page title -->
	<div class="page-header d-print-none">
		<div class="row align-items-center">
			<div class="col">
				<div class="page-pretitle">
                    {{ $assignment->class_info->name }} / Assignments
				</div>
				<h2 class="page-title">
                    {{ $assignment->assignment_info->name }}
				</h2>
			</div>
            <div class="col text-end">
                @if($assignment->accepted == true)
                    <i class="text-success"><svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-circle-check"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M17 3.34a10 10 0 1 1 -14.995 8.984l-.005 -.324l.005 -.324a10 10 0 0 1 14.995 -8.336zm-1.293 5.953a1 1 0 0 0 -1.32 -.083l-.094 .083l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.403 1.403l.083 .094l2 2l.094 .083a1 1 0 0 0 1.226 0l.094 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" /></svg></i> Assignemnt Accepted
                @else
                    <form action="{{ route('post_admin_assignment_accept') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="assignment_id" value="{{ $assignment->id }}"/>
                        @if($assignment->assignment_info->max_marks != null)
                            <input type="number" required min="0" name="marks_obtained" max="{{ $assignment->assignment_info->max_marks }}" value="{{ $assignment->marks_obtained }}" class="form-control" placeholder="Marks out of {{ $assignment->assignment_info->max_marks }}" style="display: inline-block; width: 180px;"/>
                        @endif
                        <button class="btn btn-success" type="submit" id="button-addon2">Mark as Accepted</button>
                    </form>
                @endif
            </div>
		</div>
	</div>
</div>

<div class="page-body">
<div class="container">
        <div class="row">
            <div class="col-12">
                @if(session('status.success'))
                    <div class="alert alert-important alert-success">
                        {{ session('status.success') }}
                    </div>
                @endif

                @if(session('status.error'))
                    <div class="alert alert-important alert-danger">
                        {{ session('status.error') }}
                    </div>
                @endif
                
                @if($assignment->assignment_info->file_type == "file")
                    Assignment File: <a target="_blank" href="{{ asset($assignment->assignment_info->file) }}">View Attachment</a>
                @endif
                @if($assignment->assignment_info->file_type == "note")
                    <p class="res-margin">
                        {{ $assignment->assignment_info->note }}
                    </p>
                @endif

                @if($assignment->assignment_info->file_type == "file")
                <div class="card">
                    <div class="card-body">

                        @if($assignment->file != null)
                            Student File Uploaded: &nbsp;&nbsp;<a href="{{ asset($assignment->file) }}" target="_blank">View File</a>
                        @endif
                    </div>
                </div>
                @endif

                @if($assignment->assignment_info->file_type == "note")
                <div class="card">

                    <div class="card-body">
                        @if($assignment->note != null)
                            {{ $assignment->note }}
                        @endif
                    </div>
                </div>
                @endif

                <br/>
                <h3 class="mb-3">Messages</h3>

                @foreach($assignment->thread as $thread)
                    
                    @if($thread->user_id != Auth::id())
                    <div class="card p-0 m-0">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 18px;">Student</h5>
                            <p class="card-text" style="font-size: 16px;">{{ $thread->message }}</p>
                            <p class="m-0 text-muted" style="font-size: 14px;">{{ $thread->time }}</p>
                        </div>
                    </div>
                    @endif

                    @if($thread->user_id == Auth::id())
                        <div class="card p-0 m-0 text-end">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 18px;">Teacher</h5>
                                <p class="card-text" style="font-size: 16px;">{{ $thread->message }}</p>
                                <p class="m-0 text-muted" style="font-size: 14px;">{{ $thread->time }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="card p-2 mt-2">
                    <form action="{{ route('post_admin_assignment_message') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">
                        <input type="hidden" name="class_id" value="{{ $assignment->class_id }}">

                        <div class="card-body">
                            <textarea name="message" class="form-control" placeholder="Message here" required rows="4"></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection