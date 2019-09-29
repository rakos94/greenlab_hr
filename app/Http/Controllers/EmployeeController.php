<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Position;
use DB;

class EmployeeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function get()
    {
        $employees = Employee::get();

        return view('employee.list', compact('employees'));
    }
    public function show($id)
    {
        $employee = Employee::find($id);
        $positions = Position::get();

        return view('employee.show', compact('employee','positions'));
    }
    public function create(Request $request)
    {
        $validatedData = $request->validate([
			'nama'              =>'required',
			'nip'               =>'required',
			'tanggal_masuk'     =>'required',
			'type'				=>'required',
			'status_menikah'    =>'required',
			'pay_grade'         =>'required',
			'gaji'          	=>'required',
			'status'            =>'required',
        ]);
        $employee = Employee::new($request);

        return redirect()->route('employee.show',$employee->id)->with('status', 'Employee created!');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
			'nama'              =>'required',
			'nip'               =>'required',
			'tanggal_masuk'     =>'required',
			'type'				=>'required',
			'status_menikah'    =>'required',
			'pay_grade'         =>'required',
			'gaji'          	=>'required',
			'status'            =>'required',
        ]);
        $employees = Employee::find($id)->update($request->all());

        return redirect()->back()->with('status', 'Employee updated!');
    }
    public function delete($id)
    {
        $employee = Employee::find($id)->delete();

        return redirect()->route('employee.list')->with('status', 'Delete success!');
	}
	
	
    public function EmployeePosition(Request $request)
    {
        $validatedData = $request->validate([
			'year'              =>'nullable|numeric|min:1900|max:2500',
		]);
		if($request->year) {
			$employees = Employee::whereHas('employee_position',function($q) use ($request){
				$q->whereYear('created_at', '=', $request->year);
			})->get();
		}
		else {
			$employees = Employee::with('employee_position')->get();
		}
		
        return view('employee-position.list', compact('employees','request'));
	}
	
    public function newPosition(Request $request, $id)
    {
        $validatedData = $request->validate([
			'position_id'              =>'required',
		]);
        $employee = Employee::find($id)->new_position($request);

        return redirect()->back()->with('status', 'Success add position!');
    }
}
