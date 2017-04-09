@extends('layouts.master')
@section('content')
<div class="row">
          <div class="col s12">
          <br>
              <div class="page-title"><a href="{{ URL::to('/') }}" class="waves-effect waves-grey btn m-b-xs" style="color: white !important;">Por Consultor</a> <a class="waves-effect waves-grey btn white m-b-xs">Por Cliente</a></div>
          
          </div> 
          <div class="col s12 m12 l12">
              <div class="card">
                  <div class="card-content">
                      <div class="row" id="table-agence">   
                            
                        {!!Form::open(['route'=>'agence.consulta','method'=>'POST','role'=>'form','accept-charset'=>'UTF-8'])!!}  
                          {{ csrf_field() }}
                          <div class="col s12 m3 l3" style="margin-bottom: 4%;">
                              <span class="titulo">SELECCIONE UN RANGO DE FECHA</span>
                                  <div class="col s12 m12 l12 center" style="margin-bottom: 10%;">
                                    {!! Form::select('mesUno', ['01'=>'Ene','02'=>'Feb','03'=>'Mar','04'=>'Abr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Ago','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dic'],null,['placeholder'=>'Mes','id'=>'mesUno']) !!}
                                    {!! Form::select('yearUno', ['2003'=>'2003','2004'=>'2004','2005'=>'2005','2006'=>'2006','2007'=>'2007'],null,['placeholder'=>'Año','id'=>'yearUno']) !!}
                                  </div>
                                  <div class="col s12 m12 l12 center">
                                    {!! Form::select('mesDos', ['01'=>'Ene','02'=>'Feb','03'=>'Mar','04'=>'Abr','05'=>'May','06'=>'Jun','07'=>'Jul','08'=>'Ago','09'=>'Sep','10'=>'Oct','11'=>'Nov','12'=>'Dic'],null,['placeholder'=>'Mes','id'=>'mesDos']) !!}
                                    {!! Form::select('yearDos', ['2003'=>'2003','2004'=>'2004','2005'=>'2005','2006'=>'2006','2007'=>'2007'],null,['placeholder'=>'Año','id'=>'yearDos']) !!}
                                  </div>
                          </div>
                          <div class="col s12 m6 l6" style="margin-bottom: 4%;">
                              <span class="titulo">SELECCIONE LOS CONSULTORES</span>
                                  {!! Form::select('select_cons[]',$query, null,['class'=>'js-states browser-default select2-hidden-accessible','id'=>'multiple','multiple'=>'','aria-hidden'=>'true','tabindex'=>'-1','style'=>'width:100%;']) !!}
                                  <span class="select2 select2-container select2-container--default select2-container--below" dir="ltr" style="width: 100%;">
                                    <span class="selection">
                                      <span id="spanhidden" class="select2-selection select2-selection--multiple" role="combobox" aria-autocomplete="list" aria-haspopup="true" aria-expanded="false" tabindex="-1"><ul class="select2-selection__rendered"></ul></span>
                                    </span>
                                    <span class="dropdown-wrapper" aria-hidden="true"></span>
                                  </span>
                          </div>
                          <div class="col s12 m3 l3">
                          <span class="titulo">Acción</span>
                              <div class="center">
                                  <button name="relatorio" type="submit" id="relatorio" value="relatorio" class="waves-effect waves-light btn btn-small"><i class="fa fa-file-o" aria-hidden="true"></i> Relatorio</button> 
                                  <br><br>
                                    <button name="grafico" type="submit" id="grafico" value="grafico" class="waves-effect waves-light btn btn-small"><i class="fa fa-bar-chart" aria-hidden="true"></i> Grafico</button>
                                  <br><br>
                                    <button name="pizza" type="submit" id="pizza" value="pizza" class="waves-effect waves-light btn btn-small"><i class="fa fa-pie-chart" aria-hidden="true"></i> Pizza</button>
                              </div>
                          </div>

                        {{ Form::close() }}
                      
                      </div>
                  </div>
              </div>
          </div>
      </div>




@endsection