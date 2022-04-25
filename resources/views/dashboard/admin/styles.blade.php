@extends('layouts.app')
@push('styles')
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css"> --}}
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/jquery.dataTables.css') }}">
@endpush
@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        @if ( Session::get('success') )
            <div class="alert alert-success mt-2"> {{ Session::get('success') }} </div>
        @elseif( Session::get('error') )
            <div class="alert alert-danger mt-2"> {{ Session::get('error') }}</div>
        @endif
        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between">
                <h4 class="m-0 fw-lighter d-inline">{{ __('Styles')}}</h4>
                <div>
                    {{-- <a href="{{ route('admin.archive') }}" class="btn btn-sm btn-danger">{{ __('View Archive') }}</a> --}}
                    <a href="{{ route('admin.create.style') }}" class="btn btn-sm btn-success">{{ __('Add new style') }}</a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover" id="mytable">
                    <thead>
                        <tr>
                            <th>{{ __('No.')}}</th>
                            <th>{{ __('Style Code')}}</th>
                            <th>{{ __('Quota Per')}}</th>
                            <th>{{ __('Status') }}</th>
                            <th>{{ __('Author')}}</th>
                            <th>{{ __('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($styles as $style)
                            <tr>
                                <td>{{ $count }}</td>
                                <td><a href="{{ route('admin.show.model', $style->id) }}">{{ $style->style_code }}</a></td>
                                <td>{{ $style->quota }}</td>
                                <td><span class="badge {{ $style->status ? 'bg-success' : 'bg-warning' }}">{{ $style->status ? 'Done' : 'On-progress'}}</span></td>
                                <td>{{ $style->name }}</td>
                                <td>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen"></i></a>
                                    <form action="{{ route('admin.delete.style', $style->id)}}" method="POST" class="d-inline" onsubmit="return confirm('Do you want to delete this style?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
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