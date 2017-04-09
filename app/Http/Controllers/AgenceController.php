<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Fatura as Fatura;
use DB;

class AgenceController extends Controller
{	

    public function index(){
    	/*Consulta para mostrar los nombres en el multi select*/
    	$query = ['Consultores' => DB::table('permissao_sistema')
            ->join('cao_usuario', 'permissao_sistema.co_usuario', '=','cao_usuario.co_usuario')
            ->select('cao_usuario.no_usuario','cao_usuario.co_usuario')
            ->where([
                    ['permissao_sistema'.'.co_sistema','=', 1],
                    ['permissao_sistema'.'.in_ativo','=', 'S']
                ])
            ->whereIn('permissao_sistema.co_tipo_usuario',[0,1,2])
            ->orderBy('permissao_sistema.co_usuario','asc')
            ->lists('cao_usuario.no_usuario','cao_usuario.co_usuario')];
 
    	return view('agence.index',['query'=>$query]);
    }

    public function consulta(Request $request){
    	/*Info del Form*/
		$array = $request->select_cons;
		$mesUno = $request->mesUno;
		$mesDos = $request->mesDos;
		$yearUno = $request->yearUno;
		$yearDos = $request->yearDos;

    	if ($request->relatorio == 'relatorio') { /*Relatorio*/
    		
    		if ($mesUno == "" || $mesDos == "" || $yearUno == "" || $yearDos == "") {
		    	return view('agence.consulta',['querys'=>null]);
			}else{

			$query = DB::table('cao_fatura')
				->join('cao_os', 'cao_os.co_os', '=','cao_fatura.co_os')
			    ->join('cao_salario', 'cao_salario.co_usuario', '=','cao_os.co_usuario')
			    ->rightJoin('cao_usuario', 'cao_usuario.co_usuario', '=','cao_os.co_usuario')
			    ->select(DB::raw('
			    	
			    	cao_salario.brut_salario,
			    	cao_usuario.co_usuario,
			    	cao_usuario.no_usuario,
			    	MONTH(data_emissao) AS mes,
			    	YEAR(data_emissao) AS year, 
			    	sum(cao_fatura.valor - ((cao_fatura.valor * cao_fatura.total_imp_inc)) / 100) as liquida,
			    	sum(cao_fatura.valor - ((cao_fatura.valor * cao_fatura.total_imp_inc)) / 100 * (cao_fatura.comissao_cn / 100)) as comision,
			    	(cao_salario.brut_salario+sum(cao_fatura.valor - ((cao_fatura.valor * cao_fatura.total_imp_inc)) / 100 * (cao_fatura.comissao_cn / 100))) - sum(cao_fatura.valor - ((cao_fatura.valor * cao_fatura.total_imp_inc)) / 100) as lucro
			    	'))
				->whereIn('cao_os.co_usuario', $array)
				->whereRaw('EXTRACT(month FROM data_emissao) BETWEEN '.$mesUno.' and '.$mesDos)
			    ->whereRaw('EXTRACT(year FROM data_emissao) BETWEEN '.$yearUno.' and '.$yearDos)
			    ->groupBy('cao_os.co_usuario','mes')
			    ->orderBy('cao_os.co_usuario','asc','mes','desc')
			    ->get();
			
			$query2 = DB::table('cao_fatura')
				->join('cao_os', 'cao_os.co_os', '=','cao_fatura.co_os')
			    ->join('cao_salario', 'cao_salario.co_usuario', '=','cao_os.co_usuario')
			    ->join('cao_usuario', 'cao_usuario.co_usuario', '=','cao_os.co_usuario')
			    ->select(DB::raw('
			    	cao_usuario.co_usuario,
			    	cao_usuario.no_usuario,
			    	MONTH(data_emissao) AS mes'))
				->whereIn('cao_os.co_usuario', $array)
				->whereRaw('EXTRACT(month FROM data_emissao) BETWEEN '.$mesUno.' and '.$mesDos)
			    ->whereRaw('EXTRACT(year FROM data_emissao) BETWEEN '.$yearUno.' and '.$yearDos)
			    ->groupBy('cao_os.co_usuario')
			    ->orderBy('cao_os.co_usuario','asc','mes','desc')
			    ->get();
			}

    		return view('agence.consulta',['querys'=>$query,'querys2'=>$query2]);

    	}elseif($request->grafico == 'grafico'){ /*Grafico*/

    		if ($mesUno == "" || $mesDos == "" || $yearUno == "" || $yearDos == "") {
		    	return view('agence.graph',['querys'=>null]);
			}else{

	    		$query = DB::table('cao_fatura')
					->join('cao_os', 'cao_os.co_os', '=','cao_fatura.co_os')
				    ->join('cao_salario', 'cao_salario.co_usuario', '=','cao_os.co_usuario')
				    ->rightJoin('cao_usuario', 'cao_usuario.co_usuario', '=','cao_os.co_usuario')
				    ->select(DB::raw('
				    	cao_salario.brut_salario,
				    	cao_usuario.co_usuario,
				    	cao_usuario.no_usuario,
				    	MONTH(data_emissao) AS mes,
				    	YEAR(data_emissao) AS year, 
				    	sum(cao_fatura.valor - ((cao_fatura.valor * cao_fatura.total_imp_inc)) / 100) as liquida
				    '))
					->whereIn('cao_os.co_usuario', $array)
					->whereRaw('EXTRACT(month FROM data_emissao) BETWEEN '.$mesUno.' and '.$mesDos)
				    ->whereRaw('EXTRACT(year FROM data_emissao) BETWEEN '.$yearUno.' and '.$yearDos)
				    ->groupBy('cao_os.co_usuario','mes')
				    ->orderBy('mes','asc')
				    ->get();
				

				$query2 = DB::table('cao_fatura')
					->join('cao_os', 'cao_os.co_os', '=','cao_fatura.co_os')
				    ->join('cao_salario', 'cao_salario.co_usuario', '=','cao_os.co_usuario')
				    ->join('cao_usuario', 'cao_usuario.co_usuario', '=','cao_os.co_usuario')
				    ->select(DB::raw('
				    	cao_usuario.co_usuario,
				    	cao_usuario.no_usuario,
				    	MONTH(data_emissao) AS mes'))
					->whereIn('cao_os.co_usuario', $array)
					->whereRaw('EXTRACT(month FROM data_emissao) BETWEEN '.$mesUno.' and '.$mesDos)
				    ->whereRaw('EXTRACT(year FROM data_emissao) BETWEEN '.$yearUno.' and '.$yearDos)
				    ->groupBy('cao_os.co_usuario')
				    ->orderBy('cao_os.co_usuario','asc','mes','desc')
				    ->get();
				    //dd($query2);
			}

    		return view('agence.graph',['querys'=>$query,'querys2'=>$query2]);

    	}elseif ($request->pizza == 'pizza') { /*Pizza*/
    		
    		if ($mesUno == "" || $mesDos == "" || $yearUno == "" || $yearDos == "") {
		    	return view('agence.pizza',['querys'=>null]);
			}else{

	    		$query = DB::table('cao_fatura')
					->join('cao_os', 'cao_os.co_os', '=','cao_fatura.co_os')
				    ->join('cao_salario', 'cao_salario.co_usuario', '=','cao_os.co_usuario')
				    ->rightJoin('cao_usuario', 'cao_usuario.co_usuario', '=','cao_os.co_usuario')
				    ->select(DB::raw('
				    	cao_usuario.co_usuario,
				    	sum(cao_fatura.valor - ((cao_fatura.valor * cao_fatura.total_imp_inc)) / 100) as liquida
				    '))
					->whereIn('cao_os.co_usuario', $array)
					->whereRaw('EXTRACT(month FROM data_emissao) BETWEEN '.$mesUno.' and '.$mesDos)
				    ->whereRaw('EXTRACT(year FROM data_emissao) BETWEEN '.$yearUno.' and '.$yearDos)
				    ->groupBy('cao_os.co_usuario')
				    ->get();
			}

    		return view('agence.pizza',['querys'=>$query]);
    	}
    }

}