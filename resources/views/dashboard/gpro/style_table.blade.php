@extends('layouts.app')
@push('styles')
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css"> --}}
    <link rel="stylesheet" href="{{ asset('/vendor/css/jquery.dataTables.css') }}">
@endpush
@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h4 class="m-0 fw-lighter">{{ __('Style Table') }}</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover" id="mytable">
                        <thead>
                            <tr>
                                <th>{{ __('No.') }}</th>
                                <th>{{ __('Style Code') }}</th>
                                <th>{{ __('Style Description') }}</th>
                                <th>{{ __('target Quota') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                           @foreach ($styles as $style)
                               <tr>
                                   <td>{{ $count }}</td>
                                   <td>
                                       <a href="{{ route('gpro.record', $style->id) }}">{{ $style->style_code}}</a>
                                   </td>
                                   <td>{{ $style->style_desc}}</td>
                                   <td>{{ $style->quota}}</td>
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
    <script src="{{ asset('/vendor/js/jquery.dataTables.js') }}"></script>
    <script>
        $(document).ready( function () {
            $('#mytable').DataTable();
        });
    </script>
@endpush