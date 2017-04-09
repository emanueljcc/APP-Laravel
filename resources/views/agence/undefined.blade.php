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
                          
                          
                        <div class="col s12 m12 l12">

                        <a href="{{ URL::to('/') }}" style="color: #0089ec !important;"><i class="fa fa-arrow-left fa-3" aria-hidden="true"></i> Atrás</a> 
                        <h5 class="center"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> No hay Registros <i class="fa fa-exclamation-triangle" aria-hidden="true"></i></h5>

                        </div>
                      
                      </div>
                  </div>
              </div>
          </div>
      </div>
{{ Form::close() }}
@endsection