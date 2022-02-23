@extends('layouts.app')
@section('content')
   
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h1 class="fw-lighter m-0 text-white">Hi, {{ Auth::user()->name }}</h1>
                </div>
                <div class="card-body">
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ipsa deleniti illo doloribus magnam, perspiciatis quidem dolorum provident sunt eum voluptatibus!</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Velit, odit!</p>
                </div>
            </div>
        </div>
    </div>

@endsection