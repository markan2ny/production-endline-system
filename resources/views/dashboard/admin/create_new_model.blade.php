@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                   <a href="{{ route('admin.show.model', $so[0]->id )}}" class="text-white">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.store_model', $so[0]->id) }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label>S.O</label>
                            <input type="text" readonly class="form-control" value="{{ $so[0]->SO }}">
                        </div>
                        <div class="form-group">
                            <label>M.O</label>
                            <input type="text" name="mo" class="form-control" placeholder="Enter Model Name">
                            @error('mo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection