@extends('layouts.app')
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
                <table class="table stripped-table" id="table">
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
                       @forelse ($users as $user)
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
                       @empty
                           <tr>
                               <td colspan="5"><h1 class="text-muted fw-lighter text-center">NO DATA</h1></td>
                           </tr>
                       @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection