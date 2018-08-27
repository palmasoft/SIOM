<?php

     class ListaChequeo
     { // BEGIN class ListaChequeo
     	// variables
     	var $idOpciones;
      var $nombreLista;
      
      	private $selecionado = 'checked="checked"';
	
      	private $html_checkbox = '<input type="checkbox" id="%s_%s" name="%s_%s" value="%s" onclick="%s" onchange="%s" style="%s" %s />';	

      
     	// constructor
     	function ListaChequeo($idOpciones, $nombreLista)     	
     	{ // BEGIN constructor
     	
     	  $this->idOpciones = $idOpciones;
     	  $this->nombreLista = $nombreLista;
     		
     	} // END constructor
     	
     	public function crear_lista_multiple(
       $textoOpciones = array(), $valorOpciones = array(), $valorSeleccionados = array(),  
       $onclick = '', $onchange = '', $estilo = '', $ubicaTexto = 'D' )
     	{
       
        $html = '';   
        
        for($i = 0; $i < count($textoOpciones); $i++){
        
          $check = array_key_exists($valorOpciones[$i], $valorSeleccionados) ? $this->selecionado : ''; 
        
          if( $ubicaTexto == 'D' ){                                                                                   
            $html .= '<label>';
            $html .= sprintf( $this->$html_checkbox, 
                       $this->idOpciones, $i, $this->nombreLista, '', $valorOpciones[$i], $onclick, $onchange, $estilo, $check); 
            $html .= $valorOpciones[$i].'<label>';
                                               
          }
        }  
        
        return $html;
       
      }
     	
     	
     	
     } // END class ListaChequeo


?>
