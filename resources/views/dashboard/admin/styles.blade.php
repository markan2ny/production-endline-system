@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-12 col-12">
        @if ( Session::get('success') )
            <div class="alert alert-success mt-2"> {{ Session::get('success') }} </div>
        @elseif( Session::get('error') )
            <div class="alert alert-danger mt-2"> {{ Session::get('error') }}</div>
        @endif
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="m-0 fw-lighter d-inline">{{ __('Styles')}}</h4>
                <a href="{{ route('admin.style_archive', $styles->id ) }}" class="btn btn-sm btn-success">{{ __('View Archive') }}</a>
                <a href="{{ route('admin.create.style') }}" class="btn btn-sm btn-success">{{ __('Add new style') }}</a>
            </div>
            <div class="card-body">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>{{ __('No.')}}</th>
                            <th>{{ __('Style Code')}}</th>
                            <th>{{ __('Style Description')}}</th>
                            <th>{{ __('Target Quota')}}</th>
                            <th>{{ __('Author')}}</th>
                            <th>{{ __('Created At')}}</th>
                            <th>{{ __('Action')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $count = 1;
                        @endphp
                        @forelse ($styles as $style)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $style->style_code }}</td>
                                <td>{{ $style->style_desc }}</td>
                                <td>{{ $style->quota }}</td>
                                <td>{{ $style->author->name }}</td>
                                <td>{{ $style->created_at }}</td>
                                <td>
                                    <form action="{{ route('admin.style_delete', $style->id)}}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>

                                    </form>
                                    <a href="#" class="btn btn-primary btn-sm"><i class="fa-solid fa-pen"></i></a>
                                </td>
                            </tr>
                        @php
                            $count++;
                        @endphp    
                        @empty
                            <tr>
                                <td colspan="7"><h1 class="fw-lighter text-center text-muted">NO DATA</h1></td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection