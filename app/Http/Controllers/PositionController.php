<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Models\PositionApproval;

class PositionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function get()
    {
        $positions = Position::get();

        return view('position.list', compact('positions'));
    }
    public function show($id)
    {
        $position = Position::find($id);
        $positions = Position::where('id','!=',$id)->get();

        return view('position.show', compact('position','positions'));
    }
    public function create(Request $request)
    {
        $validatedData = $request->validate([
			'number'            =>'required',
			'name'              =>'required',
        ]);
        $position = Position::new($request);

        return redirect()->route('position.show',$position->id)->with('status', 'Position created!');
    }
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
			'number'            =>'required',
			'name'              =>'required',
        ]);
        $positions = Position::find($id)->update($request->all());

        return redirect()->back()->with('status', 'Position updated!');
    }
    public function delete($id)
    {
        $positions = Position::find($id)->delete();

        return redirect()->route('employee.list')->with('status', 'Delete success!');
    }

    public function ApprovalList()
    {
        $positions = Position::get();

        return view('approval.list', compact('positions'));
    }
    
    public function addManager(Request $request, $id)
    {
        $approval = PositionApproval::updateOrCreate(['position_id'=>$id],['manager_position_id' => $request->manager_position_id]);

        return redirect()->back()->with('status', 'Approval updated!');
    }
}
