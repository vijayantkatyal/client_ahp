@extends('_layouts/guest')
@section('title', 'Dashboard')

@section('header')
<style>
    .nav-pills .nav-link {
        background-color: transparent;
        /* border: 1px solid #035392; */
        color: #035392;
    }

    .nav-pills .nav-link:hover {
        color: #fff;
    }
</style>

<link rel="stylesheet" href="https://cdn.datatables.net/1.12.0/css/dataTables.bootstrap5.min.css" />

<style>
    .table-responsive {
        overflow-x: visible;
    }
</style>

@endsection

@section('content')

<br /><br />
<div class="row">
    <!-- page with sidebar starts -->
    <div class="col-12">
        <div class="container">
            <div class="row">
                <div class="col-10">
                    <ul class="nav nav-pills">
                        <li class="nav-item">
                            <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">Info</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">Classes</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-attendance-tab" data-bs-toggle="pill" data-bs-target="#pills-attendance" type="button" role="tab" aria-controls="pills-attendance" aria-selected="false">Attendance</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-assignments-tab" data-bs-toggle="pill" data-bs-target="#pills-assignments" type="button" role="tab" aria-controls="pills-assignments" aria-selected="false">Assignments</button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" id="pills-message-tab" data-bs-toggle="pill" data-bs-target="#pills-message" type="button" role="tab" aria-controls="pills-message" aria-selected="false">Message</button>
                        </li>
                    </ul>
                </div>
                <div class="col-2 text-end">
                    <button type="button" class="btn btn-secondary" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</button>
                    <form id="logout-form" action="{{ route('post_logout_route') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                        <input type="hidden" name="login_type" value="user" />
                    </form>
                </div>
            </div>
            <hr />

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

            @if ($errors->any())
            <div class="alert alert-warning alert-dismissible fade show pe-5">
                <ul class="list-unstyled mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="row">
                <div class="col-12">
                    <div class="tab-content" id="myTabContent" style="box-shadow: none; padding: 0px;">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">
                            <form action="{{ route('post_user_settings_general') }}" method="post">
                                {{ csrf_field() }}
                                <div class="title h5 title-wth-divider text-secondary text-uppercase my-2"><span>General</span></div>
                                <div class="row gx-3">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('First Name') }}</label>
                                            <input type="text" name="first_name" required @if($errors->has('first_name'))
                                            class="form-control form-control-lg is-invalid"
                                            @else
                                            class="form-control form-control-lg"
                                            @endif
                                            value="{{ old('first_name', Auth::user()->first_name) }}"
                                            />
                                            @if($errors->has('first_name'))
                                            <div class="invalid-feedback">{{ $errors->first('first_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Last Name') }}</label>
                                            <input type="text" name="last_name" required @if($errors->has('last_name'))
                                            class="form-control form-control-lg is-invalid"
                                            @else
                                            class="form-control form-control-lg"
                                            @endif
                                            value="{{ old('last_name', Auth::user()->last_name) }}"
                                            />
                                            @if($errors->has('last_name'))
                                            <div class="invalid-feedback">{{ $errors->first('last_name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row gx-3">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Email') }}</label>
                                            <input type="text" class="form-control form-control-lg disabled" disabled value="{{ Auth::user()->email }}" />
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary mt-4">{{ __('Save') }} Changes</button>
                            </form>

                            <br />
                            <hr />
                            <br />

                            <form action="{{ route('post_user_settings_password') }}" method="post">
                                {{ csrf_field() }}
                                <div class="title h5 title-wth-divider text-secondary text-uppercase my-2"><span>Password Settings</span></div>
                                <div class="row gx-3">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('New') }} {{ __('Password') }}</label>
                                            <input type="password" name="password" required minlength="8" @if($errors->has('password'))
                                            class="form-control form-control-lg is-invalid"
                                            @else
                                            class="form-control form-control-lg"
                                            @endif
                                            value=""
                                            placeholder="{{ __('Password') }}"
                                            />
                                            @if($errors->has('password'))
                                            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="form-label">{{ __('Confirm') }} {{ __('Password') }}</label>
                                            <input type="password" name="password_confirm" required minlength="8" @if($errors->has('password_confirm'))
                                            class="form-control form-control-lg is-invalid"
                                            @else
                                            class="form-control form-control-lg"
                                            @endif
                                            value=""
                                            placeholder="Password"
                                            />
                                            @if($errors->has('password_confirm'))
                                            <div class="invalid-feedback">{{ $errors->first('password_confirm') }}</div>
                                            @endif
                                            <button type="submit" class="btn btn-primary mt-4">{{ __('Change') }} {{ __('Password') }}</button>
                                        </div>
                                    </div>
                                </div>
                            </form>

                        </div>
                        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab" tabindex="0">

                            @if(sizeof($classes) > 0)
                            Your Classes:
                            <br /><br />
                            <ul class="list-group list-group-flush">
                                @foreach($classes as $class_info)
                                    <div class="list-group-item">
                                        <div class="row">
                                            <div class="col-12">
                                                <b>Course: </b>{{ $class_info->course_name }} / <b>Class: </b> {{ $class_info->class_name }} ({{ $class_info->start_date }} - {{ $class_info->end_date }})
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </ul>
                            @else
                            No Classes joined yet.
                            @endif

                        </div>
                        <div class="tab-pane fade" id="pills-attendance" role="tabpanel" aria-labelledby="pills-attendance-tab" tabindex="0">
                            <b>Attendance</b>
                            <br />
                            @if(sizeof($classes) > 0)
                                @foreach($classes as $class_info)
                                    <a
                                        href="{{ route('get_user_index') }}?class_id={{ $class_info->id }}"
                                        @if($class_id == $class_info->id)
                                            class="badge rounded-pill text-bg-primary"
                                        @else
                                            class="badge rounded-pill text-bg-secondary"
                                        @endif
                                        style="font-size: 16px; margin-right: 6px;"
                                    >
                                        {{ $class_info->course_name }} / {{ $class_info->class_name }}
                                    </a>
                                @endforeach
                            @endif
                            <br />
                            <br/>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter table-mobile-md datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                Date

                                            </th>
                                            <th class="text-center">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($attendance as $item)
                                        <tr>
                                            <td class="text-center">{{ $item->date }}</td>
                                            <td class="text-center">
                                                @if($item->present)
                                                <span class="badge bg-success">Yes</span>
                                                @else
                                                <span class="badge bg-danger">No</span>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-assignments" role="tabpanel" aria-labelledby="pills-assignments-tab" tabindex="0">
                            <b>Assignments</b>
                            <br />
                            @if(sizeof($classes) > 0)
                                @foreach($classes as $class_info)
                                    <a
                                        href="{{ route('get_user_index') }}?class_id={{ $class_info->id }}"
                                        @if($class_id == $class_info->id)
                                            class="badge rounded-pill text-bg-primary"
                                        @else
                                            class="badge rounded-pill text-bg-secondary"
                                        @endif
                                        style="font-size: 16px; margin-right: 6px;"
                                    >
                                        {{ $class_info->course_name }} / {{ $class_info->class_name }}
                                    </a>
                                @endforeach
                            @endif
                            <br />
                            <br/>
                            <div class="table-responsive">
                                <table class="table card-table table-vcenter table-mobile-md datatable">
                                    <thead>
                                        <tr>
                                            <th class="text-center">
                                                Name
                                            </th>
                                            <th>Marks Obtained</th>
                                            <th class="text-center">Accepted</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($assignments as $assignment)
                                        <tr>
                                            <td class="text-center">{{ $assignment->assignment_name }}</td>
                                            <td class="text-center">
                                                {{ $assignment->marks_obtained }}
                                            </td>
                                            <td class="text-center">
                                                @if($assignment->accepted == true)
                                                <span class="badge bg-success">Yes</span>
                                                @endif
                                                @if($assignment->accepted == false)
                                                <span class="badge bg-danger">No</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('get_user_assignment', ['id' => $assignment->id]) }}">View</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="pills-message" role="tabpanel" aria-labelledby="pills-message-tab" tabindex="0">
                            <b>Send Message</b>
                            <br />
                            <form action="#">
                                <div class="mb-1">
                                    <label for="formGroupExampleInput" class="form-label">To</label>
                                    <select name="" class="form-select" id="">
                                        <option value="">Admin</option>
                                        <option value="">Teacher</option>
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label for="formGroupExampleInput" class="form-label">Subject</label>
                                    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="">
                                </div>
                                <div class="mb-1">
                                    <label for="formGroupExampleInput2" class="form-label">Message</label>
                                    <textarea name="" class="form-control" id="" cols="30" rows="10"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-4">{{ __('Send') }}</button>
                            </form>
                        </div>
                        <br />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br /><br />
@endsection

@section('footer')

<script src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.0/js/dataTables.bootstrap5.min.js"></script>
<script>
    $('.datatable').DataTable({
        // dom: '<"top"i>rt<"bottom"flp><"clear">'
        'columnDefs': [{
            'targets': 0,
            'searchable': false,
            'orderable': false
        }],
        'order': [0, 'desc'],
        "lengthMenu": [
            [5, 10, 25, 50, 100, 500, 1000, 2000 - 1],
            [5, 10, 25, 50, 100, 500, 1000, 2000, "All"]
        ],
        "pageLength": "20",
        dom: '<"card-body"<"d-flex"<l><"ms-auto"f>>>rt<"card-body"<"d-flex"<i><"ms-auto"p>>><"clear">'
    });
</script>
@endsection