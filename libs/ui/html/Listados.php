<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Listados
 *
 * @author Puro Ingenio Samario
 */
class Listados {

    public static function lista_periodos($name, $clase = "", $pSeleccionado = null) {

        $periodos = array();
        $periodoActivo = $pSeleccionado;
        if (empty($pSeleccionado)) {
            $periodoActivo = PeriodosModel::activo();
        }

        echo '<select id="periodo-' . $name . '"  name="periodo-' . $name . '"     class="select ' . $clase . '" placeholder="PERIODO" required  >';
        if (!SubreceptoresModel::tiene_restricciones() or Usuario::esGestor()) {
            $periodos = PeriodosModel::todos_menores_incluido_periodo(PeriodosModel::actual()->ID_PERIODO);
        } else {
            if (Usuario::esDNI()) {
                $periodos = PeriodosModel::todos_dentro_trimestre($periodoActivo->TRIM_PERIODO);
            } else {
                array_push($periodos, PeriodosModel::actual());
                array_push($periodos, PeriodosModel::siguiente_actual());
                // echo ' <option value="' . $periodoActivo->CODIGO_PERIODO . '" selected="" >' . $periodoActivo->CODIGO_PERIODO . '</option>';
            }
        }


        foreach ($periodos as $periodo) {
            $selected = " ";
            if ($periodo->ID_PERIODO == $periodoActivo->ID_PERIODO) {
                $selected = ' selected="" ';
            }
            echo ' <option value="' . $periodo->CODIGO_PERIODO . '" ' . $selected . ' >' . $periodo->CODIGO_PERIODO . '</option>';
        }

        echo '</select> ';
    }

    public static function lista_periodos_selecionado($name, $pSeleccionado = null, $clase = "") {

        $periodoActivo = PeriodosModel::activo();
        echo '<select id="periodo-' . $name . '"  name="periodo-' . $name . '"     class="select ' . $clase . '" placeholder="PERIODO" required  >';
        if (!Usuario::tiene_restricciones() or UsuariosModel::esGestor()) {
            $periodos = PeriodosModel::todos_menores_incluido_periodo($periodoActivo->ID_PERIODO);
            foreach ($periodos as $periodo) {
                $selected = " ";
                if ($periodo->ID_PERIODO == $periodoActivo->ID_PERIODO) {
                    $selected = ' selected="" ';
                }
                echo ' <option value="' . $periodo->CODIGO_PERIODO . '" ' . $selected . ' >' . $periodo->CODIGO_PERIODO . '</option>';
            }
        } else {
            echo ' <option value="' . $periodoActivo->CODIGO_PERIODO . '" selected="" >' . $periodoActivo->CODIGO_PERIODO . '</option>';
        }
        echo '</select> ';
    }

    public static function lista_periodos_para_informes($name, $clase = "", $pSeleccionado = null) {

        $periodos = array();
        $periodoActivo = $pSeleccionado;

        if (empty($pSeleccionado) or $pSeleccionado == 'TRIMESTRE') {
            $periodoActivo = PeriodosModel::activo();
        }

        if (!SubreceptoresModel::tiene_restricciones() or Usuario::esGestor()) {
            $periodos = PeriodosModel::todos_menores_incluido_periodo(PeriodosModel::actual()->ID_PERIODO);
        } else {
            if (Usuario::esDNI()) {
                $periodos = PeriodosModel::todos_dentro_trimestre($periodoActivo->TRIM_PERIODO);
                //print_r($periodos);
            } else {
                array_push($periodos, $periodoActivo);
                // echo ' <option value="' . $periodoActivo->CODIGO_PERIODO . '" selected="" >' . $periodoActivo->CODIGO_PERIODO . '</option>';
            }
        }

        echo '<select id="periodo-' . $name . '"  name="periodo-' . $name . '"     class="select ' . $clase . '*" placeholder="PERIODO" required  >';
        if (Usuario::esDNI()) {
            $selected = ' ';
            if ($pSeleccionado == 'TRIMESTRE') {
                $selected = ' selected="" ';
            }
            echo ' <option value="O"  ' . $selected . '  data-min-fecha="' . $periodos[2]->FECHA_MIN_PERIODO . '"
                    data-max-fecha="' . $periodos[0]->FECHA_MAX_PERIODO . '" >Trimestre: ' . $periodos[2]->CODIGO_PERIODO . ' - ' . $periodos[0]->CODIGO_PERIODO . '</option>';
        }
        foreach ($periodos as $periodo) {
            $selected = " ";
            if ($pSeleccionado != 'TRIMESTRE') {
                if ($periodo->ID_PERIODO == $periodoActivo->ID_PERIODO) {
                    $selected = ' selected="" ';
                }
            }
            echo ' <option value="' . $periodo->CODIGO_PERIODO . '" ' . $selected . ' data-min-fecha="' . $periodo->FECHA_MIN_PERIODO . '"
                    data-max-fecha="' . $periodo->FECHA_MAX_PERIODO . '">' . $periodo->CODIGO_PERIODO . ' 
                    </option>';
        }
        echo '</select> ';
    }

    public static function lista_ano($name, $clase = "", $valor = "", $edadMinima = 14, $edadMaxima = 79) {

        $edadMinima = ($edadMinima == 0) ? 14 : $edadMinima;
        $edadMaxima = ($edadMaxima == 0) ? 79 : $edadMaxima - $edadMinima;

        $seleccionado = "";
        echo '<select  id="ano-' . $name . '"  name="ano-' . $name . '" class="selec ' . $clase . '" placeholder="AÑO" style=" width:100% " required ><option value="" >AÑO</option>';
        $anoInicial = intval(date('Y')) - $edadMinima;
        for ($i = 0; $i <= $edadMaxima; $i++) {
            if ($valor != "" && $valor == ( $anoInicial - $i )) {
                $seleccionado = " selected ";
            }
            echo ' <option value="' . ( $anoInicial - $i ) . '" ' . $seleccionado . '>' . ( $anoInicial - $i ) . '</option>';
            $seleccionado = "";
        }
        echo '</select> ';
    }

    public static function lista_ano_contacto($name, $clase = "", $valor = "") {

        $periodoActual = PeriodosModel::activo();
        if ($valor == "") {
            $valor = $periodoActual->ANO_PERIODO;
        }
        echo '<select id="ano-' . $name . '"  name="ano-' . $name . '" class="select ' . $clase . '" placeholder="" required  ><option value="" >A&Ntilde;O</option>';
        if (Usuario::tiene_restricciones()) {
            echo ' <option value="' . $periodoActual->ANO_PERIODO . '" selected="" >' . $periodoActual->ANO_PERIODO . '</option>';
        } else {
            $periodos = PeriodosModel::todos_anos();
            foreach ($periodos as $periodo) {
                $selected = " ";
                if ($periodo->ANO_PERIODO == $valor) {
                    $selected = ' selected="" ';
                }
                echo ' <option value="' . $periodo->ANO_PERIODO . '" ' . $selected . ' >' . $periodo->ANO_PERIODO . '</option>';
            }
        }
        echo '</select> ';
    }

    public static function lista_mes($name, $clase = "", $valor = "") {

        $seleccionado = "";
        echo '<select  id="mes-' . $name . '" name="mes-' . $name . '"   class="select ' . $clase . '" placeholder="MES" style=" width:100% " required ><option value="" >MES</option>';
        for ($i = 1; $i <= 12; $i++) {
            if ($valor != "" && $valor == $i) {
                $seleccionado = " selected ";
            }
            echo ' <option value="' . str_pad($i, 2, '0', STR_PAD_LEFT) . '" ' . $seleccionado . '> ' . str_pad($i, 2, '0', STR_PAD_LEFT) . '</option>';
            $seleccionado = "";
        }
        echo '</select> ';
    }

    public static function lista_mes_contacto($name, $clase = "", $valor = "") {

        $periodoActual = PeriodosModel::activo();
        if ($valor == "") {
            $valor = $periodoActual->MES_PERIODO;
        }

        echo '<select id="mes-' . $name . '"  name="mes-' . $name . '"   class="select ' . $clase . '" placeholder="MES" required  ><option  value="" >MES</option>';
        if (Usuario::tiene_restricciones()) {
            echo ' <option value="' . $periodoActual->MES_PERIODO . '" selected="" >' . $periodoActual->MES_PERIODO . '</option>';
        } else {
            $periodos = PeriodosModel::todos_meses();
            foreach ($periodos as $periodo) {
                $selected = " ";
                if ($periodo->MES_PERIODO == $valor) {
                    $selected = ' selected="" ';
                }
                echo ' <option value="' . $periodo->MES_PERIODO . '" ' . $selected . ' >' . $periodo->MES_PERIODO . '</option>';
            }
        }
        echo '</select> ';
    }

    /* muestra una lista de meses hasta el mes actual */

    public static function lista_mes_actual($name, $clase = "", $valor = "") {

        $seleccionado = "";
        echo '<select id="mes-' . $name . '" name="mes-' . $name . '"   class="select ' . $clase . '" placeholder="MES" style=" width:100% " ><option value="" >MES</option>';
        $mesActual = intval(date('n'));
        for ($i = 1; $i <= $mesActual; $i++) {
            if ($valor != "" && $valor == $i)
                $seleccionado = " selected ";
            echo ' <option value="' . str_pad($i, 2, '0', STR_PAD_LEFT) . '" ' . $seleccionado . '> ' . str_pad($i, 2, '0', STR_PAD_LEFT) . '</option>';
            $seleccionado = "";
        }
        echo '</select> ';
    }

    public static function lista_dia($name, $clase = "", $valor = "") {

        echo '<select id="dia-' . $name . '" name="dia-' . $name . '"   class="select ' . $clase . '" placeholder="DIA" required ><option  value="" >DIA</option>';
        for ($i = 1; $i <= 31; $i++) {
            $seleccionado = "";
            if ($valor != "" && $valor == $i)
                $seleccionado = " selected ";
            echo ' <option value="' . str_pad($i, 2, '0', STR_PAD_LEFT) . '" ' . $seleccionado . '>' . str_pad($i, 2, '0', STR_PAD_LEFT) . '</option>';
        }
        echo '</select> ';
    }

    public static function Lista_Desplegable_Estados($id_lista, $option = '', $onclick = '', $onchange = '', $estilo = '', $multiple = false, $textoDefecto = '[SELECCIONE UNO]', $name = '') {
        $Lista = new ListaDesplegable();

        $datos = array(
            array('valor' => 1, 'texto' => 'ACTIVO'),
            array('valor' => 2, 'texto' => 'INACTIVO')
        );

        return $Lista->crear(
                        $datos, 'texto', 'valor', $id_lista, $option, $onclick, $onchange, $estilo, $multiple, $textoDefecto, $name
        );
    }

    public static function Lista_Desplegable_Temporadas($id_lista, $option = '', $onclick = '', $onchange = '', $estilo = '', $multiple = false, $textoDefecto = '[SELECCIONE UNO]', $name = '') {
        $Lista = new ListaDesplegable();

        $datos = array(
            array('valor' => 'ALTA', 'texto' => 'ALTA'),
            array('valor' => 'BAJA', 'texto' => 'BAJA')
        );

        return $Lista->crear(
                        $datos, 'texto', 'valor', $id_lista, $option, $onclick, $onchange, $estilo, $multiple, $textoDefecto, $name
        );
    }

    public static function Lista_Desplegable_TiposTarjetas($id_lista, $option = '', $onclick = '', $onchange = '', $estilo = '', $multiple = false, $textoDefecto = '[SELECCIONE UNO]', $name = '') {
        $Lista = new ListaDesplegable();
        $datos = array(
            array('valor' => 'American Express', 'texto' => 'American Express'),
            array('valor' => 'MasterCard', 'texto' => 'Master Card'),
            array('valor' => 'Visa', 'texto' => 'Visa')
        );
        return $Lista->crear(
                        $datos, 'texto', 'valor', $id_lista, $option, $onclick, $onchange, $estilo, $multiple, $textoDefecto, $name
        );
    }

}
