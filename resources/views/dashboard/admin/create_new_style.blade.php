@extends('layouts.app')
@section('content')

<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="fw-lighter m-0">{{ __('Create Style') }}</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.store.style') }}">
                    @csrf
                    <div class="form-group">
                        <label for="style">{{ __('Style Code') }}</label>
                        <input type="text" name="style_code" class="form-control" id="style" placeholder="Enter Style Code">
                        @error('style_code')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="quota">{{ __('Target Quota') }}</label>
                        <input type="number" name="quota" class="form-control" id="quota" min="0" placeholder="Enter Target Quota">
                        @error('quota')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">{{ __('Submit') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection