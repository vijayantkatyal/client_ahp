@extends('_layouts.admin')
@section('title','Message')

@section('header')
@endsection

@section('content')

        <!-- header -->
        <div class="container-xl">
            <!-- Page title -->
            <div class="page-header d-print-none">
                <div class="row align-items-center">
                    <div class="col">
                        <h2 class="page-title">
                            View Message from {{ $page->name }}
                        </h2>
                    </div>
                </div>
            </div>
        </div>

        <!-- content -->
        <div class="page-body">
            <div class="container-xl">

                @component('_layouts.components.alert')
                @endcomponent

                <div class="card mt-2">
                    <div class="card-header">
                        Name
                    </div>
                    <div class="card-body">
                        <h3>{{ $page->name }}</h3>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header">
                        Email
                    </div>
                    <div class="card-body">
                        <h3>{{ $page->email }}</h3>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header">
                        Phone
                    </div>
                    <div class="card-body">
                        <h3>{{ $page->phone }}</h3>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header">
                        Time
                    </div>
                    <div class="card-body">
                        <h3 class="moment_time">{{ $page->created_at }}</h3>
                    </div>
                </div>

                <div class="card mt-2">
                    <div class="card-header">
                        Message
                    </div>
                    <div class="card-body">
                        <h3>{{ $page->message }}</h3>
                    </div>
                </div>
            </div>
        </div>

@endsection

@section('footer')

@endsection