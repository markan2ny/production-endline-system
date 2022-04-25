@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/jquery.dataTables.css') }}">
@endpush
@section('content')
    <table class="table table-hover" id="mytable">
        <thead>
            <tr>
                <th>#</th>
                <th>M.O</th>
                <th>Quota</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            @php
                $count = 1;
            @endphp
           @foreach ($models as $model)
               <tr>
                   <td>{{ $count }}</td>
                   <td>{{ $model->mo }}</td>
                   <td>{{ $model->total }} / {{ $model->target_quota }}</td>
                   <td>
                      {{ $model->date_log}}
                   </td>
               </tr>
            @php
                $count++;
            @endphp
           @endforeach
        </tbody>
    </table>
@endsection
@push('javascripts')
    <script src="{{ asset('/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#mytable').DataTable();
        });
    </script>
@endpush