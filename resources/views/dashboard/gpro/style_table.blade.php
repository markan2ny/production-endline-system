@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-8 offset-lg-2">
            <div class="card">
                <div class="card-header">
                    <h4 class="m-0 fw-lighter">Style Table</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Style Code</th>
                                <th>Style Description</th>
                                <th>target Quota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $count = 1;
                            @endphp
                           @forelse ($styles as $style)
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
                           @empty
                               <tr>
                                   <td colspan="4">
                                       <h1 class="fw-lighter m-0 text-center text-muted">NO DATA</h1>
                                   </td>
                               </tr>
                           @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>    
@endsection