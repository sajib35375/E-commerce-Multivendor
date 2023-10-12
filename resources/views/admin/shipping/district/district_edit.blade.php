@extends('admin.admin_dashboard')
@section('admin')

    <div class="wrap" style="margin-top: 80px; margin-right: 20px;margin-left: 20px;">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit District</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('district.update',$edit_data->id) }}" method="POST">
                            @csrf
                            <div class="my-3">
                                <label for="">Division Name</label>
                                <select class="form-control" name="division_id" id="">
                                    <option value=""></option>
                                    @foreach($divisions as $item)
                                    <option {{ $item->id == $edit_data->division_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->division_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-3">
                                <label for="">District Name</label>
                                <input name="district_name" value="{{ $edit_data->district_name }}" class="form-control" type="text">
                            </div>
                            <div class="my-3">
                                <button type="submit" class="btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
