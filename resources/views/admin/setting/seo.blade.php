@extends('admin.admin_dashboard')
@section('admin')
    <div class="wrap" style="margin-top: 80px; margin-left: 30px; margin-right: 30px;">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h2>Seo Setting</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('seo.setting.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="my-3">
                                <label for="">Meta Title</label>
                                <input name="meta_title" class="form-control" value="{{ $data->meta_title }}" type="text">
                            </div>
                            <div class="my-3">
                                <label for="">Meta Author</label>
                                <input name="meta_author" class="form-control" value="{{ $data->meta_author }}" type="text">
                            </div>
                            <div class="my-3">
                                <label for="">Meta Keywords</label>
                                <input name="meta_keywords" class="form-control" value="{{ $data->meta_keywords }}" type="text">
                            </div>
                            <div class="my-3">
                                <label for="">Meta Description</label>
                                <input name="meta_description" class="form-control" value="{{ $data->meta_description }}" type="text">
                            </div>

                            <div class="my-3">
                                <button class="btn btn-success" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
