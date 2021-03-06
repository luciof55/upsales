<?php

namespace App\Model\Administration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Enumeration\RecordStateType;

class BusinessRecordState extends Model
{
	use SoftDeletes;
	
	protected $table = 'business_record_state';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'id', 'closed_state',
    ];
	
	/**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
	
	/**
     * The attributes uses to sort.
     *
     * @var array
     */
    protected $orderAttributes = ['name'];
	
	/**
     * The attributes uses to filter.
     *
     * @var array
     */
    protected $filterAttributes = ['name'];
	
	public function getClosedState() {
		$select_types = RecordStateType::getEnumTranslate();
		return $select_types->get($this->closed_state);
	}
	
	public function businessRecords() {
		return $this->hasMany('App\Model\Administration\BusinessRecord', 'state_id')->withTrashed();
	}
	
	public function initialWorkflows() {
		return $this->hasMany('App\Model\Administration\Workflow', 'initial_state_id')->withTrashed();
	}
	
	public function finalWorkflows() {
		return $this->hasMany('App\Model\Administration\Workflow', 'final_state_id')->withTrashed();
	}
	
	public function canDelete() {
		return true;
	}
	
	public function getOrderAttributes() {
		return $this->orderAttributes;
	}
	
	public function getFilterAttributes() {
		return $this->filterAttributes;
	}
	
	public function isSoftDelete() {
		return true;
	}
}
