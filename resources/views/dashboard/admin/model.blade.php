@extends('layouts.app')
@push('styles')
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css"> --}}
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/jquery.dataTables.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header d-flex justify-content-end">
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="mytable">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Style Description</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                            @foreach ($style_model as $model)
                                <tr>
                                    <td>{{ $count }}</td>
                                    <td>{{ $model->model_name }}</td>
                                    <td>
                                        <form action="#" method="post" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            @php
                                $count++;
                            @endphp
                        </tbody>
                    </table>

                    {{-- <form action="{{ route('admin.store_style_description', $style->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Style Model</label>
                            <input type="text" name="model_name" class="form-control" placeholder="Enter Style Model">
                            @error('model_name')
                                <small class="text-danger"> {{ $message }} </small>
                            @enderror
                        </div>
                        <button class="btn btn-primary my-1">Submit</button>
                    </form> --}}
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