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

@endsection