<?php

namespace App\Repositories;

use App\Models\parametros_medidores;
use InfyOm\Generator\Common\BaseRepository;

class parametros_medidoresRepository extends BaseRepository
{
    protected $connection = 'ohm_v2_test';
    protected $table = 'parametros_medidores';
    protected $primaryKey = 'id_bd';
public $incrementing = TRUE;
    /**
     * @var array
     */
    protected $fieldSearchable = [
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
     * Configure the Model
     **/
    public function model()
    {
        return parametros_medidores::class;
    }
}
 