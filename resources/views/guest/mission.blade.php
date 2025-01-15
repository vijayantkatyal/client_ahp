@extends('_layouts.guest')
@section('title', 'Mission')

@section('header')
@endsection

@section('content')

<section id="about-home" class="container-fluid pb-0">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <img class="img-fluid rounded" src="http://ahpschool.ca/Ref/images/school1.jpg" alt="">
            </div>
            <div class="col-12">
                <br/>
                <h3>{{ App\Models\Site::getItem($page->page_schema, 'mission', 'title') }}</h3>
                <p class="mt-4 res-margin">
                    {!! App\Models\Site::getItem($page->page_schema, 'mission', 'summary') !!}
                </p>
                <a href="{{ App\Models\Site::getItem($page->page_schema, 'mission', 'link_url') }}" class="btn btn-secondary ">{{ App\Models\Site::getItem($page->page_schema, 'mission', 'link_title') }}</a>
            </div>
        </div>
    </div>
</section>

<br/>

@endsection

@section('footer')
@endsection