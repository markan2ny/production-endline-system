@extends('layouts.app')

@push('styles')
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css"> --}}
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/jquery.dataTables.css') }}">
@endpush

@section('content')
<div class="row">
    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    <div class="col-lg-4 col-12">
        <div class="card">
            <div class="card-header bg-primary d-flex justify-content-between">
                {{-- <h5 class="fw-light m-0 text-white d-inline"><i class="fa-solid fa-user"></i> Hi, {{ Auth::user()->name }}</h5> --}}
                <div class="time text-white">
                    <span id="hour">--</span>
                    <span id="minutes">--</span>
                    <span id="seconds">--</span>
                </div>
                <a href="{{ route('gpro.home') }}" class="text-decoration-none text-white">{{ $data[0]->style_code }}</a>
            </div>
            <div class="card-body">
                <form action="{{ route('gpro.store_record', $data[0]->id) }}" method="POST" id="submit-record">
                    @csrf
                    <div class="row">
                    
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-muted">Date:</label>
                                <input type="date" name="date" class="form-control">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group my-2">
                                <label class="text-muted">Bundle Tag:</label>
                                <input type="number" min="0" name="bundle_tag" class="form-control" placeholder="Enter bundle tag">
                                @error('bundle_tag')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label class="text-muted">Operation:</label>
                                <input type="number" min="0" class="form-control" name="operation" placeholder="Enter operation number">
                                @error('operation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 my-1">
                            <div class="form-group my-2">
                                <label class="text-muted">Operator:</label>
                                <select name="operator" name="operator" class="form-control">
                                    <option disabled selected>--Select--</option>
                                    <option value="#">Sample</option>
                                    <option value="#">Sample</option>
                                    <option value="#">Sample</option>
                                    <option value="#">Sample</option>
                                    <option value="#">Sample</option>
                                </select>
                                @error('operator')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 mb-3">
                            <div class="form-group">
                                <label class="text-muted">Quantity:</label>
                                <input type="number" min="0" name="qty" class="form-control" placeholder="Enter operation number">
                                @error('qty')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Entry</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Evaluate-->
    <div class="col-lg-8 col-12">
        <div class="card">
            <div class="card-header bg-success text-white">
                Record(s)
            </div>
            <div class="card-body">
                <table class="table table-hover" id="mytable">
                    <thead>
                        <tr>
                            <th>
                                <small>No.</small>
                            </th>
                            <th>
                                <small>Bundle Tag</small>
                            </th>
                            <th>
                                <small>Operator</small>
                            </th>
                            <th>
                                <small>Operation</small>
                            </th>
                            <th>
                                <small>Qty.</small>
                            </th>
                            <th>
                                <small>Action</small>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @foreach ($records as $record)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $record->bundle_tag }}</td>
                                <td>{{ $record->operator }}</td>
                                <td>{{ $record->operation }}</td>
                                <td>{{ $record->qty }}</td>
                                <td>
                                    <form action="#" method="post" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button>
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

        $( function () {
            $('#mytable').DataTable();
        })

    </script>
@endpush