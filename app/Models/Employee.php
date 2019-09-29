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
use App\Models\Position;
use DB;

class Employee extends Model
{
	/**
	 * @var array
	 */
	protected $guarded = [];
	
	public function position()
	{
		return $this->hasOne(Position::class,'employee_id');
	}
	public function employee_position()
	{
		return $this->hasMany(EmployeePosition::class,'employee_id');
	}

	
	public static function new(Request $request)
	{
		$data = static::create([
			'nama'  					=> $request->get('nama'),
			'nip'   					=> $request->get('nip'),
			'tanggal_masuk'   => $request->get('tanggal_masuk'),
			'type'   					=> $request->get('type'),
			'status_menikah'  => $request->get('status_menikah'),
			'pay_grade'  			=> $request->get('pay_grade'),
			'gaji'  					=> $request->get('gaji'),
			'status'  				=> $request->get('status'),
		]);
		return $data;
	}

	public function new_position($request)
	{
		DB::beginTransaction();
		$position = Position::updateEmployee($request->position_id,$this->id);
		$history = $this->employee_position()->create(['position_id' => $request->position_id]);
		if(!$history) DB::rollBack();
		DB::commit();
		return $this->load('position');
	}
	
	
}