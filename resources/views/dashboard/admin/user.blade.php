@extends('layouts.app')
@push('styles')
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css"> --}}
    <link rel="stylesheet" href="{{ asset('/vendor/css/jquery.dataTables.css') }}">
@endpush
@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        @if(Session::has('success'))
            <div class="alert alert-success"> {{ Session::get('success') }}</div>
       @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="fw-lighter m-0 d-inline">{{ __('User Table')}}</h4>
                <a href="{{ route('admin.create.user') }}" class="btn btn-success btn-sm">{{ __('Add new user') }}</a>
            </div>
            <div class="card-body">
                <table class="table stripped-table" id="mytable">
                    <thead>
                        <tr>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Email') }}</th>
                            <th>{{ __('Assigned to') }}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Action') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($users as $user)
                           <tr>
                               <td>{{ $user->name }}</td>
                               <td>{{ $user->email }}</td>
                               <td>{{ $user->department }}</td>
                               <td><span class="badge bg-success fw-light">Active</span></td>
                               <td>
                                   <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                                   <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></a>
                               </td>
                           </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@push('javascripts')
    {{-- <script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.16/js/jquery.dataTables.js"></script> --}}
    <script src="{{ asset('/vendor/js/jquery.dataTables.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#mytable').DataTable();
        });
    </script>
@endpush