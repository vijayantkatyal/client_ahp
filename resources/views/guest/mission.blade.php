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
                <h3>Our Mission</h3>
                <p class="mt-4 res-margin">
                    Alberta Hindi Parishad was founded in 1985 with main objective to provide regular classes to teach Hindi systematically. Hindi Vidyalaya was started in 1987 at the University of Alberta with the help of (late) Professor Emeritus Dr. Ambikeshwar Sharma. Alberta Hindi Parishad chose the books prepared and published by National Council of Educational Research and Training (NCERT)-Baal Bharati is used in the central school system throughout India, as the curriculum to structure the classes. Experienced teachers provide basic training and guidance to the volunteer teachers. Hindi Vidyalaya conducts five classes (levels 1 to 5) for children from 5 to 15 years old.
                </p>
                <p>
                    There are separate classes for adults where basic reading, writing and speaking is taught, followed by conversation class, where emphasis is on Hindi speaking and a class of grammar. Students participate in many programs like Holi, Independence Day, Kavi Sammelan, Hindi Divas, Antakshari, field trips and annual picnic. These programs are organized by Hindi Parishad. Students and members are encouraged to submit articles, poems and short stories our annual publication MEDHAVANI and newsletter KRITI.
                </p>
                <a href="{{ route('get_contact') }}" class="btn btn-secondary ">Contact us</a>
            </div>
        </div>
    </div>
</section>

<br/>

@endsection

@section('footer')
@endsection