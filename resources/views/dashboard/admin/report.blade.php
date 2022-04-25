@extends('layouts.app')
@push('styles')
<link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{ asset('/plugins/datatables-buttons/css/buttons.bootstrap4.min.css')}}">
@endpush
@section('content')
<div class="mt-5 mb-3 ">
    <form action="{{ route('admin.searchRprt')}}" class="d-flex justify-content-end" method="POST">
        @csrf   
        <div style="margin-right: 10px;">
            <label for="">FROM</label>
            <input type="date" class="form-control" name="fromdate">
            @error('fromdate')
                {{ $message }}
            @enderror
       </div>
        <div style="margin-right: 10px;">
            <label for="">TO</label>
            <input type="date" class="form-control" name="todate">
            @error('todate')
                {{ $message }}
            @enderror
        </div>
        <div class="align-self-end">
            <button type="submit" class="btn btn-primary"><i class="fa-solid fa-magnifying-glass"></i></button>
        </div>
    </form>
</div>
@if (Session::has('message'))
    <div class="alert alert-info">
        {{ Session::get('message') }}
    </div>
@endif
<div class="card">
    <div class="card-header bg-success text-white">
        <h4 class="m-0">REPORT</h4>
    </div>
    <div class="card-body">
        <table class="table table-hover" id="example1">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Model</th>
                    <th>Bundle Tag</th>
                    <th>Operator</th>
                    <th>Operation</th>
                    <th>Checked by</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($reports as $report)
                <tr>
                    <td>{{ $report->date_time }}</td>
                    <td>{{ $report->model }}</td>
                    <td>{{ $report->bundle_tag }}</td>
                    <td>{{ $report->operator }}</td>
                    <td>{{ $report->operation }}</td>
                    <td>{{ $report->name }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
@push('javascripts')
<script src="{{ asset('/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/dataTables.buttons.min.js')}}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{ asset('/plugins/jszip/jszip.min.js')}}"></script>
<script src="{{ asset('/plugins/pdfmake/pdfmake.min.js')}}"></script>
<script src="{{ asset('/plugins/pdfmake/vfs_fonts.js')}}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script src="{{ asset('/plugins/datatables-buttons/js/buttons.print.min.js')}}"></script>
<script>
    $(document).ready( function () {
        $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["csv", "excel", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>
@endpush