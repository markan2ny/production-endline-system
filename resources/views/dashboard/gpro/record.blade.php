@extends('layouts.app')

@push('styles')
    {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.16/css/jquery.dataTables.css"> --}}
    <link rel="stylesheet" href="{{ asset('/vendor/datatables/jquery.dataTables.css') }}">
@endpush

@section('content')
<div class="row">
    @if (Session::has('message'))
        <div class="alert alert-success">{{ Session::get('message') }}</div>
    @endif
    <div class="col-lg-4 col-12">
        <div class="card">
            <div class="card-header bg-primary d-flex justify-content-between">
                <h5 class="fw-light m-0 text-white d-inline"><i class="fa-solid fa-user"></i> Hi, {{ Auth::user()->name }}</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('gpro.record_store') }}">
                    @csrf
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="form-group">
                                <label class="text-muted">Date:</label>
                                <input type="date" name="date" class="form-control" value="{{ old('date') }}">
                                @error('date')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group my-2">
                                <label class="text-muted">Bundle Tag:</label>
                                <input type="number" min="0" value="{{ old('bundle_tag') }}" name="bundle_tag" class="form-control" placeholder="Enter bundle tag">
                                @error('bundle_tag')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group my-2">
                                <label class="text-muted">SO:</label>
                                <select name="style" id="parent-style" class="form-control">
                                    <option disabled selected>-Choose Style-</option>
                                    @foreach ($styles as $style)
                                        <option value="{{ $style->id }}">{{ $style->style_code }}</option>
                                    @endforeach
                                </select>
                                @error('style')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group my-2">
                                <label class="text-muted">MO:</label>
                                <select name="model_id" id="sub-style" class="form-control">
                                    {{-- code goes here --}}
                                </select>
                            </div>
                            @error('model_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-lg-12 col-12 mb-3">
                            <div class="form-group">
                                <label class="text-muted">Qty:</label>
                                <input type="number" value="{{ old('qty') }}" min="0" name="qty" class="form-control" placeholder="Enter Qty">
                                @error('qty')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 my-1">
                            <div class="form-group my-2">
                                <label class="text-muted">Status</label>
                                <select name="status" name="status" class="form-control" id="status_id">
                                    <option disabled selected>-Choose Status-</option>
                                    <option value="1">Good</option>
                                    <option value="2">Bad</option>
                                </select>
                                @error('status')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 my-1 d-none trigger_show">
                            <div class="form-group my-2">
                                <label class="text-muted">Bad Qty.</label>
                                <input type="number" name="bad_qty" class="form-control trigger_input" placeholder="Enter Bad Qty.">
                                @error('bad_qty')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-12">
                            <div class="form-group">
                                <label class="text-muted">Operation:</label>
                                <input type="number" min="0" value="{{ old('operation') }}" class="form-control" name="operation" placeholder="Enter operation number">
                                @error('operation')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12 col-12 my-1">
                            <div class="form-group my-2">
                                <label class="text-muted">Operator:</label>
                                <select name="operator" name="operator" class="form-control">
                                    <option disabled selected>-Select-</option>
                                    <option value="Sample1">Test Name 1</option>
                                    <option value="Sample2">Test Name 2</option>
                                    <option value="Sample3">Test Name 3</option>
                                    <option value="Sample4">Test Name 4</option>
                                    <option value="Sample5">Test Name 5</option>
                                </select>
                                @error('operator')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
        
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Entry</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Evaluate-->
    <div class="col-lg-8 col-12">
        <div class="card">
            <div class="card-header bg-success text-white">
                Record(s)
            </div>
            <div class="card-body">
                <table class="table table-hover" id="mytable">
                    <thead>
                        <tr>
                            <th>
                                <small>Entry Code</small>
                            </th>
                            <th>
                                <small>M.O</small>
                            </th>
                            <th>
                                <small>BdleTag</small>
                            </th>
                            <th>
                                <small>Operator</small>
                            </th>
                            <th>
                                <small>Op.</small>
                            </th>
                            <th>
                                <small>Qty.</small>
                            </th>
                            <th>
                                <small>Bad Qty.</small>
                            </th>
                            <th>
                                <small>Remark</small>
                            </th>
                            <th>
                                <small>Action</small>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                    @php
                        $count = 1;
                    @endphp
                    @foreach ($records as $record)
                        <tr>
                            <td>{{ $record->uid }}</td>
                            <td>{{ $record->model }}</td>
                            <td>{{ $record->bundle_tag }}</td>
                            <td>{{ $record->operator }}</td>
                            <td>{{ $record->operation}}</td>
                            <td>{{ $record->qty }}</td>
                            <td>{{ ($record->qty_of_bad_item == null) ? 0 : $record->qty_of_bad_item }}</td>
                            <td>
                                @if ($record->status == 1)
                                    <span class="badge bg-success">Good</span>
                                @else 
                                    <span class="badge bg-danger">Bad</span>
                                @endif
                            </td>
                            <td>
                                <form action="#" class="d-inline" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" title="Delete" onclick="return confirm('Delete this record?')" class="btn btn-sm btn-danger"><i class="fa-solid fa-trash"></i></button>
                                </form>
                                <a href="#" class="btn btn-sm btn-primary" title="Edit"><i class="fa-solid fa-pen-to-square"></i></a>
                                @if ($record->status == 1)
                                    <a href="{{ route('gpro.completedRprt', $record->id) }}" onclick="return confirm('Save this record?')" class="btn btn-sm btn-success text-white" title="Save"><i class="fa-solid fa-share-from-square"></i></a>
                                @endif
                            </td>
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
    <script src="{{ asset('/vendor/datatables/jquery.dataTables.js') }}"></script>
    <script>
        $( function () {
            $('#mytable').DataTable();
            $('#sub-style').html('<option disabled selected>-Choose model-</option>')
            
            $('#parent-style').change(function() {
                var _token = $('input[name="_token"]').val();
                var id = $(this).val();
                $('#sub-style').html('<option disabled selected>Loading....</option>')
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    type: "GET",
                    url: "getModel/" + id,
                    success: function(res) {
                        $('#sub-style').html('<option disabled selected>-Choose model-</option>');
                        res.forEach(element => {
                            $('#sub-style').append(`<option value="${element['id']}">${element['mo']}</option>`)
                        });
                    }
                })

            });
            // status dependent 
            $('#div_for_bad_qty').addClass('d-none');

            $('#status_id').change(function(){
                var choose_id = $(this).val();
                if(choose_id != 1) {
                    $('.trigger_show').removeClass('d-none');
                }
                else {
                    $('.trigger_show').addClass('d-none');
                    $('.trigger_input').val('');
                }
            })
            $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus')
            })
        })
    </script>
@endpush