<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers;
use App\Http\Models\Cliente;
use App\Http\Requests;

class ClienteController extends Controller {

    public function relatorio(Request $request) {
        $cliente_data1 = $request->input('cliente_data1');
        $cliente_data2 = $request->input('cliente_data2');
        $cliente = $request->input('cliente');

        $codigo_cliente = "";
        $codigo_cliente_anterior = "";
        $data_anterior = 0;
        $cont = 1;
        $receita_liquida_anterior = 0;
        $receita_liquida_total = 0;
        $total_receita = 0;
        $relatorio = [];

        if (!empty($cliente)) {
            foreach($cliente as $row) {
              $codigo_cliente .= $row . ', ';
            }
            $codigo_cliente = substr($codigo_cliente, 0, -2);

            $cliente = new Cliente();
  		      $result = $cliente->consultaDados($codigo_cliente, $cliente_data1, $cliente_data2);

            if (!empty($result)) {
                foreach ($result as $key => $value) {
                    if ($codigo_cliente_anterior == "")
                        $codigo_cliente_anterior = $value->NO_FANTASIA;

                    if($value->NO_FANTASIA == $codigo_cliente_anterior and $value->DATA_EMISSAO == $data_anterior) {
                        $receita_liquida_total = $value->RECEITA_LIQUIDA + $receita_liquida_anterior;
                    } else {
                        $receita_liquida_total = $value->RECEITA_LIQUIDA;
                    }

                    if($data_anterior != 0 and ($value->DATA_EMISSAO != $data_anterior or $cont == count($result))) {
                        if(!empty($receita_liquida_anterior)) {
                            $relatorio[$codigo_cliente_anterior][] = array(
                                            "Período" => $data_anterior,
                                            "Receita Líquida" => "R$ ".number_format($receita_liquida_anterior, 2)
                                          );

                            $total_receita += $receita_liquida_anterior;
                        }
                    }

                    if ($value->NO_FANTASIA != $codigo_cliente_anterior or $cont == count($result)) {
                        if(!empty($total_receita)) {
                            $relatorio[$codigo_cliente_anterior]["total"] = array(
                                            "TOTAL",
                                            "R$ ".number_format($total_receita, 2)
                                          );

                            $total_receita = 0;
                            $receita_liquida_anterior = 0;
                        }
                    }

                    $codigo_cliente_anterior = $value->NO_FANTASIA;
                    $data_anterior = $value->DATA_EMISSAO;
                    $receita_liquida_anterior = $receita_liquida_total;
                    $cont++;
                }
            }
        }

        return view("cliente/relatorio", ["relatorio_cliente" => $relatorio]);
    }

    public function grafico(Request $request) {
        $cliente_data1 = $request->input('cliente_data1');
        $cliente_data2 = $request->input('cliente_data2');
        $cliente = $request->input('cliente');

        $codigo_cliente = "";
        $data_anterior = 0;
        $codigo_cliente_anterior = "";
        $cont = 1;
        $nomes = [];
        $receita_liquida_anterior = 0;
        $receita_liquida_total = 0;
        $total_receita_cliente = 0;
        $total_receita = 0;
        $desemp = [];
        $desemp_porcentual = [];

        if (!empty($cliente)) {
            foreach($cliente as $row) {
              $codigo_cliente .= $row . ', ';
            }
            $codigo_cliente = substr($codigo_cliente, 0, -2);

  		      $cliente = new Cliente();
            $result = $cliente->consultaDados($codigo_cliente, $cliente_data1, $cliente_data2);

            if (!empty($result)) {
              foreach ($result as $key => $value) {
                  if ($codigo_cliente_anterior == "")
                      $codigo_cliente_anterior = $value->NO_FANTASIA;

                  if($value->NO_FANTASIA == $codigo_cliente_anterior and $value->DATA_EMISSAO == $data_anterior) {
                      $receita_liquida_total = $value->RECEITA_LIQUIDA + $receita_liquida_anterior;
                  } else {
                      $receita_liquida_total = $value->RECEITA_LIQUIDA;
                  }

                  if($data_anterior != 0 and ($value->DATA_EMISSAO != $data_anterior or $cont == count($result))) {
                      $total_receita_cliente += $receita_liquida_anterior;
                  }

                  if ($value->NO_FANTASIA != $codigo_cliente_anterior or $cont == count($result)) {
                      $desemp[substr($codigo_cliente_anterior, 0, 22)] = (int) $total_receita_cliente;

                      $total_receita += $total_receita_cliente;

                      $total_receita_cliente = 0;
                      $receita_liquida_anterior = 0;
                  }

                  $codigo_cliente_anterior = $value->NO_FANTASIA;
                  $data_anterior = $value->DATA_EMISSAO;
                  $receita_liquida_anterior = $receita_liquida_total;
                  $cont++;
                }

                foreach($desemp as $key => $value) {
                    if(!empty($value)) {
                        $porcentual = $this->porcentagem_receita($value, $total_receita);
                        $desemp_porcentual[$key] = (int) $porcentual;
                    }
                }
            }
        }

        return ["desemp" => $desemp, "desemp_porcentual" => $desemp_porcentual];
    }

    public function grafico_linha(Request $request) {
        $grafico = $this->grafico($request);

        return view("cliente/grafico_linha", ["desemp" => $grafico["desemp"]]);
    }

    public function grafico_pizza(Request $request) {
        $grafico = $this->grafico($request);

        return view("cliente/grafico_pizza", ["desemp_porcentual" => $grafico["desemp_porcentual"]]);
    }

    public function porcentagem_receita($parcial, $total) {
        return ($parcial/$total)*100;
    }

}
