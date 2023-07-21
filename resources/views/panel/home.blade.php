
@extends('../layouts.frontend')

@section('content')
    <style>
        .column-border{
            border-left: 1px solid #c3c3c3;
            border-right: 1px solid #c3c3c3;
        }
    </style>
    <div class="container">
      <br/>
      <div class="row">
        <div class="col-md-12 order-md-1">
          <h4 class="mb-3">Panel</h4>
          <x-flash></x-flash>
          <form action="{{route('panel_filtrar_campana')}}" method="POST" name="form">
            {{ csrf_field() }}
            <div class="row">
              <div class="col-md-2">
                <label for="nombre">Tipo gestión</label>
              </div>
              <div class="col-md-5">
                <select name="campana" id="campana" class="form-control">
                    <option value="0">Seleccione...</option>
                    @foreach ($calculo->campanas as $campana)
                        @if($campana->id == $calculo->campanaId)
                            <option value="{{$campana->id}}" selected>{{$campana->nombre}}</option>
                        @else
                            <option value="{{$campana->id}}">{{$campana->nombre}}</option>
                        @endIf     
                    @endforeach
                  </select>
              </div>
              <div class="col-md-5">
                <input type="submit" value="Filtrar" class="btn btn-primary btn-custom" />
              </div>
            </div>
          </form>
          <br/>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>#</th>
                  <th></th>
                  <th class="column-border">Mes estacional</th>
                  <th colspan="3" style="text-align:center;">Ultimo trimestre</th>
                  <th class="column-border">Mes actual</th>
                  <th>Variación mes anterior %</th>
                  <th>Variación mes anterior</th>
                </tr>
              </thead>
              <tbody>
              <tr>
                    <td>0</td>
                    <td>Periodo</td>
                    <td class="column-border">{{$calculo->mesEstacional}}</td>
                    <td>{{$calculo->mesTrimestre1}}</td>
                    <td>{{$calculo->mesTrimestre2}}</td>
                    <td>{{$calculo->mesTrimestre3}}</td>
                    <td class="column-border">{{$calculo->mesActual}}</td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>1</td>
                    <td># Ctas</td>
                    <td class="column-border">{{number_format($calculo->opTotalEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->opTotalTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->opTotalTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->opTotalTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->opTotalMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->opTotalVarPor}}%</td>
                    <td>{{number_format($calculo->opTotalVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>MM$ Deuda</td>
                    <td class="column-border">{{number_format($calculo->deudaTotalEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->deudaTotalTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->deudaTotalTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->deudaTotalTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->deudaTotalMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->deudaTotalVarPor}}%</td>
                    <td>{{number_format($calculo->deudaTotalVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>MM$ Recupero</td>
                    <td class="column-border">{{number_format($calculo->deudaPagadaEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->deudaPagadaTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->deudaPagadaTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->deudaPagadaTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->deudaPagadaMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->deudaPagadaVarPor}}%</td>
                    <td>{{number_format($calculo->deudaPagadaVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>4</td>
                    <td>Productividad</td>
                    <td class="column-border">{{$calculo->productividadEst}}%</td>
                    <td>{{$calculo->productividadTrim1}}%</td>
                    <td>{{$calculo->productividadTrim2}}%</td>
                    <td>{{$calculo->productividadTrim3}}%</td>
                    <td class="column-border">{{$calculo->productividadMesAct}}%</td>
                    <td>{{$calculo->productividadVarPor}}%</td>
                    <td>{{$calculo->productividadVar}}%</td>
                </tr>
                <tr>
                    <td>5</td>
                    <td>Intensidad cartera</td>
                    <td class="column-border">{{$calculo->intCarEst}}</td>
                    <td>{{$calculo->intCarTrim1}}</td>
                    <td>{{$calculo->intCarTrim2}}</td>
                    <td>{{$calculo->intCarTrim3}}</td>
                    <td class="column-border">{{$calculo->intCarMesAct}}</td>
                    <td>{{$calculo->intCarVarPor}}%</td>
                    <td>{{$calculo->intCarVar}}</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>Total Gestiones</td>
                    <td class="column-border">{{number_format($calculo->totalGesEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalGesTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalGesTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalGesTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->totalGesMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->totalGesVarPor}}%</td>
                    <td>{{number_format($calculo->totalGesVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>7</td>
                    <td>Total Contacto directo</td>
                    <td class="column-border">{{number_format($calculo->totalCDEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalCDTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalCDTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalCDTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->totalCDMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->totalCDVarPor}}%</td>
                    <td>{{number_format($calculo->totalCDVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>8</td>
                    <td>Total Contacto indirecto</td>
                    <td class="column-border">{{number_format($calculo->totalCIEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalCITrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalCITrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalCITrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->totalCIMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->totalCIVarPor}}%</td>
                    <td>{{number_format($calculo->totalCIVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>9</td>
                    <td>Total Canal remoto</td>
                    <td class="column-border">{{number_format($calculo->totalCREst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalCRTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalCRTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalCRTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->totalCRMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->totalCRVarPor}}%</td>
                    <td>{{number_format($calculo->totalCRVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>10</td>
                    <td>Total Sin contacto</td>
                    <td class="column-border">{{number_format($calculo->totalSCEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalSCTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalSCTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalSCTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->totalSCMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->totalSCVarPor}}%</td>
                    <td>{{number_format($calculo->totalSCVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>11</td>
                    <td>Total Otros</td>
                    <td class="column-border">{{number_format($calculo->otrosConEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->otrosConTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->otrosConTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->otrosConTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->otrosConMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->otrosConVarPor}}%</td>
                    <td>{{number_format($calculo->otrosConVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>12</td>
                    <td>N° Gestionadas</td>
                    <td class="column-border">{{number_format($calculo->totalGesRutEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalGesRutTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalGesRutTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->totalGesRutTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->totalGesRutMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->totalGesRutVarPor}}%</td>
                    <td>{{number_format($calculo->totalGesRutVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>13</td>
                    <td>N° Contacto directo</td>
                    <td class="column-border">{{number_format($calculo->conDirRutEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->conDirRutTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->conDirRutTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->conDirRutTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->conDirRutMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->conDirRutVarPor}}%</td>
                    <td>{{number_format($calculo->conDirRutVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>14</td>
                    <td>N° Contacto indirecto</td>
                    <td class="column-border">{{number_format($calculo->conIndRutEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->conIndRutTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->conIndRutTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->conIndRutTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->conIndRutMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->conIndRutVarPor}}%</td>
                    <td>{{number_format($calculo->conIndRutVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>15</td>
                    <td>N° Canal remoto</td>
                    <td class="column-border">{{number_format($calculo->canRemRutEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->canRemRutTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->canRemRutTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->canRemRutTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->canRemRutMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->canRemRutVarPor}}%</td>
                    <td>{{number_format($calculo->canRemRutVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>16</td>
                    <td>N° Sin contacto</td>
                    <td class="column-border">{{number_format($calculo->sinConRutEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->sinConRutTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->sinConRutTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->sinConRutTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->sinConRutMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->sinConRutVarPor}}%</td>
                    <td>{{number_format($calculo->sinConRutVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>17</td>
                    <td>N° Otros</td>
                    <td class="column-border">{{number_format($calculo->otrosConRutEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->otrosConRutTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->otrosConRutTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->otrosConRutTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->otrosConRutMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->otrosConRutVarPor}}%</td>
                    <td>{{number_format($calculo->otrosConRutVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>18</td>
                    <td>N° Sin gestión</td>
                    <td class="column-border">{{number_format($calculo->SinGesRutEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->SinGesRutTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->SinGesRutTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->SinGesRutTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->SinGesRutMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->SinGesRutVarPor}}%</td>
                    <td>{{number_format($calculo->SinGesRutVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>19</td>
                    <td>% CD</td>
                    <td class="column-border">{{$calculo->cDRutPorEst}}%</td>
                    <td>{{$calculo->cDRutPorTrim1}}%</td>
                    <td>{{$calculo->cDRutPorTrim2}}%</td>
                    <td>{{$calculo->cDRutPorTrim3}}%</td>
                    <td class="column-border">{{$calculo->cDRutPorMesAct}}%</td>
                    <td>{{$calculo->cDRutPorVarPor}}%</td>
                    <td>{{$calculo->cDRutPorVar}}%</td>
                </tr>
                <tr>
                    <td>20</td>
                    <td>% CI</td>
                    <td class="column-border">{{$calculo->cIRutPorEst}}%</td>
                    <td>{{$calculo->cIRutPorTrim1}}%</td>
                    <td>{{$calculo->cIRutPorTrim2}}%</td>
                    <td>{{$calculo->cIRutPorTrim3}}%</td>
                    <td class="column-border">{{$calculo->cIRutPorMesAct}}%</td>
                    <td>{{$calculo->cIRutPorVarPor}}%</td>
                    <td>{{$calculo->cIRutPorVar}}%</td>
                </tr>
                <tr>
                    <td>21</td>
                    <td>% CR</td>
                    <td class="column-border">{{$calculo->cRRutPorEst}}%</td>
                    <td>{{$calculo->cRRutPorTrim1}}%</td>
                    <td>{{$calculo->cRRutPorTrim2}}%</td>
                    <td>{{$calculo->cRRutPorTrim3}}%</td>
                    <td class="column-border">{{$calculo->cRRutPorMesAct}}%</td>
                    <td>{{$calculo->cRRutPorVarPor}}%</td>
                    <td>{{$calculo->cRRutPorVar}}%</td>
                </tr>
                <tr>
                    <td>22</td>
                    <td>% SC</td>
                    <td class="column-border">{{$calculo->sCRutPorEst}}%</td>
                    <td>{{$calculo->sCRutPorTrim1}}%</td>
                    <td>{{$calculo->sCRutPorTrim2}}%</td>
                    <td>{{$calculo->sCRutPorTrim3}}%</td>
                    <td class="column-border">{{$calculo->sCRutPorMesAct}}%</td>
                    <td>{{$calculo->sCRutPorVarPor}}%</td>
                    <td>{{$calculo->sCRutPorVar}}%</td>
                </tr>
                <tr>
                    <td>23</td>
                    <td>% Otro</td>
                    <td class="column-border">{{$calculo->otroConRutPorEst}}%</td>
                    <td>{{$calculo->otroConRutPorTrim1}}%</td>
                    <td>{{$calculo->otroConRutPorTrim2}}%</td>
                    <td>{{$calculo->otroConRutPorTrim3}}%</td>
                    <td class="column-border">{{$calculo->otroConRutPorMesAct}}%</td>
                    <td>{{$calculo->otroConRutPorVarPor}}%</td>
                    <td>{{$calculo->otroConRutPorVar}}%</td>
                </tr>
                <tr>
                    <td>24</td>
                    <td>% SG</td>
                    <td class="column-border">{{$calculo->sinGesRutPorEst}}%</td>
                    <td>{{$calculo->sinGesRutPorTrim1}}%</td>
                    <td>{{$calculo->sinGesRutPorTrim2}}%</td>
                    <td>{{$calculo->sinGesRutPorTrim3}}%</td>
                    <td class="column-border">{{$calculo->sinGesRutPorMesAct}}%</td>
                    <td>{{$calculo->sinGesRutPorVarPor}}%</td>
                    <td>{{$calculo->sinGesRutPorVar}}%</td>
                </tr>
                <tr>
                    <td>25</td>
                    <td>N° Promesas de pago</td>
                    <td class="column-border">{{number_format($calculo->promRutEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->promRutTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->promRutTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->promRutTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->promRutMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->promRutVarPor}}%</td>
                    <td>{{number_format($calculo->promRutVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>26</td>
                    <td>% Promesas de pago</td>
                    <td class="column-border">{{$calculo->promRutPorEst}}%</td>
                    <td>{{$calculo->promRutPorTrim1}}%</td>
                    <td>{{$calculo->promRutPorTrim2}}%</td>
                    <td>{{$calculo->promRutPorTrim3}}%</td>
                    <td class="column-border">{{$calculo->promRutPorMesAct}}%</td>
                    <td>{{$calculo->promRutPorVarPor}}%</td>
                    <td>{{$calculo->promRutPorVar}}%</td>
                </tr>
                <tr>
                    <td>27</td>
                    <td>N° Promesas cumplidas</td>
                    <td class="column-border">{{number_format($calculo->promCumRutEst, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->promCumRutTrim1, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->promCumRutTrim2, 0, ',', '.')}}</td>
                    <td>{{number_format($calculo->promCumRutTrim3, 0, ',', '.')}}</td>
                    <td class="column-border">{{number_format($calculo->promCumRutMesAct, 0, ',', '.')}}</td>
                    <td>{{$calculo->promCumRutVarPor}}%</td>
                    <td>{{number_format($calculo->promCumRutVar, 0, ',', '.')}}</td>
                </tr>
                <tr>
                    <td>28</td>
                    <td>% Promesas cumplidas</td>
                    <td class="column-border">{{$calculo->promCumRutPorEst}}%</td>
                    <td>{{$calculo->promCumRutPorTrim1}}%</td>
                    <td>{{$calculo->promCumRutPorTrim2}}%</td>
                    <td>{{$calculo->promCumRutPorTrim3}}%</td>
                    <td class="column-border">{{$calculo->promCumRutPorMesAct}}%</td>
                    <td>{{$calculo->promCumRutPorVarPor}}%</td>
                    <td>{{$calculo->promCumRutPorVar}}%</td>
                </tr>
                <tr>
                    <td>29</td>
                    <td>Ratio de negociación</td>
                    <td class="column-border">{{$calculo->ratNegEst}}%</td>
                    <td>{{$calculo->ratNegTrim1}}%</td>
                    <td>{{$calculo->ratNegTrim2}}%</td>
                    <td>{{$calculo->ratNegTrim3}}%</td>
                    <td class="column-border">{{$calculo->ratNegMesAct}}%</td>
                    <td>{{$calculo->ratNegVarPor}}%</td>
                    <td>{{$calculo->ratNegVar}}%</td>
                </tr>
                <tr>
                    <td>30</td>
                    <td>Ratio exito</td>
                    <td class="column-border">{{$calculo->ratExitoEst}}%</td>
                    <td>{{$calculo->ratExitoTrim1}}%</td>
                    <td>{{$calculo->ratExitoTrim2}}%</td>
                    <td>{{$calculo->ratExitoTrim3}}%</td>
                    <td class="column-border">{{$calculo->ratExitoMesAct}}%</td>
                    <td>{{$calculo->ratExitoVarPor}}%</td>
                    <td>{{$calculo->ratExitoVar}}%</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
       
      </footer>
    </div>
@endsection

