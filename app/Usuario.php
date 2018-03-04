<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;

class Usuario extends Authenticatable
{
    use Notifiable;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'usuarios';

    protected $fillable = [
        'password', 'razon', 'rut', 'nombre', 'apellido', 'id_pais', 'id_estado', 'id_ciudad', 'calle', 'numero_departamento', 'username',  'email', 'telefono', 'codigo_telefono', 'giro', 'tipo_usuario', 'tipo_boleta', 'eliminado',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'remember_token',
    ];

    protected $dates = ['created_at', 'updated_at'];

    //-----------------------------------ATRIBUTOS Y REGLAS VALIDACION--------------------------------//
    public static $atributos = [
        'nombre'=>'Nombre',
        'apellido'=>'Apellido',
        'id_pais'=>'País',
        'id_estado'=>'Estado',
        'id_ciudad'=>'Ciudad',
        'calle'=>'Dirección',
        'numero_departamento'=>'N° Departamento/Oficina',
        'email'=>'Email',
        'codigo_telefono'=>'Código',
        'telefono'=>'Teléfono',
        'old_password'=>'Clave actual',
        'password'=>'Nueva clave',
        'confirm_password'=>'Confirmar clave',
        'tipo_usuario'=>'Tipo de usuario',
        'tipo_boleta'=>'Boleta',
        'rut'=>'RUT'
    ];

    public static function rules ($method, $id=0){
        switch($method){
            case 'CREATE':
            {
                return [
                    'rut'=>'required',
                    'nombre'=>'required',
                    'apellido'=>'required',
                    'id_pais'=>'required',
                    'id_estado'=>'required',
                    'id_ciudad'=>'required',
                    'calle'=>'required',
                    'numero_departamento'=>'required',
                    'email'=>'required|email',
                    'codigo_telefono'=>'required',
                    'telefono'=>'required|numeric',
                ];
            }
            case 'EDIT':
            {
                return [
                    'nombre'=>'required',
                    'apellido'=>'required',
                    'email'=>'required|email',
                    'codigo_telefono'=>'required',
                    'telefono'=>'required|numeric',
                ];
            }
            case 'PASSWORD':
            {
                return [
                    'old_password'=>'required',
                    'password'=>'required|alpha_num',
                    'confirm_password'=>'required|alpha_num|same:password',
                ];
            }
            case 'CONTROLAGREGAR':
            {
                return [
                    'rut'=>'required',
                    'nombre'=>'required',
                    'apellido'=>'required',
                    'id_estado'=>'required',
                    'id_ciudad'=>'required',
                    'calle'=>'required',
                    'numero_departamento'=>'required',
                    'email'=>'required|email',
                    'codigo_telefono'=>'required',
                    'telefono'=>'required|numeric',
                    'nivel'=>'required'
                ];
            }
            case 'CONTROLEXISTE':
            {
                return [
                    'nivel'=>'required'
                ];
            }
            case 'CONTROLEDITAR':
            {
                return [
                    'id_estado'=>'required',
                    'id_ciudad'=>'required',
                    'calle'=>'required',
                    'numero_departamento'=>'required',
                    'email'=>'required|email',
                    'codigo_telefono'=>'required',
                    'telefono'=>'required|numeric',
                    'nivel'=>'required'
                ];
            }
            case 'CONTROLAGREGARPROSPECTO':
            {
                return [
                    'rut'=>'required',
                    'nombre'=>'required',
                    'apellido'=>'required',
                    'id_estado'=>'required',
                    'id_ciudad'=>'required',
                    'calle'=>'required',
                    'numero_departamento'=>'required',
                    'email'=>'required|email',
                    'codigo_telefono'=>'required',
                    'telefono'=>'required|numeric',
                ];
            }
            case 'CONTROLEDITARPROSPECTO':
            {
                return [
                    'id_estado'=>'required',
                    'id_ciudad'=>'required',
                    'calle'=>'required',
                    'numero_departamento'=>'required',
                    'email'=>'required|email',
                    'codigo_telefono'=>'required',
                    'telefono'=>'required|numeric',
                ];
            }
            case 'DATOSFACTURACION':
            {
                return [
                    'email'=>'required|email',
                    'codigo_telefono'=>'required',
                    'telefono'=>'required|numeric',
                    'calle'=>'required',
                    'numero_departamento'=>'required',
                    'id_estado'=>'required',
                    'id_ciudad'=>'required',
                    'tipo_boleta'=>'required',
                ];
            }
            case 'DATOSFACTURACION':
            {
                return [
                    'email'=>'required|email',
                    'telefono'=>'required|numeric',
                    'calle'=>'required',
                    'numero_departamento'=>'required',
                    'id_estado'=>'required',
                    'id_ciudad'=>'required',
                ];
            }
        }
    }
    //-----------------------------------ATRIBUTOS Y REGLAS VALIDACION--------------------------------//


    //-------------------------------------------RELACIONES-------------------------------------------//

    public function pais(){
        return $this->hasOne('App\Pais','id','id_pais');
    }

    public function cliente_info(){
        return $this->belongsTo('App\Inmueblecliente','id_cliente','id');
    }

    public function inmueble_usuario(){
        return $this->belongsTo('App\Inmueble','id_cliente','id');
    }

    //-------------------------------------------RELACIONES-------------------------------------------//
    //


    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }

}
