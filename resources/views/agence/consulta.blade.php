@extends('layouts.master')
@section('content')

  <div class="col s12 m12 l12">
  @if(!isset($querys) || $querys == null)
    <h5 class="center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No hay Registros <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h5>
  @else
        
          
      @foreach($querys2 as $query2)
      <?php 
        $totalLiquida=0;
        $totalBrut_salario=0;
        $totalComision=0;
        $totalLucro=0;
      ?>
            <span class="new badge" data-badge-caption="{{ $query2->no_usuario }}"><i class="fa fa-user" aria-hidden="true"></i></span>
              <table class="highlight" style="margin-bottom: 3%;">
                  <thead>
                      <tr>
                          <th data-field="id">Período</th>
                          <th data-field="name">Receita Líquida</th>
                          <th data-field="price">Custo Fixo</th>
                          <th data-field="price">Comissão</th>
                          <th data-field="price">Lucro</th>
                      </tr>
                  </thead>
                  <tbody>
        @foreach($querys as $query)
          @if($query2->co_usuario == $query->co_usuario)
                          <tr>
                              <td>@if($query->mes == 1){{ $mes = 'Enero' }}@elseif($query->mes == 2){{ $mes = 'Febrero' }}@elseif($query->mes == 3){{ $mes = 'Marzo' }}@elseif($query->mes == 4){{ $mes = 'Abril' }}@elseif($query->mes == 5){{ $mes = 'Mayo' }}@elseif($query->mes == 6){{ $mes = 'Junio' }}@elseif($query->mes == 7){{ $mes = 'Julio' }}@elseif($query->mes == 8){{ $mes = 'Agosto' }}@elseif($query->mes == 9){{ $mes = 'Septiembre' }}@elseif($query->mes == 10){{ $mes = 'Octubre' }}@elseif($query->mes == 11){{ $mes = 'Noviembre' }}@elseif($query->mes == 12){{ $mes = 'Diciembre' }}
                              @endif{{ " de ".$query->year }}</td>
                            
                                <td>R$ {{ number_format($query->liquida,2,',','.') }}</td>

                                <td>R$ {{ number_format($query->brut_salario,2,',','.') }}</td>

                                <td>R$ {{ number_format($query->comision,2,',','.') }}</td>

                              @if($query->lucro < 0)
                                <td style="color: #d50000;">R$ {{ number_format($query->lucro,2,',','.') }}</td>
                              @else
                                <td>R$ {{ number_format($query->lucro,2,',','.') }}</td>
                              @endif
                          </tr>
                          <?php 
                            $totalLiquida += $query->liquida;
                            $totalBrut_salario += $query->brut_salario;
                            $totalComision += $query->comision;
                            $totalLucro += $query->lucro;
                          ?>
          @endif
        @endforeach
                  </tbody>
                  <thead class="grey lighten-4">
                      <tr>
                          <th data-field="id">SALDO</th>
                          <th data-field="price">R$ {{ number_format($totalLiquida,2,',','.') }}</th>
                          <th data-field="price">R$ {{ number_format($totalBrut_salario,2,',','.') }}</th>
                          <th data-field="price">R$ {{ number_format($totalComision,2,',','.') }}</th>
                          <th data-field="price" style="color: #0d47a1;">R$ {{ number_format($totalLucro,2,',','.') }}</th>
                      </tr>
                  </thead>
              </table>
      @endforeach
    @endif
  </div>

@endsection