@extends('layouts.master')
@section('content')

<div class="col s12 m12 l12">

@if(!isset($querys) || $querys == null)
  <h5 class="center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No hay Registros <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h5>
@else

<div id="container" class="center" style="width: 90%;"></div>
<script src="{{ asset('js/highcharts.js') }}"></script>
<script src="{{ asset('js/exporting.js') }}"></script>
<script type="text/javascript">
Highcharts.chart('container', {
    title: {
        text: 'Grafica de Consultores'
    },
    xAxis: {
        categories: [
                  @foreach ($querys as $query)
                    @if($query->mes == 1)'Enero'@elseif($query->mes == 2)'Febrero'@elseif($query->mes == 3)'Marzo'@elseif($query->mes == 4)'Abril'@elseif($query->mes == 5)'Mayo'@elseif($query->mes == 6)'Junio'@elseif($query->mes == 7)'Julio'@elseif($query->mes == 8)'Agosto'@elseif($query->mes == 9)'Septiembre'@elseif($query->mes == 10)'Octubre'@elseif($query->mes == 11)'Noviembre'@elseif($query->mes == 12)'Diciembre'@endif,
                  @endforeach
                    ]
    },
    labels: {
        items: [{
            html: 'Agence',
            style: {
                left: '50px',
                top: '18px',
                color: (Highcharts.theme && Highcharts.theme.textColor) || 'black'
            }
        }]
    },
    series: [

          @foreach($querys2 as $query2)
 
                {
                    type: 'column',
                    name: '{{ $query2->co_usuario }}',
                    data: [
                          @foreach($querys as $query)

                            {{ $query->liquida }},

                          @endforeach
                          ]
                },
          @endforeach

    {
        type: 'spline',
        name: 'Conteo',
        data: [
            @foreach($querys as $query)

              {{ $query->brut_salario }},

            @endforeach

              ],
        marker: {
            lineWidth: 2,
            lineColor: Highcharts.getOptions().colors[3],
            fillColor: 'white'
        }
    }]
});
    </script>
@endif
</div>
@endsection