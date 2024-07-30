@extends('_layouts.guest')
@section('title', 'Assignment')

@section('header')
@endsection

@section('content')

<section id="about-home" class="container-fluid pb-0">
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
                <br/>
                <h3>{{ $assignment->class_info->name }} / Assignment / {{ $assignment->assignment_info->name }}</h3>
                @if($assignment->assignment_info->file_type == "file")
                    File(s): 
                    
                    @foreach(json_decode($assignment->assignment_info->file) as $key => $file)
                        <a target="_blank" class="me-2" href="{{ asset($file) }}">View Attachment ({{ $key + 1 }})</a>
                    @endforeach
                @endif
                @if($assignment->assignment_info->file_type == "note")
                    <p class="mt-4 res-margin">
                        {{ $assignment->assignment_info->note }}
                    </p>
                @endif

                @if($assignment->assignment_info->file_type == "file")
                <div class="card mt-2">

                    @if($assignment->file != null)
                    File Uploaded: &nbsp;&nbsp;<a href="{{ asset($assignment->file) }}" target="_blank">View File</a>

                    <hr/>
                    @endif

                    <form action="{{ route('post_assignment_file') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">

                        <div class="card-body">
                            <input type="file" name="file" class="form-control" required id="">
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                @if($assignment->file != null)
                                    Submit Again
                                @else
                                    Submit
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
                @endif

                @if($assignment->assignment_info->file_type == "note")
                <div class="card mt-2">

                    @if($assignment->note != null)
                        {{ $assignment->note }}
                    <hr/>
                    @endif

                    <form action="{{ route('post_assignment_note') }}" method="post">
                        {{ csrf_field() }}
                        <input type="hidden" name="assignment_id" value="{{ $assignment->id }}">

                        <div class="card-body">
                            <textarea name="note" class="form-control" required rows="4"></textarea>
                        </div>
                        <div class="text-end">
                            <button type="submit" class="btn btn-success">
                                @if($assignment->note != null)
                                    Submit Again
                                @else
                                    Submit
                                @endif
                            </button>
                        </div>
                    </form>
                </div>
                @endif

                <br/><br/>
                <h5>Messages</h5>
                <hr/>

                @foreach($assignment->thread as $thread)
                    
                    @if($thread->user_id != Auth::id())
                    <div class="card mt-2 p-0 m-0">
                        <div class="card-body">
                            <h5 class="card-title" style="font-size: 18px;">Teacher</h5>
                            <p class="card-text" style="font-size: 16px;">{{ $thread->message }}</p>
                            <p class="m-0 text-muted" style="font-size: 14px;">{{ $thread->time }}</p>
                        </div>
                    </div>
                    @endif

                    @if($thread->user_id == Auth::id())
                        <div class="card mt-2 p-0 m-0 text-end">
                            <div class="card-body">
                                <h5 class="card-title" style="font-size: 18px;">Student</h5>
                                <p class="card-text" style="font-size: 16px;">{{ $thread->message }}</p>
                                <p class="m-0 text-muted" style="font-size: 14px;">{{ $thread->time }}</p>
                            </div>
                        </div>
                    @endif
                @endforeach

                <div class="card p-2 mt-2">
                    <form action="{{ route('post_assignment_message') }}" method="post">
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
</section>

<br/>

@endsection

@section('footer')
@endsection