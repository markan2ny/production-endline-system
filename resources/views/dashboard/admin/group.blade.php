@extends('layouts.app')
@push('styles')
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css"> --}}
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/jquery.dataTables.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            @if (Session::get('success'))
                <div class="alert alert-success"> {{ Session::get('success') }} </div>
            @endif
            <div class="card">
                <div class="card-header bg-primary text-white d-flex justify-content-between">
                    <h4 class="fw-lighter m-0 d-inline">{{ count( $groups ) }} - Active Group(s)</h4>
                    <a href="{{ route('admin.create.group') }}" class="btn btn-success btn-sm">{{ __('Add new group') }}</a>
                </div>
                <div class="card-body">
                    <table class="table stripped-table" id="mytable">
                        <thead>
                            <tr>
                                <th>{{ __('No.')}}</th>
                                <th>{{ __('Group Name')}}</th>
                                <th>{{ __('Group Description')}}</th>
                                <th>{{ __('Action')}}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($groups as $group)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $group->group_name }}</td>
                                    <td>{{ $group->group_desc }}</td>
                                    <td>
                                        <a href="#" class="btn btn-sm btn-primary"><i class="fa-solid fa-eye"></i></a>
                                        <form method="POST" action="{{ route('admin.delete.group', $group->id) }}" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @php
                                $count++;
                            @endphp
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
    <script src="{{ asset('/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#mytable').DataTable();
        });
    </script>
@endpush