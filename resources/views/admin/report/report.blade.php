@extends('admin.admin_dashboard')
@section('admin')


<div class="wrap" style="margin-top: 80px; margin-left: 30px; margin-right: 30px;">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2>Search By Date</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('date.reports') }}" method="POST">
                        @csrf
                        <div class="my-3">
                            <label for="">Date</label>
                            <input class="form-control" name="date" type="date">
                        </div>
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2>Search By Month</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('month.reports') }}" method="POST">
                        @csrf
                        <div class="my-3">
                            <label for="">Month</label>
                            <select class="form-control" name="month" id="">
                                <option value="">-Select-</option>
                                <option value="January">January</option>
                                <option value="February">February</option>
                                <option value="March">March</option>
                                <option value="April">April</option>
                                <option value="June">June</option>
                                <option value="July">July</option>
                                <option value="August">August</option>
                                <option value="September">September</option>
                                <option value="October">October</option>
                                <option value="November">November</option>
                                <option value="December">December</option>
                            </select>
                        </div>
                        <div class="my-3">
                            <label for="">Year</label>
                            <select class="form-control" name="year_name" id="">
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
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h2>Search By Year</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('year.reports') }}" method="POST">
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
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>










@endsection
