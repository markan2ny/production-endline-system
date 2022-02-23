@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-12 col-12">
        @if (Session::has('success'))
            <div class="alert alert-success">{{ Session::get('success') }}</div>
        @endif

        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4 class="m-0 fw-lighter d-inline">{{ __('Archive')}}</h4>
                <div>
                    <a href="{{ route('admin.styles') }}" class="btn btn-sm btn-danger">{{ __('Back') }}</a>
                </div>
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
                        @forelse ($archives as $archive)
                            <tr>
                                <td>{{ $count }}</td>
                                <td>{{ $archive->style_code }}</td>
                                <td>{{ $archive->style_code }}</td>
                                <td>{{ $archive->quota }}</td>
                                <td>{{ $archive->author->name }}</td>
                                <td>{{ $archive->created_at }}</td>
                                <td>
                                    <form action="{{ route('style_restore', $archive->id) }}" method="post" class="d-inline" onsubmit="return confirm('Do you want to restore this style?')">
                                        @csrf
                                        @method('patch')
                                        <button type="submit" class="btn btn-sm btn-success">Restore</button>
                                    </form>
                                    <form action="{{ route('style_delete', $archive->id) }}" method="post" class="d-inline" onsubmit="return confirm('Do you want to Force delete this style?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger">Force Delete</button>
                                    </form>
                               
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