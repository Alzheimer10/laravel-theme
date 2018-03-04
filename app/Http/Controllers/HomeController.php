<?php

namespace App\Http\Controllers;
use Config;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    protected $connection = 'ohm_v2_test'; 
    protected $table = 'parametros_medidores';
    protected $primaryKey = 'id_bd';
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        if(Config::get('app.login'))
            $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $columns =   DB::connection($this->connection)
                    ->table($this->table)
                    ->get()->toArray();
        return View('home')->with('columns',$columns);
    }
}

