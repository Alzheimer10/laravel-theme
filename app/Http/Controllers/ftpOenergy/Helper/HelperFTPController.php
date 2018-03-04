<?php

namespace App\Http\Controllers\ftpOenergy\Helper;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
// use App\ftpOenergy;
use App\Http\Controllers\ftpOenergy\modelo\ftpOenergy;
// use Illuminate\Support\Facades\DB;

trait HelperFTPController
{
    protected $SERVER;
    protected $HOST;
    protected $PORT;
    protected $USER;
    protected $PASSWORD;
    protected $PASV = true;
    protected $TYPE = 'ftp';
    // ftp://AMSOLAR:Am50l@r@casilla.unired.cl/Nominas/

    public function __construct(){
        $config = config('ftp_oenergy.connection.'.$this->TYPE);
        $this->HOST        = $config['host'];
        $this->PORT        = $config['port'];
        $this->USER        = $config['username'];
        $this->PASSWORD    = $config['password'];
        $this->connect();
    }

    /**
     * Abre la conexion ftp
     */
    private function connect(){
        $ftp=ftp_connect($this->HOST,$this->PORT);//Obtiene un manejador del Servidor FTP
        ftp_login($ftp,$this->USER,$this->PASSWORD); //Se loguea al Servidor FTP
        $this->SERVER = $ftp;
    }

    /**
     * Retorna el listado del directorio
    * @param $directorio
     */
    private function dir_list($directorio){
        $list = ftp_nlist($this->SERVER,$directorio); 
        return $list; 
    }

    /**
     * Abir un archivo.
    * @param $name nombre del archivo a abrir.
     */
    private function open_file($name){
        ini_set('max_execution_time', 300);
        $file = "ftp://$this->USER:$this->PASSWORD@casilla.unired.cl".$name;
        $file = fopen ($file, "r");
        // fclose($file);
        return $file;
    }

    /**
     * Leer un archivo linea por linea.
    * @param $file archivo a leer.
     */
    private function read_csv($file){
        while (($linea = fgetcsv($file, 1000, ",")) !== FALSE){
            if(count($linea) == 6 ){
                // DB::insert('insert into rendicion (value1, value2, value3, value4, value5, value6) values (?, ?, ?, ?, ?, ?)', $linea);
                return DB::table('pagos')->where('numero_boleta', $linea[2])->update($this->array_column($linea));
            }
        }
        fclose($file);
    }


    /**
     * Leer un archivo linea por linea.
    * @param $file archivo a leer.
     */
    private function read_csv_view($file){
        while (($linea = fgetcsv($file, 1000, ",")) !== FALSE){
            if(count($linea) == 6 )
                echo "<p style='margin: 0px'>".$linea[0].",".$linea[1].",".$linea[2].",".$linea[3].",".$linea[4].",".$linea[5]."</p>";
        }
        fclose($file);
        // ftp_connect($this->SERVER);
        $this->connect();
    }

    private function download_files($ftp,$remote_list){
        foreach ($remote_list as $file) {
            if($file != '.' && $file != '..' && $file != '.htaccess'){
                ftp_get($ftp, $this->dir_local_download.$file, $this->dir_remoto.$file, $this->PASV, 0);
                $this->read_file($this->dir_local_download.$file);
                ftp_delete($ftp,  $this->dir_remoto.$file);
            }
        }
    }

    private function array_column($arrayCSV){
        $aux = explode("-",preg_replace('[\s+]',"",$arrayCSV[4]));
        return array(
            'fecha_pago'=> $arrayCSV[3],
            'tipo_pago'=> $this->tipo_pago($arrayCSV[5]),
            'cod_sucursal'=> trim($aux[0]," "),
            'modo_pago'=> $this->modo_pago($aux[1])
        );
    }

    private function tipo_pago($type){
        $tipo_pago = array('debito' => 1, 'credito' => 2 );
        return $tipo_pago[trim(strtolower($type), " ")];
    }
    
    private function modo_pago($type){
        $modo_pago = array('presencial' => 1, 'unired' => 2, 'sucursal' => 3);
        return $modo_pago[trim(strtolower($type), " ")];
    }


    public function updateFile($file,$dirUp){
        $this->connect();
       //obtenemos el nombre del archivo
        $nameFile = $file->getClientOriginalName();
        ftp_put( $this->SERVER , "/Nominas/".$nameFile , $file , FTP_BINARY);
    }

}