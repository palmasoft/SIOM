<?php

/**
 * @author 
 * @copyright 2010
 */

class ListaDesplegable {
	
	var $textoDefecto = '[SELECCIONE UNO]';
	var $valorDefecto = '';
	
	private $selecionado = 'selected="selected"';
	
	private $html_abre_lista_desplegable			= '<select id="%s" name="%s" onchange="%s" onclick="%s" style="%s" class="%s" >';	
	private $html_abre_multiple_lista_desplegable 	= '<select id="%s" name="%s" onchange="%s" onclick="%s" style="%s" class="%s" multiple="multiple" >';
	
	private $html_abre_lista_seleccion			= '<select id="%s" name="%s" onchange="%s" onclick="%s" style="%s" class="psl_lista_unica %s" multiple="multiple" >';	
	private $html_abre_multiple_lista_seleccion 	= '<select id="%s" name="%s" onchange="%s" onclick="%s" style="%s" class="psl_lista_multiple %s" multiple="multiple" >';
	private $html_cierre_lista_desplegable 			= '</select>';
	private $html_option_lista_desplegable 			= '<option value="%s" %s >%s</option>';

	
	
	private function opcion_lista_desplegable($texto, $valor, $sel){
		if( $sel == $valor ) {
			return sprintf($this->html_option_lista_desplegable, $valor, $this->selecionado, ( $texto) );
		}else{ 
			return sprintf($this->html_option_lista_desplegable, $valor, '', ( $texto ) );
		}	
		return '';
	}
	
	public function crear(
		$datos = null, $campoTexto, $campoValor, $id_lista, $option = '', 
		$onclick = '', $onchange = '', $clases  = '',  $estilo = '', 
		$multiple = false, $textoDefecto){
		
        $this->textoDefecto = $textoDefecto;
        if( $datos == 0 ) $datos = array();
		
        $abre = '';
		if( !$multiple ){
			$abre = sprintf($this->html_abre_lista_desplegable, $id_lista, $id_lista, $onchange, $onclick, $estilo, $clases);
		}else{
			$abre = sprintf($this->html_abre_multiple_lista_desplegable, $id_lista, $id_lista, $onchange, $onclick, $estilo, $clases);
		}		
		
		
		$opciones = $this->opcion_lista_desplegable( $this->textoDefecto, $this->valorDefecto,  $option);
		foreach ( $datos as $nCampo ) {
		  
            if( is_array($campoTexto) ){
                $txtTmp = '';
                $i=0;
                foreach($campoTexto as $txtCampo ){
                    if($i==0){
                        $txtTmp .= ($nCampo->$txtCampo);       
                     }else{
                        $txtTmp .= " - ".($nCampo->$txtCampo);
                     }             
                     $i++;
                }
                $opciones .= $this->opcion_lista_desplegable( strtoupper( trim($txtTmp) ),  $nCampo->$campoValor, $option);
            }else{
            	$textoHtml = ( $nCampo->$campoTexto );
                $opciones .= $this->opcion_lista_desplegable( strtoupper( trim($textoHtml) ),  $nCampo->$campoValor, $option);
            }
          
			
    	} 
		
		return (
			$abre.$opciones.$this->html_cierre_lista_desplegable
		);
	}
    
    
    public function crear_seleccion($datos, $campoTexto, $campoValor, $id_lista, $option = '', $onclick = '', $onchange = '', $clases = '',  $estilo = '', $multiple = false, $textoDefecto){
		
        $this->textoDefecto = $textoDefecto;
		
        $abre = '';
		if( !$multiple ){
			$abre = sprintf($this->html_abre_lista_seleccion, $id_lista, $id_lista, $onchange, $onclick, $clases, $estilo);
		}else{
			$abre = sprintf($this->html_abre_multiple_lista_seleccion, $id_lista, $id_lista, $onchange, $onclick, $clases, $estilo);
		}		
		
		if( $textoDefecto != '' )
		  $opciones = $this->opcion_lista_desplegable( $this->textoDefecto, $this->valorDefecto,  $option);
		foreach ( $datos as $nCampo ) {
		  
            if( is_array($campoTexto) ){
                $txtTmp = '';
                $i=0;
                foreach($campoTexto as $txtCampo ){
                    if($i==0){
                        $txtTmp .= $nCampo->$txtCampo;       
                     }else{
                        $txtTmp .= "-".$nCampo->$txtCampo;
                     }             
                     $i++;
                }
                $opciones .= $this->opcion_lista_desplegable( ( $txtTmp ),  $nCampo->$campoValor, $option);
            }else{
                $opciones .= $this->opcion_lista_desplegable( 
                	$nCampo->$campoTexto,  
                	$nCampo->$campoValor, 
                	$option
                );
            }
          
			
    	} 
		
		return (
			$abre.$opciones.$this->html_cierre_lista_desplegable
		);
	}    
    
    
    
}
?>