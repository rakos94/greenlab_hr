<?php
/**
 * Created by PhpStorm.
 * User: kamal
 * Date: 25/09/19
 * Time: 14:59
 */

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Position extends Model
{
	/**
	 * @var array
	 */
	protected $guarded = [];
	
	public function employee_position()
	{
		return $this->hasOne(EmployeePosition::class,'position_id');
	}

	public function approval()
	{
		return $this->hasOne(PositionApproval::class,'position_id');
	}

	public function getApprovalListAttribute()
	{
			return $this->getManager();
	}
	
	public function getManager($data = [])
	{
		$last = count($data) - 1;
		if(count($data) > 0) {
			$last_data = $data[$last];
		} else {
			$last_data = $this;
		}
		if($last_data->approval) {
			array_push($data,$last_data->approval->manager);
			return $this->getManager($data);
    }	else {
			return $data;
    }
	}
	
	public static function new(Request $request)
	{
		$data = static::create([
			'number'   				=> $request->get('number'),
			'name'  					=> $request->get('name'),
		]);
		return $data;
	}
	public static function updateEmployee($position_id, $employee_id)
	{
		$exist = static::where('employee_id',$employee_id)->update(['employee_id' => null]);
		$data = static::find($position_id);
		$data->employee_id = $employee_id;
		$data->save();
		return $data;
	}
	
}