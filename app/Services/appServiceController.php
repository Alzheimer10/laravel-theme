<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Config;
use DB;

class appServiceController 
{
    public function basesdatos(){

        $dbs=Config::get('database.connections');
        foreach ($dbs as $db) {
            if($db['driver']=='pgsql'){
                $query = "SELECT tablename FROM pg_tables WHERE schemaname = 'public'";
                $tablasOhm_v2 = DB::connection($db['database'])->select($query);
                $tablas = array();
                foreach ($tablasOhm_v2 as $tabla) {
                    $query = "SELECT column_name FROM information_schema.columns WHERE table_name = '".$tabla->tablename."'";
                    $colums = DB::connection($db['database'])->select($query);
                    $tablas = array_add($tablas, $tabla->tablename, $colums);
                }
                $basesdatos[$db['database']]=$tablas;
            }
        }
        return $basesdatos;
    }
}
