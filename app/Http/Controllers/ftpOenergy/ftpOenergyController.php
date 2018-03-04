<?php

namespace App\Http\Controllers\ftpOenergy;

use phpseclib;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use File;
use Illuminate\Support\Facades\Log;
//Helper-FTP
use App\Http\Controllers\ftpOenergy\Helper\HelperFTPController;

class ftpOenergyController extends Controller
{
    use HelperFTPController;

    protected $fopen;
    protected $rendiciones =    "/Rendiciones";
    protected $nominas =    "/Nominas";
    protected $rendiciones_local = "../App/Http/Controllers/ftpOenergy/ftp.ini";

    public function index(){
        // $stream = fopen("ssh2.sftp://$sftp/path/to/file", 'r');
        return view('ftpOenergy.index')
            ->with('rendiciones',$this->dir_list($this->rendiciones))
            ->with('nominas',$this->dir_list($this->nominas));
    }

    /*
    *Mostrar el archivo remoto en una vista.
    *@param $dir    directorio remoto.
    *@param $name nombre del archivo
    */
    public function open_file_view($dir,$name){
        $this->read_csv_view( $this->open_file('/'.$dir.'/'.$name) ); //(helperFTP)
    }

    /*
    * Obtiene todas las rendiciones ya procesadas.
    */
    public function getRendicionLocal(){

        $this->fopen = fopen($this->rendiciones_local, "r");
        $arrayFile = array();
        if(filesize($this->rendiciones_local) > 0){
            return explode("\n",fread($this->fopen,filesize($this->rendiciones_local)));
        }
        return $this->fopen;
    }

    /*
    * Funcion para escribir un documento. 
    * @param $linea es el nombre del archivo a escribir en las rendiciones_local.
    */
    public function read_file_local($linea){
        fwrite( $this->fopen, $linea."\n");
    }

    /*
    * Compara los array y devuelve un array.
    * @param $array1 
    * @param $array2
    */
    public function comparation($array1,$array2){
        return array_diff($array1,$array2);
    }


    /**
     * Comand rendicionesUn
     *
     * @return void
     */
    static function rendicionesUnired(){
        $ftpOenergy = new ftpOenergyController;
        $ftpOenergy->Rendiciones();
    }

    public function rendiciones(){
        $listFile = $this->comparation( $this->dir_list($this->rendiciones) , $this->getRendicionLocal() );
        if( count($listFile) > 0 )
            return $this->procesarListFile($listFile);
        else
            return 0;
    }

    /*
    *  Leera los csv que esten en el remote y los procesa.
    *  @param $listFile array de todo los csv que estan en el remote.
    */
    public function procesarListFile($listFile){
        $this->fopen = fopen($this->rendiciones_local, "a+");
            // dd($listFile);
        foreach ($listFile as $fileName) {
            // procesar el archivo...
            $this->open_file($fileName); //(helperFTP)Abre el archivo local para escribir el nombre del csv leido del ftp
            if ( $this->read_csv($this->open_file($fileName)) == 0 ) { //(helperFTP)
                //Codigo....
            }
            fwrite( $this->fopen, $fileName."\n"); //Escribe en el arcvhivo local.
        }
        fclose( $this->fopen );
        return 1;
    }

    public function dropzone(Request $request)
    {
        return  $this->updateFile($request->file('file'), $this->nominas );
    }
}