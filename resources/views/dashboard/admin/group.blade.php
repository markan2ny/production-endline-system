@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            @if (Session::get('success'))
                <div class="alert alert-success"> {{ Session::get('success') }} </div>
            @endif
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4 class="fw-lighter m-0 d-inline text-muted">{{ count( $groups ) }} - Active Group(s)</h4>
                    <a href="{{ route('admin.create.group') }}" class="btn btn-success btn-sm">{{ __('Add new group') }}</a>
                </div>
                <div class="card-body">
                    <table class="table stripped-table">
                        <thead>
                            <tr>
                                <th>{{ __('No.')}}</th>
                                <th>{{ __('Group Name')}}</th>
                                <th>{{ __('Group Description')}}</th>
                                <th>{{ __('Status') }}</th>
                                <th>{{ __('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @forelse ($groups as $group)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $group->group_name }}</td>
                                    <td>{{ $group->group_desc }}</td>
                                    <td><span class="badge bg-success fw-light">Active</span></td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></a>
                                        <a href="#" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></a>
                                    </td>
                                </tr>
                            @php
                                $count++;
                            @endphp
                            @empty
                                <tr>
                                    <td colspan="4"><h1 class="fw-lighter m-0 text-center m-2">NO DATA</h1></td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection