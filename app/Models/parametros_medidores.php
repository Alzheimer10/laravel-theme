<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class parametros_medidores
 * @package App\Models
 * @version June 15, 2017, 3:23 pm VET
 */
class parametros_medidores extends Model
{

    protected $connection = 'ohm_v2_test'; 
    protected $table = 'parametros_medidores';
    protected $primaryKey = 'id_bd';
    public $timestamps = false;
    protected $dates = ['deleted_at'];
public $incrementing = TRUE;

    public $fillable = [
        'id_ohm',
        'id_canal485',
        'id_medidor',
        'id_serial',
        'id_modbus',
        'nombre_cliente',
        'id_cliente',
        'id_ubicacion',
        'tipo',
        'fecha_inst',
        'fecha_elim',
        'fecha_revi',
        'ohm_esclavo',
        'tarifa1_inicio_int1',
        'tarifa1_fin_int1',
        'tarifa1_inicio_int2',
        'tarifa1_fin_int2',
        'tarifa2_inicio_int1',
        'tarifa2_fin_int1',
        'tarifa2_inicio_int2',
        'tarifa2_fin_int2',
        'tarifa3_inicio_int1',
        'tarifa3_fin_int1',
        'tarifa3_inicio_int2',
        'tarifa3_fin_int2',
        'tarifa4_inicio_int1',
        'tarifa4_fin_int1',
        'tarifa4_inicio_int2',
        'tarifa4_fin_int2',
        'tarifa_multi_intervalo',
        'dem_max1',
        'dem_max2',
        'dem_max3',
        'dem_max4',
        'ct',
        'num_consumidor',
        'funcion',
        'codigo_consumidor',
        'flag'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'id_ohm' => 'string',
        'id_canal485' => 'integer',
        'id_medidor' => 'integer',
        'id_serial' => 'integer',
        'id_modbus' => 'integer',
        'nombre_cliente' => 'string',
        'id_cliente' => 'string',
        'id_ubicacion' => 'string',
        'tipo' => 'integer',
        'ohm_esclavo' => 'boolean',
        'tarifa_multi_intervalo' => 'boolean',
        'num_consumidor' => 'string',
        'funcion' => 'string',
        'codigo_consumidor' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        
    ];

    
}
