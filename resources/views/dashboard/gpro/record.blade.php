@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card mt-5">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="fw-lighter m-0 d-inline">{{ __('Hi, '). Auth::user()->name}} </h4>
                    <a href="{{ route()}}"><h4 class="fw-lighter m-0">{{ $data[0]->style_code }}</h4></a>
                </div>
            </div>
        </div>
    </div>
@endsection