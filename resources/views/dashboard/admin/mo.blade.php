@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/jquery.dataTables.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <a href="{{ route('admin.styles') }}">Back</a>
                    <a href="{{ route('admin.create.model', $id)}}" class="btn btn-sm btn-success">Add new model</a>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="mytable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th style="white-space: nowrap;">Style Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($models as $model)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $model->mo}}</td>
                                <td>
                                    <a href="{{ route('admin.edit.model', $model->id )}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                    <form action="{{ route('admin.delete.model', $model->id )}}" class="d-inline" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Delete this record?')"><i class="fa-solid fa-trash"></i></button>
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