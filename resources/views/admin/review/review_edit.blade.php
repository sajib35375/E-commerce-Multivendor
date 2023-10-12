@extends('admin.admin_dashboard')
@section('admin')

<div class="wrap" style="margin-top: 80px;margin-left: 30px;margin-right: 30px;">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2>Edit Review</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('review.update',$edit_data->id) }}" method="POST">
                        @csrf
                        <div class="my-3">
                            <label for="">User Name</label>
                            <select class="form-control" name="user_id" id="">
                                <option value="">-Select-</option>
                                @foreach($users as $user)
                                <option {{ $edit_data->user_id == $user->id ? 'selected' : '' }} value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="my-3">
                            <label for="">Product Name</label>
                            <select class="form-control" name="product_id" id="">
                                <option value="">-Select-</option>
                                @foreach($products as $item)
                                    <option {{ $edit_data->product_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->product_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="my-3">
                            <label for="">Comment</label>
                            <input class="form-control" name="comment" value="{{ $edit_data->comment }}" type="text">
                        </div>
                        <div class="my-3">
                            <label for="">Rating</label>
                            <input class="form-control" name="quality" value="{{ $edit_data->quality }}" type="text">
                        </div>
                        <div class="my-3">
                            <input class="btn btn-success" type="submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>







@endsection
