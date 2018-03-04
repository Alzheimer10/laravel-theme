<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Response;
use Eloquent;
use DB;
use Config;
use Flash;
class tablaController extends Controller
{

    /**
     *
     * @param $tabla
     * @param $connection 
     * @return Response
     */
    public function index($connection,$tabla)
    {  
        if (Config::get('database.connections.'.$connection)==null) {
            Flash::error('Base de datos no existe!');
            return View('tablas.index')->with('error','Base de datos no existe!')->with('name_tabla','');
        }
        $issetTabla = DB::connection($connection)->select("SELECT tablename FROM pg_tables WHERE schemaname = 'public' AND tablename= '".$tabla."'");
        if (empty($issetTabla)) {
            Flash::error('Tabla no encontrado');
            return View('tablas.index')->with('error','Tabla no existe!')->with('name_tabla',$tabla);
        }
        $query = "SELECT column_name FROM information_schema.columns WHERE table_name = '".$tabla."'";
        $colums = DB::connection($connection)->select($query);
        $rows = DB::connection($connection)
                    ->table($tabla)->paginate(50);
		return View('tablas.index')->with('rows',$rows)->with('colums',$colums)->with('name_tabla',$tabla);
    }
}
