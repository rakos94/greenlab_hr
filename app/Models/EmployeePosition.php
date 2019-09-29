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

class EmployeePosition extends Model
{
	/**
	 * @var array
	 */
	protected $table = 'employee_position';
	protected $guarded = [];
	
	public function employee()
	{
		return $this->belongsTo(Employee::class,'employee_id');
	}
	public function position()
	{
		return $this->belongsTo(Position::class,'position_id');
	}
}