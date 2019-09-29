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

class PositionApproval extends Model
{
	/**
	 * @var array
	 */
	protected $table = 'positions_approval';
	protected $guarded = [];
	
	public function position()
	{
		return $this->belongsTo(Position::class,'position_id');
	}
	public function manager()
	{
		return $this->belongsTo(Position::class,'manager_position_id');
	}
}