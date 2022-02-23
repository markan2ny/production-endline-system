@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="fw-lighter m-0">{{ __('Create Group')}}</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.store.group') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label>{{ __('Group Name')}}</label>
                        <input type="text" class="form-control" placeholder="Group Name" name="group_name" value="{{ old('group_name') }}">
                        @error('group_name')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>{{ __('Group Description')}}</label>
                        <input type="text" class="form-control" placeholder="Group Description" name="group_desc" value="{{ old('group_desc') }}">
                        @error('group_desc')
                            <small class="text-danger"> {{ $message }} </small>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mt-2">{{ __('Submit') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection