<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContractTemplate extends Model
{
	use SoftDeletes;

	protected $fillable = [
	'name', 'description',
	];

	protected $dates = [
	'deleted_at',
	];
    
}
