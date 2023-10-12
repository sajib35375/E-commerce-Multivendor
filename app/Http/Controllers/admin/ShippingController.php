<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\State;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ShippingController extends Controller
{
    public function divisionView(){
        $all_division = Division::all();
        return view('admin.shipping.division.division',compact('all_division'));
    }

    public function divisionStore(Request $request){
        $this->validate($request,[
            'division_name' => 'required'
        ]);

        Division::insert([
            'division_name' => $request->division_name,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('message','Division Inserted Successfully');
    }


    public function divisionEdit($id){
        $edit_data = Division::find($id);
        return view('admin.shipping.division.division_edit',compact('edit_data'));
    }

    public function divisionUpdate(Request $request,$id){
        $update = Division::find($id);
        $update->division_name = $request->division_name;
        $update->updated_at = Carbon::now();
        $update->update();

        return redirect()->route('division.view')->with('message','Division Updated Successfully');
    }

    public function divisionDelete($id){
        $delete = Division::find($id);
        $delete->delete();

        return redirect()->back()->with('warning','Division Deleted Successfully');
    }
    public function districtView(){
        $divisions = Division::all();
        $districts = District::with('division')->get();
        return view('admin.shipping.district.district',compact('districts','divisions'));
    }

    public function districtStore(Request $request){
        $this->validate($request,[
            'division_id' => 'required',
            'district_name' => 'required',
        ]);

        District::insert([
            'division_id' => $request->division_id,
            'district_name' => $request->district_name,
            'created_at' => Carbon::now(),
        ]);

        return redirect()->back()->with('message','District Added Successfully');
    }

    public function districtEdit($id){
        $edit_data = District::find($id);
        $divisions = Division::all();
        return view('admin.shipping.district.district_edit',compact('edit_data','divisions'));
    }


    public function districtUpdate(Request $request,$id){
        $update = District::find($id);
        $update->division_id = $request->division_id;
        $update->district_name = $request->district_name;
        $update->updated_at = Carbon::now();
        $update->update();

        return redirect()->route('district.view')->with('message','District Updated Successfully');
    }

    public function districtDelete($id){
        $delete_data = District::find($id);
        $delete_data->delete();

        return redirect()->back()->with('warning','District Deleted Successfully');
    }

    public function stateView(){
        $states = State::with('division','district')->get();
        $divisions = Division::all();
        $districts = District::all();
        return view('admin.shipping.state.state',compact('states','divisions','districts'));
    }


    public function districtSelect($id){
        $district = District::where('division_id',$id)->get();
        return json_encode($district);
    }


    public function stateStore(Request $request){
        $this->validate($request,[
            'division_id' => 'required',
            'district_id' => 'required',
            'state_name' => 'required',
            'delivery_charge' => 'required',
        ]);

        State::insert([
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'state_name' => $request->state_name,
            'delivery_charge' => $request->delivery_charge,
            'created_at' => Carbon::now()
        ]);

        return redirect()->back()->with('message','State Added Successfully');
    }

    public function stateEdit($id){
        $edit_data = State::find($id);
        $divisions = Division::all();
        $districts = District::all();

        return view('admin.shipping.state.state_edit',compact('edit_data','districts','divisions'));
    }

    public function districtSelectEdit($id){
        return District::where('division_id',$id)->get();
    }

    public function stateUpdate(Request $request,$id){
       $update = State::find($id);
       $update->division_id = $request->division_id;
       $update->district_id = $request->district_id;
       $update->state_name = $request->state_name;
       $update->delivery_charge = $request->delivery_charge;
       $update->updated_at = Carbon::now();
       $update->update();

        return redirect()->route('state.view')->with('message','State Updated Successfully');
    }

    public function stateDelete($id){
        $delete_data = State::find($id);
        $delete_data->delete();

        return redirect()->back()->with('warning','State Deleted Successfully');
    }


}
