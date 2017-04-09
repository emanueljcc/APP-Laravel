@extends('layouts.master')
@section('content')

@if(!isset($lista) || $lista == null)
  @include('agence.undefined')
@else

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
<div class="row">
    <div class="col s12">
    <br>
        <div class="page-title"><button name="relatorio" type="submit" id="relatorio" value="relatorio" class="waves-effect waves-light btn"><i class="fa fa-file-o" aria-hidden="true"></i></button>&nbsp;<button name="grafico" type="submit" id="grafico" value="grafico" class="waves-effect waves-light btn "><i class="fa fa-bar-chart" aria-hidden="true"></i></button></div>
    
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

                        <div id="container" class="center" style="width: 90%;"></div>
                        <script src="{{ asset('js/highcharts.js') }}"></script>
                        <script src="{{ asset('js/exporting.js') }}"></script>
                        <script type="text/javascript">
                        Highcharts.chart('container', {
                          chart: {
                              plotBackgroundColor: null,
                              plotBorderWidth: null,
                              plotShadow: false,
                              type: 'pie'
                          },
                          title: {
                              text: 'Grafica Pizza Consultores'
                          },
                          tooltip: {
                              pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                          },
                          plotOptions: {
                              pie: {
                                  allowPointSelect: true,
                                  cursor: 'pointer',
                                  dataLabels: {
                                      enabled: true,
                                      format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                      style: {
                                          color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                      }
                                  }
                              }
                          },
                          series: [{
                              name: 'Consultores',
                              colorByPoint: true,
                              data: [

                                  @foreach($querys as $query)
                                    {
                                        name: '{{ $query->co_usuario }}',
                                        y: {{ $query->liquida }}
                                    },
                                  @endforeach

                              ]
                          }]
                        });
                        </script>

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