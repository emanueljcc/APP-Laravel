@extends('layouts.master')
@section('content')

@if(!isset($lista) || $lista == null)
  @include('agence.undefined')
@else



<div class="row">
    <div class="col s12">
    <br>
    {!!Form::open(['route'=>'agence.consulta','method'=>'POST','role'=>'form','accept-charset'=>'UTF-8'])!!}
      {{ csrf_field() }}
      <input type="hidden" name="mesUno" id="mesUno">
      <input type="hidden" name="mesDos" id="mesDos">
      <input type="hidden" name="yearUno" id="yearUno">
      <input type="hidden" name="yearDos" id="yearDos">
      <div style="display: none;">
        {!! Form::select('select_cons[]',$lista, null,['class'=>'js-states browser-default select2-hidden-accessible','id'=>'multiple','multiple'=>'','aria-hidden'=>'true','tabindex'=>'-1','style'=>'width:100%;']) !!}
        <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 100%;">
          <span class="selection">
            <span id="spanhidden" class="select2-selection select2-selection--multiple" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"></ul></span>
          </span>
          <span class="dropdown-wrapper" aria-hidden="true"></span>
      </span>
      </div>
        <div class="page-title"><button name="grafico" type="submit" id="grafico" value="grafico" class="waves-effect waves-light btn "><i class="fa fa-bar-chart" aria-hidden="true"></i></button>&nbsp;<button name="pizza" type="submit" id="pizza" value="pizza" class="waves-effect waves-light btn "><i class="fa fa-pie-chart" aria-hidden="true"></i></button></div>
    
    </div>
    <div class="col s12 m12 l12">
        <div class="card">
            <div class="card-content">
                <div class="row" id="table-agence">   
                    
                    
                    <div class="col s12 m12 l12">
                    @if(!isset($querys) || $querys == null)
                    <a href="{{ URL::to('/') }}" style="color: #0089ec !important;"><i class="fa fa-arrow-left fa-3" aria-hidden="true"></i> Atrás</a>
                      <h5 class="center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No hay Registros <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h5>
                    @else

                            
                        <a href="{{ URL::to('/') }}" style="color: #0089ec !important;"><i class="fa fa-arrow-left fa-3" aria-hidden="true"></i> Atrás</a>  
                            
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

                </div>
            </div>
        </div>
    </div>
</div>
@endif

{{ Form::close() }}
@endsection