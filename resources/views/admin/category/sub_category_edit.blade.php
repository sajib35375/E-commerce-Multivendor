@extends('admin.admin_dashboard')
@section('admin')

    <div class="wrap" style="margin-top: 80px;margin-right: 10px;margin-left: 10px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>SubCategory Edit</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('subcategory.update',$edit->id) }}" method="POST">
                            @csrf

                            <div class="my-3">
                                <label for="">Category</label>
                                <select class="form-control" name="category_id" id="">
                                    <option value="">Select</option>
                                    @foreach($all_cat as $cat)
                                    <option {{ $cat->id == $edit->category_id ? 'selected' : '' }} value="{{ $cat->id }}">{{ $cat->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="my-3">
                                <label for="">Sub Category</label>
                                <input name="sub_name" class="form-control" value="{{ $edit->sub_name }}" type="text">
                                @error('sub_name')
                                <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="my-3">
                                <input class="btn btn-primary" type="submit">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
