<?php
/*
Es una pequeña clase de configuración con un funcionamiento muy sencillo,
implementa el patron singleton para mantener una única instancia y poder acceder
a sus valores desde cualquier sitio.
 */
class Consecutivos
{
    protected $db;
	
	var $consecutivo = '';

    public function __construct() {
        $this->db = SPDO::singleton();
    }

    public function consulta($query) {
        $consulta = $this->db->prepare($query);
        $consulta->execute();
        return $consulta->fetchAll();
    }

	public function obtenerConsecutivo($codigo){

		$valActual = $this->siguienteConsecutivo($codigo);
		$this->cambiarConsecutivo($codigo, $valActual);		
		return $valActual;
	}			


	public function actualConsecutivo($codigo){
 		$sql = "select CODIGO, NOMBRE, VALOR_ACTUAL, INCREMENTO, VALOR_INICIAL, VALOR_FINAL, RELLENO, CARACTER from tb_consecutivos where CODIGO = '".$codigo."' ";
        $cons = $this->consulta($sql);
		
		$consecutivo = $cons[0];
		
		$this->consecutivo = intval( $consecutivo['VALOR_ACTUAL'] );

		if( isset($consecutivo['RELLENO']) ){
			$this->consecutivo = str_pad( $valActual, intval($consecutivo['RELLENO']), strval($consecutivo['CARACTER']), STR_PAD_LEFT );
		}			
		return $this->consecutivo;
	}



	public function siguienteConsecutivo($codigo){
 		
		$sql = "select CODIGO, NOMBRE, VALOR_ACTUAL, INCREMENTO, VALOR_INICIAL, VALOR_FINAL, RELLENO, CARACTER from tb_consecutivos where CODIGO = '".$codigo."' ";
        $cons = $this->consulta($sql);
		
		$consecutivo = $cons[0];
		
		$valAct = intval( $consecutivo['VALOR_ACTUAL'] );
		$inc = intval( $consecutivo['INCREMENTO'] );		
		$valAct += $inc;
		if( $valAct > intval( $consecutivo['VALOR_FINAL'] ) ){
			return 0;
		}
		
		if( isset($consecutivo['RELLENO']) ){
			$this->consecutivo = str_pad( $valAct, intval($consecutivo['RELLENO']), strval($consecutivo['CARACTER']), STR_PAD_LEFT );
		}			
		return $this->consecutivo;
	}


	public function cambiarConsecutivo($codigo, $valActual){
		$actCons = "update tb_consecutivos set VALOR_ACTUAL= ".intval( $valActual )."  
			where CODIGO = '".$codigo."' ";
		return $this->consulta($actCons);		
	}





}
?>