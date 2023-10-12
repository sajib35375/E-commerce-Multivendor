@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="wrap" style="margin-top: 80px;margin-left: 20px;margin-right: 20px;">
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>All State</h2>
                    </div>
                    <div class="card-body">
                        <table id="example" class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Division Name</th>
                                <th>District Name</th>
                                <th>State Name</th>
                                <th>Delivery Charge</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($states as $item)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $item->division->division_name }}</td>
                                    <td>{{ $item->district->district_name }}</td>
                                    <td>{{ $item->state_name }}</td>
                                    <td>{{ $item->delivery_charge }}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{ route('state.edit',$item->id) }}">Edit</a>
                                        <a class="btn btn-danger" id="delete" href="{{ route('state.delete',$item->id) }}">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>#</th>
                                <th>Division Name</th>
                                <th>District Name</th>
                                <th>State Name</th>
                                <th>Delivery Charge</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h2>Add New State</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('state.store') }}" method="POST">
                            @csrf
                            <div class="my-3">
                                <label for="">Division Name</label>
                                <select class="form-control" name="division_id" id="">
                                    <option value="">-Select-</option>
                                    @foreach($divisions as $item)
                                        <option value="{{ $item->id }}">{{ $item->division_name }}</option>
                                    @endforeach
                                </select>
                                @error('division_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="">District Name</label>
                                <select name="district_id" class="form-control" id="">
                                    <option value="">-Select-</option>
                                    @foreach($districts as $item)
                                        <option value="{{ $item->id }}">{{ $item->district_name }}</option>
                                    @endforeach
                                </select>
                                @error('district_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="my-3">
                                <label for="">State Name</label>
                                <input name="state_name" class="form-control" type="text">
                            </div>
                            <div class="my-3">
                                <label for="">Delivery Charge</label>
                                <input name="delivery_charge" class="form-control" type="text">
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



    <script>
        $(document).ready(function (){
            $(document).on('change','select[name="division_id"]',function (e){
                e.preventDefault();
                let id = $(this).val();
                let main_url = "http://localhost:8000";
                $.ajax({
                    url: main_url + "/district/select/"+id,
                    type: "GET",
                    dataType: "json",
                    success: function (data){
                        $('select[name="district_id"]').empty();
                        $.each(data,function (key,value){
                            $('select[name="district_id"]').append('<option value="'+value.id+'">'+value.district_name+'</option>')
                        })
                    }
                })
            })
        })
    </script>



@endsection
