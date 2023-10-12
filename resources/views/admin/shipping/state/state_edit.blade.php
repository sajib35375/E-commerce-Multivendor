@extends('admin.admin_dashboard')
@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <div class="wrap" style="margin-top: 80px; margin-right: 20px;margin-left: 20px;">
        <div class="row">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <h2>Edit State</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('state.update',$edit_data->id) }}" method="POST">
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
                                <select class="form-control" name="district_id" id="">
                                    <option value=""></option>
                                    @foreach($districts as $item)
                                        <option {{ $item->id == $edit_data->district_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->district_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="my-3">
                                <label for="">State Name</label>
                                <input name="state_name" value="{{ $edit_data->state_name }}" class="form-control" type="text">
                            </div>
                            <div class="my-3">
                                <label for="">Delivery Charge</label>
                                <input name="delivery_charge" value="{{ $edit_data->delivery_charge }}" class="form-control" type="text">
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
                    url: main_url + "/edit/district/select/"+id,
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
