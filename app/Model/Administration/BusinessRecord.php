<?php

namespace App\Model\Administration;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BusinessRecord extends Model
{
    use Notifiable;
	use SoftDeletes;
	
	protected $table = 'business_records';
	
	/**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'id', 'account_id', 'state_id', 'leader_id', 'comercial_id', 'workflow_id', 'management_tool', 'repository', 'notes'
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
    protected $orderAttributes = ['name', 'account-name', 'comercial-name', 'state-name'];

	/**
     * The attributes uses to filter.
     *
     * @var array
     */
    protected $filterAttributes = ['name', 'account_id', 'comercial_id', 'state_id'];
	
	public function account() {
		 return $this->belongsTo('App\Model\Administration\Account')->withTrashed();
	}
	
	public function state() {
		 return $this->belongsTo('App\Model\Administration\BusinessRecordState', 'state_id')->withTrashed();
	}
	
	public function leader() {
		 return $this->belongsTo('App\UpsalesUser', 'leader_id')->withTrashed();
	}
	
	public function comercial() {
		 return $this->belongsTo('App\UpsalesUser', 'comercial_id')->withTrashed();
	}
	
	public function comercialName() {
		if (isset($this->comercial)) {
			return $this->comercial->name;
		} else {
			return '';
		}
	}
	
	public function leaderName() {
		if (isset($this->leader)) {
			return $this->leader->name;
		} else {
			return '';
		}
	}
	
	public function workflow() {
		return $this->belongsTo('App\Model\Administration\Workflow')->withTrashed();
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