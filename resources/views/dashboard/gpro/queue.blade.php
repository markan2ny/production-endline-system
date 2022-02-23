@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-12 col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="fw-light m-0">Queuing Table</h4>
                </div>
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Style Code</th>
                                <th>Bundle Tag</th>
                                <th>Operator</th>
                                <th>Operation</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>WN000012345</td>
                                <td>632354526</td>
                                <td>Juan Dela Cruz</td>
                                <td>20</td>
                                <td>
                                    <a href="" class="btn btn-danger btn-sm">Delete</a>
                                    <a href="" class="btn btn-primary btn-sm">Edit</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection