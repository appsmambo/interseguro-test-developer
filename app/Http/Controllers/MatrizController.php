<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MatrizController extends Controller
{
    public function postRotar(Request $request)
    {
        $arr_entrada = $request->input('matriz', null);
        $mensaje = $this->validarMatriz($arr_entrada);
        if ($mensaje === '') {
            $arr_salida = array();
            $filas = count($arr_entrada);
            $y = $filas - 1;
            for ($i = 0; $i < $filas; $i++) {
                for ($x = 0; $x < $filas; $x++) {
                    $arr_salida[$i][$x] = $arr_entrada[$x][$y];
                }
                $y--;
            }
            $this->imprimirMatriz($arr_entrada);
            $this->imprimirMatriz($arr_salida);
            $mensaje = array(
                'input' => $arr_entrada,
                'output' => $arr_salida,
            );
        }
        return response()->json($mensaje);
    }

    private function validarMatriz($matriz)
    {
        $filas = count($matriz);
        if (!$matriz || !is_array($matriz)) {
            return 'Debes ingresar una matriz válida.';
        }
        if (is_array($matriz) && $filas === 0) {
            return 'La matriz debe contener elementos y ser cuadrática.';
        }
        if (is_array($matriz) && !$this->esCuadratica($matriz)) {
            return 'La matriz debe ser cuadrática.';
        }
        $y = $filas - 1;
        for ($i = 0; $i < $filas; $i++) {
            for ($x = 0; $x < $filas; $x++) {
                if (gettype($matriz[$x][$y]) != 'integer') return 'La matriz debe contener números enteros.';
            }
            $y--;
        }
        return '';
    }

    private function esCuadratica($matriz)
    {
        $filas = count($matriz);
        foreach ($matriz as $fila) {
            if ($filas <> count($fila)) {
                return false;
            }
        }
        return true;
    }

    private function imprimirMatriz($matriz)
    {
        foreach ($matriz as $fila) {
            foreach ($fila as $valor) {
                echo  $valor . ' ';
            }
            echo "\n";
        }
        echo "\n";
    }

}
