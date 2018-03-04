<?php

namespace App\Http\Controllers;
use App\Http\Requests\createParametrosMedidoresRequest;
use App\Http\Requests\updateParametrosMedidoresRequest;
use App\Repositories\parametros_medidoresRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use Eloquent;
use DB;
use Flash;
use App\Models\parametros_medidores;

class parametrosMedidoresControllers extends Controller
{

    protected $connection = 'ohm_v2_test'; 
    protected $table = 'parametros_medidores';
    protected $primaryKey = 'id_bd';
	public $incrementing = TRUE;

    /**
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $data = DB::connection($this->connection)
                    ->table($this->table)
                    ->get()->toArray();

        $columns = DB::connection($this->connection)->select("SELECT column_name FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = 'parametros_medidores'");

		return View('parametros_medidores.index')->with('data', $data)->with('columns',$columns);
    }

    /**
     *
     * @return Response
     */
    public function create()
    {
        $consumidores = DB::connection($this->connection)
                    ->table($this->table)
                    ->select('codigo_consumidor','nombre_cliente')
                    ->where('codigo_consumidor', '!=', 'null')
                    ->get()->toArray();
        $array_aux = array();
        $array_consumidor = array();
        foreach ($consumidores  as $key => $value) {
            if(!array_key_exists($value->codigo_consumidor,$array_aux)){
                $array_aux[$value->codigo_consumidor] = $value->nombre_cliente;

                $array_consumidor = array_merge($array_consumidor,array($value->codigo_consumidor => DB::connection($this->connection)
                            ->table($this->table)
                            ->select('codigo_consumidor','nombre_cliente')
                            ->where('codigo_consumidor', '=', $value->codigo_consumidor)
                            ->first()));
            }
        }
        return view('parametros_medidores.create')->with('codigo_consumidores',$array_consumidor);
    }

    /**
     *
     * @param createParametrosMedidoresRequest $request
     *
     * @return Response
     */
    public function store(createParametrosMedidoresRequest $request)
    {
        $input = $request->all();
		$medidor = new parametros_medidores($input);
        $medidor->flag = '0';
		$medidor->save();

        Flash::success('Nuevo parametros de medidores creada.');

        return redirect(route('parametros_medidores.index'));
        
    }

    /**
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
    	$medidor = parametros_medidores::findOrFail($id);
        if (empty($medidor)) {
            Flash::error('Medidor no encontrado');
            return redirect(route('parametros_medidores.index'));
        }		
		$medidor->delete();
        Flash::success('Registro eliminado.');
    	return redirect(route('parametros_medidores.index'));
    }

    /**
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
    	$medidor = parametros_medidores::find($id);
        if (empty($medidor)) {
            Flash::error('Medidor no encontrado');
            return redirect(route('parametros_medidores.index'));
        }
        return view('parametros_medidores.show')->with('medidor', $medidor);
    }

    /**
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
    	$medidor = parametros_medidores::find($id);
        if (empty($medidor)) {
            Flash::error('Medidor no encontrado');
            return redirect(route('parametros_medidores.index'));
        }
        return view('parametros_medidores.edit')->with('medidor', $medidor);
    }

    /**
     * @param  int              $id
     * @param UpdateParametrosMedidoresRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateParametrosMedidoresRequest $request)
    {
    	$medidor = parametros_medidores::findOrFail($id);
        if (empty($medidor)) {
            Flash::error('Medidor no encontrado');
            return redirect(route('parametros_medidores.index'));
        }
        $medidor->update($request->all());
        $medidor->flag = '1';
		$medidor->save();
        Flash::success('Registro actualizado.');
        return redirect(route('parametros_medidores.index'));
    }


    /**
     *
     * @return Response
     */
    public function eliminar(Request $request)
    {	
    	if (empty($request->all()['ids'])) {
        	Flash::error('Seleccione uno o mas registros.');
    		return redirect(route('parametros_medidores.index'));
    	}
    	foreach ($request->all()['ids'] as $id) {
	    	$medidor = parametros_medidores::findOrFail($id);
	        if (!empty($medidor)) {
				$medidor->delete();
	        }
    	}
        Flash::success('Parametros de medidores eliminado.');
    	return redirect(route('parametros_medidores.index'));
    }

    /**
     *
     * @return Response
     */
    public function cliente(Request $request)
    {	
        $parametos = array('codigo_consumidor','id_canal485','id_ohm' ,'nombre_cliente');
        $consumidor = parametros_medidores::where('codigo_consumidor',$request->id)->select($parametos)->first();
    	return $consumidor;
    }
}
