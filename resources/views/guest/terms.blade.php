@extends('_layouts.guest')
@section('title', 'Home')

@section('header')
@endsection

@section('content')

<div class="page container">
    <h2 class="element-heading col-lg-12 text-capitalize">{{ $term->title }}</h2>
    
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
    <div class="row">
        <div class="col-12">
            {{ $term->terms }}
        </div>
    </div>
</div>

@endsection

@section('footer')
@endsection