<?php

namespace App\Http\Controllers\ftpOenergy\modelo;

use Illuminate\Database\Eloquent\Model;

class ftpOenergy extends Model
{
	protected $table = 'rendicion';

    protected $connection = 'pgsql';

    public $timestamps = false;
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id' => 'integer',
		'value1'	=>	'string',
        'value2'    =>  'string',
		'value3'	=>	'string',
        'value4'   =>   'string',
		'value5'	=>	'string',
		'value6'	=>	'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
		'value1'	=> 'required',
		'value2'	=> 'required',
        'value3'   => 'required',
		'value4'	=> 'required',
		'value5'	=> 'required',
		'value6'	=> 'required'
    ];
}