@extends('layouts.app')
@section('content')
<div class="row">
@if ( !empty( $groups ))
    @foreach ($groups as $group)
        <div class="col-lg-4">
            <a href="#">
                <div class="card my-2">
                    <div class="card-body">
                        {{ $group->group_name }} | {{ $group->group_desc }}
                    </div>
                </div>
            </a>
        </div>
    @endforeach
@endif
</div>
@endsection