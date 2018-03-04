<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class createParametrosMedidoresRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            /*
            'id_ohm' => 'required',
            'id_canal485' => 'required',
            'id_medidor' => 'required',
            'id_serial' => 'required',
            'id_modbus' => 'required',
            'nombre_cliente' => 'required',
            'id_cliente' => 'required',
            'id_ubicacion' => 'required',
            'tipo' => 'required',
            'funcion' => 'required',
            'fecha_inst' => 'required',
            'fecha_elim' => 'required',
            'fecha_revi' => 'required',
            'ohm_esclavo' => 'required',
            'tarifa1_inicio_int1' => 'required',
            'tarifa1_fin_int1' => 'required',
            'tarifa1_inicio_int2' => 'required',
            'tarifa1_fin_int2' => 'required',
            'tarifa2_inicio_int1' => 'required',
            'tarifa2_fin_int1' => 'required',
            'tarifa2_inicio_int2' => 'required',
            'tarifa2_fin_int2' => 'required',
            'tarifa3_inicio_int1' => 'required',
            'tarifa3_fin_int1' => 'required',
            'tarifa3_inicio_int2' => 'required',
            'tarifa3_fin_int2' => 'required',
            'tarifa4_inicio_int1' => 'required',
            'tarifa4_fin_int1' => 'required',
            'tarifa4_inicio_int2' => 'required',
            'tarifa4_fin_int2' => 'required',
            'tarifa_multi_intervalo' => 'required',
            'dem_max1' => 'required',
            'dem_max2' => 'required',
            'dem_max3' => 'required',
            'dem_max4' => 'required',
            'ct' => 'required',
            'codigo_consumidor' => 'required'
            'num_consumidor' => 'required',
             */
        ];
    }
}
