@extends('admin.admin_dashboard')
@section('admin')


    <div class="wrap" style="margin-top: 80px; margin-left: 30px; margin-right: 30px;">
        <div class="row" style="display: flex;justify-content: center;align-items: center;">

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h2>User Search By Year</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('user.reports.store') }}" method="POST">
                            @csrf
                            <div class="my-3">
                                <label for="">Year</label>
                                <select class="form-control" name="year" id="">
                                    <option value="">-Select-</option>
                                    <option value="2020">2020</option>
                                    <option value="2021">2021</option>
                                    <option value="2022">2022</option>
                                    <option value="2023">2023</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                    <option value="2031">2031</option>
                                    <option value="2032">2032</option>
                                    <option value="2033">2033</option>
                                    <option value="2034">2034</option>
                                    <option value="2035">2035</option>
                                    <option value="2036">2036</option>
                                    <option value="2037">2037</option>
                                    <option value="2038">2038</option>
                                    <option value="2039">2039</option>
                                    <option value="2040">2040</option>
                                </select>
                            </div>
                            <div class="my-3">
                                <label for="">User</label>
                                <select class="form-control" name="user_id" id="">
                                    <option value="">-Select-</option>
                                    @foreach($users as $data)
                                    <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>










@endsection
