@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-10 offset-lg-1">
            <div class="card">
                <div class="card-header bg-primary d-flex justify-content-between">
                    <h5 class="fw-light m-0 text-white d-inline"><i class="fa-solid fa-user"></i> Hi, {{ Auth::user()->name }}</h5>
                    <a href="{{ route('gpro.home') }}" class="text-decoration-none text-white">{{ $data->style_code }}</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('gpro.store_record', $data->id) }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-lg-8 d-flex align-items-center">
                                <h3 class="m-0" id="time">TIME: 16:24:00 PM</h3>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label class="text-muted">Date:</label>
                                    <input type="date" name="date" class="form-control">
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group my-2">
                                    <label class="text-muted">Bundle Tag:</label>
                                    <input type="number" min="0" name="bundle_tag" class="form-control" placeholder="Enter bundle tag">
                                </div>
                            </div>
                            <div class="col-lg-12 col-12">
                                <div class="form-group">
                                    <label class="text-muted">Operation:</label>
                                    <input type="text" class="form-control" name="operation" placeholder="Enter operation number">
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 my-1">
                                <div class="form-group my-2">
                                    <label class="text-muted">Operator:</label>
                                    <select name="operator" name="operator" class="form-control">
                                        <option disabled selected>--Select--</option>
                                        <option value="#">Sample</option>
                                        <option value="#">Sample</option>
                                        <option value="#">Sample</option>
                                        <option value="#">Sample</option>
                                        <option value="#">Sample</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-12 col-12 mb-3">
                                <div class="form-group">
                                    <label class="text-muted">Quantity:</label>
                                    <input type="number" min="0" name="quantity" class="form-control" placeholder="Enter operation number">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit Entry</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection