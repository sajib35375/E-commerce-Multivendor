@extends('vendor.vendor_dashboard')
@section('vendor')

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h2>Vendor Change Password</h2>
                            <hr>
                            <form action="{{ route('vendor.change.password.update') }}" method="POST">
                                @csrf
                                <div class="my-3">
                                    <label for="">Old Password <span class="text-success">*</span></label>
                                    <input name="old_password" class="form-control" type="password">
                                    @error('old_password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="my-3">
                                    <label for="">New Password<span class="text-success">*</span></label>
                                    <input name="password" class="form-control" type="password">
                                    @error('password')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="my-3">
                                    <label for="">Confirm Password<span class="text-success">*</span></label>
                                    <input name="password_confirmation" class="form-control" type="password">
                                    @error('password_confirmation')
                                    <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="my-3">
                                    <input class="btn btn-success" value="Change" type="submit">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
