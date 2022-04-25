@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-6 offset-lg-3">
            <div class="card">
                <div class="card-header bg-primary text-white">
                   <a href="{{ route('admin.show.model', $model[0]->style_id )}}" class="text-white">Back</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.update.model', $model[0]->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="form-group">
                            <label>S.O</label>
                            <input type="text" readonly class="form-control" value="{{ $model[0]->style_code }}">
                        </div>
                        <div class="form-group">
                            <label>M.O</label>
                            <input type="text" name="mo" value="{{ $model[0]->mo }}" class="form-control" placeholder="Enter Model Name">
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