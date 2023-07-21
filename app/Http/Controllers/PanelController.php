<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\ValidaSelect;
use App\Models\Panel;
use App\Models\Gestion;
use App\Models\Deuda;
use App\Models\Pago;
use App\Models\Campana;
use App\Models\Calculo;

use DB;

class PanelController extends Controller
{
    public function index(string $campanaId="FALF"){
        $calculo = new Calculo();
        $campana = new Campana();
        
        
        $periodoMesActual = date('Y-m');
        $periodoTrim1 = date('Y-m',strtotime('-3 months'));
        $periodoTrim2 = date('Y-m',strtotime('-2 months'));
        $periodoTrim3 = date('Y-m',strtotime('-1 months'));
        $aperiodoAnoEst = date('Y-m',strtotime('-1 year'));

        $calculo->campanaId = $campanaId;
        $calculo->campanas = $campana->get_campanas();
        $calculo->mesActual = date('Y-m');
        $calculo->mesTrimestre1 = date('Y-m',strtotime('-3 months'));
        $calculo->mesTrimestre2 = date('Y-m',strtotime('-2 months'));
        $calculo->mesTrimestre3 = date('Y-m',strtotime('-1 months'));
        $calculo->mesEstacional = date('Y-m',strtotime('-1 year'));

        $panelMesActual = $this->get_panel($campanaId, $periodoMesActual);
        $panelTrim1 = $this->get_panel($campanaId, $periodoTrim1);
        $panelTrim2 = $this->get_panel($campanaId, $periodoTrim2);
        $panelTrim3 = $this->get_panel($campanaId, $periodoTrim3);
        $panelEst = $this->get_panel($campanaId, $aperiodoAnoEst);

        /* #1 - N° cuentas asignadas */
        $calculo->opTotalMesAct = $panelMesActual->numero_cuentas;
        $calculo->opTotalTrim1 = $panelTrim1->numero_cuentas;
        $calculo->opTotalTrim2 = $panelTrim2->numero_cuentas;
        $calculo->opTotalTrim3 = $panelTrim3->numero_cuentas;
        $calculo->opTotalEst = $panelEst->numero_cuentas;
        $calculo->opTotalVar = $calculo->get_variacion_mes_anterior($calculo->opTotalMesAct, $calculo->opTotalTrim3);
        $calculo->opTotalVarPor = $calculo->get_variacion_mes_anterior_por($calculo->opTotalVar, $calculo->opTotalTrim3);

        /* #2 - MM$ DEUDA */
        $calculo->deudaTotalMesAct = $panelMesActual->deuda_total;
        $calculo->deudaTotalTrim1 = $panelTrim1->deuda_total;
        $calculo->deudaTotalTrim2 = $panelTrim2->deuda_total;
        $calculo->deudaTotalTrim3 = $panelTrim3->deuda_total;
        $calculo->deudaTotalEst = $panelEst->deuda_total;
        $calculo->deudaTotalVar = $calculo->get_variacion_mes_anterior($calculo->deudaTotalMesAct, $calculo->deudaTotalTrim3);
        $calculo->deudaTotalVarPor = $calculo->get_variacion_mes_anterior_por($calculo->deudaTotalVar, $calculo->deudaTotalTrim3);
        
        /* #3 - MM$ RECUPERO */
        $calculo->deudaPagadaMesAct = $panelMesActual->deuda_pagada;
        $calculo->deudaPagadaTrim1 = $panelTrim1->deuda_pagada;
        $calculo->deudaPagadaTrim2 = $panelTrim2->deuda_pagada;
        $calculo->deudaPagadaTrim3 = $panelTrim3->deuda_pagada;
        $calculo->deudaPagadaEst = $panelEst->deuda_pagada;
        $calculo->deudaPagadaVar = $calculo->get_variacion_mes_anterior($calculo->deudaPagadaMesAct , $calculo->deudaPagadaTrim3);
        $calculo->deudaPagadaVarPor = $calculo->get_variacion_mes_anterior_por($calculo->deudaPagadaVar, $calculo->deudaPagadaTrim3);

        /* #4 - PRODUCTIVIDAD */
        $calculo->productividadMesAct = $calculo->get_productividad($calculo->deudaPagadaMesAct, $calculo->deudaTotalMesAct);
        $calculo->productividadTrim1 = $calculo->get_productividad($calculo->deudaPagadaTrim1, $calculo->deudaTotalTrim1);
        $calculo->productividadTrim2 = $calculo->get_productividad($calculo->deudaPagadaTrim2, $calculo->deudaTotalTrim2);
        $calculo->productividadTrim3 = $calculo->get_productividad($calculo->deudaPagadaTrim3, $calculo->deudaTotalTrim3);
        $calculo->productividadEst = $calculo->get_productividad($calculo->deudaPagadaEst, $calculo->deudaTotalEst);
        $calculo->productividadVar = $calculo->get_variacion_mes_anterior($calculo->productividadMesAct, $calculo->productividadTrim3);
        $calculo->productividadVarPor = $calculo->get_variacion_mes_anterior_por($calculo->productividadVar, $calculo->productividadTrim3);

        /* #7 - # TOTAL CD */
        $calculo->totalCDMesAct = $panelMesActual->total_cd;
        $calculo->totalCDTrim1 = $panelTrim1->total_cd;
        $calculo->totalCDTrim2 = $panelTrim2->total_cd;
        $calculo->totalCDTrim3 = $panelTrim3->total_cd;
        $calculo->totalCDEst = $panelEst->total_cd;
        $calculo->totalCDVar = $calculo->get_variacion_mes_anterior($calculo->totalCDMesAct, $calculo->totalCDTrim3);
        $calculo->totalCDVarPor = $calculo->get_variacion_mes_anterior_por($calculo->totalCDVar , $calculo->totalCDTrim3);

        /* #8 -TOTAL CI */
        $calculo->totalCIMesAct = $panelMesActual->total_ci;
        $calculo->totalCITrim1 = $panelTrim1->total_ci;
        $calculo->totalCITrim2 = $panelTrim2->total_ci;
        $calculo->totalCITrim3 = $panelTrim3->total_ci;
        $calculo->totalCIEst = $panelEst->total_ci;
        $calculo->totalCIVar = $calculo->get_variacion_mes_anterior($calculo->totalCIMesAct, $calculo->totalCITrim3);
        $calculo->totalCIVarPor = $calculo->get_variacion_mes_anterior_por($calculo->totalCIVar, $calculo->totalCITrim3);

        /* #9 -TOTAL CR */
        $calculo->totalCRMesAct = $panelMesActual->total_cr;
        $calculo->totalCRTrim1 = $panelTrim1->total_cr;
        $calculo->totalCRTrim2 = $panelTrim2->total_cr;
        $calculo->totalCRTrim3 = $panelTrim3->total_cr;
        $calculo->totalCREst = $panelEst->total_cr;
        $calculo->totalCRVar = $calculo->get_variacion_mes_anterior($calculo->totalCRMesAct, $calculo->totalCRTrim3);
        $calculo->totalCRVarPor = $calculo->get_variacion_mes_anterior_por($calculo->totalCRVar, $calculo->totalCRTrim3);

        /* #10 - TOTAL SC */
        $calculo->totalSCMesAct = $panelMesActual->total_sc;
        $calculo->totalSCTrim1 = $panelTrim1->total_sc;
        $calculo->totalSCTrim2 = $panelTrim2->total_sc;
        $calculo->totalSCTrim3 = $panelTrim3->total_sc;
        $calculo->totalSCEst = $panelEst->total_sc;
        $calculo->totalSCVar = $calculo->get_variacion_mes_anterior($calculo->totalSCMesAct, $calculo->totalSCTrim3);
        $calculo->totalSCVarPor = $calculo->get_variacion_mes_anterior_por($calculo->totalSCVar, $calculo->totalSCTrim3);

        /* #11 - TOTAL OTRO */
        $calculo->otrosConMesAct = $panelMesActual->total_otro;
        $calculo->otrosConTrim1 = $panelTrim1->total_otro;
        $calculo->otrosConTrim2 = $panelTrim2->total_otro;
        $calculo->otrosConTrim3 = $panelTrim3->total_otro;
        $calculo->otrosConEst = $panelEst->total_otro;
        $calculo->otrosConVar = $calculo->get_variacion_mes_anterior($calculo->otrosConMesAct, $calculo->otrosConTrim3);
        $calculo->otrosConVarPor = $calculo->get_variacion_mes_anterior_por($calculo->otrosConVar, $calculo->otrosConTrim3);

        /* #6 - TOTAL GESTIONES*/
        $calculo->totalGesMesAct = $calculo->get_total_gestionado(
            $calculo->totalCDMesAct,
            $calculo->totalCIMesAct,
            $calculo->totalCRMesAct,
            $calculo->totalSCMesAct,
            $calculo->otrosConMesAct
        );
        $calculo->totalGesTrim1 = $calculo->get_total_gestionado(
            $calculo->totalCDTrim1,
            $calculo->totalCITrim1,
            $calculo->totalCRTrim1,
            $calculo->totalSCTrim1,
            $calculo->otrosConTrim1
        );
        $calculo->totalGesTrim2 = $calculo->get_total_gestionado(
            $calculo->totalCDTrim2,
            $calculo->totalCITrim2,
            $calculo->totalCRTrim2,
            $calculo->totalSCTrim2,
            $calculo->otrosConTrim2
        );
        $calculo->totalGesTrim3 = $calculo->get_total_gestionado(
            $calculo->totalCDTrim3,
            $calculo->totalCITrim3,
            $calculo->totalCRTrim3,
            $calculo->totalSCTrim3,
            $calculo->otrosConTrim3
        );
        $calculo->totalGesEst = $calculo->get_total_gestionado(
            $calculo->totalCDEst,
            $calculo->totalCIEst,
            $calculo->totalCREst,
            $calculo->totalSCEst,
            $calculo->otrosConEst
        );
        $calculo->totalGesVar = $calculo->get_variacion_mes_anterior($calculo->totalGesMesAct, $calculo->totalGesTrim3);
        $calculo->totalGesVarPor = $calculo->get_variacion_mes_anterior_por($calculo->totalGesVar, $calculo->totalGesTrim3);

        /* #13 - # CONTACTO_DIRECTO */
        $calculo->conDirRutMesAct = $panelMesActual->total_cd_rut;
        $calculo->conDirRutTrim1 = $panelTrim1->total_cd_rut;
        $calculo->conDirRutTrim2 = $panelTrim2->total_cd_rut;
        $calculo->conDirRutTrim3 = $panelTrim3->total_cd_rut;
        $calculo->conDirRutEst = $panelEst->total_cd_rut;
        $calculo->conDirRutVar = $calculo->get_variacion_mes_anterior($calculo->conDirRutMesAct, $calculo->conDirRutTrim3);
        $calculo->conDirRutVarPor = $calculo->get_variacion_mes_anterior_por($calculo->conDirRutVar, $calculo->conDirRutTrim3);

        /* #14 - # CONTACTO_INDIRECTO */
        $calculo->conIndRutMesAct = $panelMesActual->total_ci_rut;
        $calculo->conIndRutTrim1 = $panelTrim1->total_ci_rut;
        $calculo->conIndRutTrim2 = $panelTrim2->total_ci_rut;
        $calculo->conIndRutTrim3 = $panelTrim3->total_ci_rut;
        $calculo->conIndRutEst = $panelEst->total_ci_rut;
        $calculo->conIndRutVar = $calculo->get_variacion_mes_anterior($calculo->conIndRutMesAct, $calculo->conIndRutTrim3);
        $calculo->conIndRutVarPor = $calculo->get_variacion_mes_anterior_por($calculo->conIndRutVar, $calculo->conIndRutTrim3);

        /* #15 - # CANAL_REMOTO*/
        $calculo->canRemRutMesAct = $panelMesActual->total_cr_rut;
        $calculo->canRemRutTrim1 = $panelTrim1->total_cr_rut;
        $calculo->canRemRutTrim2 = $panelTrim2->total_cr_rut;
        $calculo->canRemRutTrim3 = $panelTrim3->total_cr_rut;
        $calculo->canRemRutEst = $panelEst->total_cr_rut;
        $calculo->canRemRutVar = $calculo->get_variacion_mes_anterior($calculo->canRemRutMesAct, $calculo->canRemRutTrim3);
        $calculo->canRemRutVarPor = $calculo->get_variacion_mes_anterior_por($calculo->canRemRutVar, $calculo->canRemRutTrim3);

        /* #16 - # SIN_CONTACTO */
        $calculo->sinConRutMesAct = $panelMesActual->total_sc_rut;
        $calculo->sinConRutTrim1 = $panelTrim1->total_sc_rut;
        $calculo->sinConRutTrim2 = $panelTrim2->total_sc_rut;
        $calculo->sinConRutTrim3 = $panelTrim3->total_sc_rut;
        $calculo->sinConRutEst = $panelEst->total_sc_rut;
        $calculo->sinConRutVar = $calculo->get_variacion_mes_anterior($calculo->sinConRutMesAct, $calculo->sinConRutTrim3);
        $calculo->sinConRutVarPor = $calculo->get_variacion_mes_anterior_por($calculo->sinConRutVar, $calculo->sinConRutTrim3);

        /* #17 - # OTRO */
        $calculo->otrosConRutMesAct = $panelMesActual->total_otro_rut;
        $calculo->otrosConRutTrim1 = $panelTrim1->total_otro_rut;
        $calculo->otrosConRutTrim2 = $panelTrim2->total_otro_rut;
        $calculo->otrosConRutTrim3 = $panelTrim3->total_otro_rut;
        $calculo->otrosConRutEst = $panelEst->total_otro_rut;
        $calculo->otrosConRutVar = $calculo->get_variacion_mes_anterior($calculo->otrosConRutMesAct, $calculo->otrosConRutTrim3);
        $calculo->otrosConRutVarPor = $calculo->get_variacion_mes_anterior_por($calculo->otrosConRutVar, $calculo->otrosConRutTrim3);


        /* #12 - # GESTIONADAS */
        $calculo->totalGesRutMesAct = $calculo->get_total_gestionado_rut(
            $calculo->conDirRutMesAct,
            $calculo->conIndRutMesAct,
            $calculo->canRemRutMesAct,
            $calculo->sinConRutMesAct,
            $calculo->otrosConRutMesAct
        );
        $calculo->totalGesRutTrim1 = $calculo->get_total_gestionado_rut(
            $calculo->conDirRutTrim1,
            $calculo->conIndRutTrim1,
            $calculo->canRemRutTrim1,
            $calculo->sinConRutTrim1,
            $calculo->otrosConRutTrim1
        );
        $calculo->totalGesRutTrim2 = $calculo->get_total_gestionado_rut(
            $calculo->conDirRutTrim2,
            $calculo->conIndRutTrim2,
            $calculo->canRemRutTrim2,
            $calculo->sinConRutTrim2,
            $calculo->otrosConRutTrim2
        );
        $calculo->totalGesRutTrim3 = $calculo->get_total_gestionado_rut(
            $calculo->conDirRutTrim3,
            $calculo->conIndRutTrim3,
            $calculo->canRemRutTrim3,
            $calculo->sinConRutTrim3,
            $calculo->otrosConRutTrim3
        );
        $calculo->totalGesRutEst = $calculo->get_total_gestionado_rut(
            $calculo->conDirRutEst,
            $calculo->conIndRutEst,
            $calculo->canRemRutEst,
            $calculo->sinConRutEst,
            $calculo->otrosConRutEst
        );
        $calculo->totalGesRutVar = $calculo->get_variacion_mes_anterior($calculo->totalGesRutMesAct, $calculo->totalGesRutTrim3);
        $calculo->totalGesRutVarPor = $calculo->get_variacion_mes_anterior_por($calculo->totalGesRutVar, $calculo->totalGesRutTrim3);

        /* #5 - INTENSIDAD CARTERA */
        $calculo->intCarMesAct = $calculo->get_intensidad_cartera($calculo->totalGesRutMesAct, $calculo->totalGesMesAct);
        $calculo->intCarTrim1 = $calculo->get_intensidad_cartera($calculo->totalGesRutTrim1, $calculo->totalGesTrim1);
        $calculo->intCarTrim2 = $calculo->get_intensidad_cartera($calculo->totalGesRutTrim2, $calculo->totalGesTrim2);
        $calculo->intCarTrim3 = $calculo->get_intensidad_cartera($calculo->totalGesRutTrim3, $calculo->totalGesTrim3);
        $calculo->intCarEst = $calculo->get_intensidad_cartera($calculo->totalGesRutEst, $calculo->totalGesEst);
        $calculo->intCarVar = $calculo->get_variacion_mes_anterior($calculo->intCarMesAct, $calculo->intCarTrim3);
        $calculo->intCarVarPor = $calculo->get_variacion_mes_anterior_por($calculo->intCarVar, $calculo->intCarTrim3);

        /* #18 - # SIN_GESTION */
        //echo count($panelTrim3) == 0 ? 0 : $panelTrim3[0]["sin_gestion"] == null ? 0 : $panelTrim3[0]["sin_gestion"];
        $calculo->SinGesRutMesAct = $panelMesActual->sin_gestion;
        $calculo->SinGesRutTrim1 = $panelTrim1->sin_gestion;
        $calculo->SinGesRutTrim2 = $panelTrim2->sin_gestion;
        $calculo->SinGesRutTrim3 = $panelTrim3->sin_gestion;
        $calculo->SinGesRutEst = $panelEst->sin_gestion;
        $calculo->SinGesRutVar = $calculo->get_variacion_mes_anterior($calculo->SinGesRutMesAct, $calculo->SinGesRutTrim3);
        $calculo->SinGesRutVarPor = $calculo->get_variacion_mes_anterior_por($calculo->SinGesRutVar, $calculo->SinGesRutTrim3);

        /* #19 - % CD */
        $calculo->cDRutPorMesAct = $calculo->get_contacto_directo_rut_procentaje($calculo->conDirRutMesAct, $calculo->totalGesRutMesAct);
        $calculo->cDRutPorTrim1 = $calculo->get_contacto_directo_rut_procentaje($calculo->conDirRutTrim1, $calculo->totalGesRutTrim1);
        $calculo->cDRutPorTrim2 = $calculo->get_contacto_directo_rut_procentaje($calculo->conDirRutTrim2, $calculo->totalGesRutTrim2);
        $calculo->cDRutPorTrim3 = $calculo->get_contacto_directo_rut_procentaje($calculo->conDirRutTrim3, $calculo->totalGesRutTrim3);
        $calculo->cDRutPorEst = $calculo->get_contacto_directo_rut_procentaje($calculo->conDirRutEst, $calculo->totalGesRutEst);
        $calculo->cDRutPorVar = $calculo->get_variacion_mes_anterior($calculo->cDRutPorMesAct, $calculo->cDRutPorTrim3);
        $calculo->cDRutPorVarPor = $calculo->get_variacion_mes_anterior_por($calculo->cDRutPorVar, $calculo->cDRutPorTrim3);

        /* #20 - % CI */
        $calculo->cIRutPorMesAct = $calculo->get_contacto_indirecto_rut_procentaje($calculo->conIndRutMesAct, $calculo->totalGesRutMesAct);
        $calculo->cIRutPorTrim1 = $calculo->get_contacto_indirecto_rut_procentaje($calculo->conIndRutTrim1, $calculo->totalGesRutTrim1);
        $calculo->cIRutPorTrim2 = $calculo->get_contacto_indirecto_rut_procentaje($calculo->conIndRutTrim2, $calculo->totalGesRutTrim2);
        $calculo->cIRutPorTrim3 = $calculo->get_contacto_indirecto_rut_procentaje($calculo->conIndRutTrim3, $calculo->totalGesRutTrim3);
        $calculo->cIRutPorEst = $calculo->get_contacto_indirecto_rut_procentaje($calculo->conIndRutEst, $calculo->totalGesRutEst);
        $calculo->cIRutPorVar = $calculo->get_variacion_mes_anterior($calculo->cIRutPorMesAct, $calculo->cIRutPorTrim3);
        $calculo->cIRutPorVarPor = $calculo->get_variacion_mes_anterior_por($calculo->cIRutPorVar, $calculo->cIRutPorTrim3);

        /* #21 - % CR */
        $calculo->cRRutPorMesAct = $calculo->get_canal_remoto_rut_procentaje($calculo->canRemRutMesAct, $calculo->totalGesRutMesAct);
        $calculo->cRRutPorTrim1 = $calculo->get_canal_remoto_rut_procentaje($calculo->canRemRutTrim1, $calculo->totalGesRutTrim1);
        $calculo->cRRutPorTrim2 = $calculo->get_canal_remoto_rut_procentaje($calculo->canRemRutTrim2, $calculo->totalGesRutTrim2);
        $calculo->cRRutPorTrim3 = $calculo->get_canal_remoto_rut_procentaje($calculo->canRemRutTrim3, $calculo->totalGesRutTrim3);
        $calculo->cRRutPorEst = $calculo->get_canal_remoto_rut_procentaje($calculo->canRemRutEst, $calculo->totalGesRutEst);
        $calculo->cRRutPorVar = $calculo->get_variacion_mes_anterior($calculo->cRRutPorMesAct, $calculo->cRRutPorTrim3);
        $calculo->cRRutPorVarPor = $calculo->get_variacion_mes_anterior_por($calculo->cRRutPorVar, $calculo->cRRutPorTrim3);

        /* #22 - % SC */
        $calculo->sCRutPorMesAct = $calculo->get_sin_contacto_rut_procentaje($calculo->sinConRutMesAct, $calculo->totalGesRutMesAct);
        $calculo->sCRutPorTrim1 = $calculo->get_sin_contacto_rut_procentaje($calculo->sinConRutTrim1, $calculo->totalGesRutTrim1);
        $calculo->sCRutPorTrim2 = $calculo->get_sin_contacto_rut_procentaje($calculo->sinConRutTrim2, $calculo->totalGesRutTrim2);
        $calculo->sCRutPorTrim3 = $calculo->get_sin_contacto_rut_procentaje($calculo->sinConRutTrim3, $calculo->totalGesRutTrim3);
        $calculo->sCRutPorEst = $calculo->get_sin_contacto_rut_procentaje($calculo->sinConRutEst, $calculo->totalGesRutEst);
        $calculo->sCRutPorVar = $calculo->get_variacion_mes_anterior($calculo->sCRutPorMesAct, $calculo->sCRutPorTrim3);
        $calculo->sCRutPorVarPor = $calculo->get_variacion_mes_anterior_por($calculo->sCRutPorVar, $calculo->sCRutPorTrim3);

        /* #23 - % OTRO */
        $calculo->otroConRutPorMesAct  = $calculo->get_otro_contacto_rut_procentaje($calculo->otrosConRutMesAct, $calculo->totalGesRutMesAct);
        $calculo->otroConRutPorTrim1  = $calculo->get_otro_contacto_rut_procentaje($calculo->otrosConRutTrim1, $calculo->totalGesRutTrim1);
        $calculo->otroConRutPorTrim2  = $calculo->get_otro_contacto_rut_procentaje($calculo->otrosConRutTrim2, $calculo->totalGesRutTrim2);
        $calculo->otroConRutPorTrim3  = $calculo->get_otro_contacto_rut_procentaje($calculo->otrosConRutTrim3, $calculo->totalGesRutTrim3);
        $calculo->otroConRutPorEst  = $calculo->get_otro_contacto_rut_procentaje($calculo->otrosConRutEst, $calculo->totalGesRutEst);
        $calculo->otroConRutPorVar  = $calculo->get_variacion_mes_anterior($calculo->otroConRutPorMesAct, $calculo->otroConRutPorTrim3);
        $calculo->otroConRutPorVarPor  = $calculo->get_variacion_mes_anterior_por($calculo->otroConRutPorVar, $calculo->otroConRutPorTrim3);

        /* #24 - % SG */
        $calculo->sinGesRutPorMesAct = $calculo->get_sin_gestion_rut_procentaje($calculo->SinGesRutMesAct, $calculo->opTotalMesAct);
        $calculo->sinGesRutPorTrim1 = $calculo->get_sin_gestion_rut_procentaje($calculo->SinGesRutTrim1, $calculo->opTotalTrim1);
        $calculo->sinGesRutPorTrim2 = $calculo->get_sin_gestion_rut_procentaje($calculo->SinGesRutTrim2, $calculo->opTotalTrim2);
        $calculo->sinGesRutPorTrim3 = $calculo->get_sin_gestion_rut_procentaje($calculo->SinGesRutTrim3, $calculo->opTotalTrim3);
        $calculo->sinGesRutPorEst = $calculo->get_sin_gestion_rut_procentaje($calculo->SinGesRutEst, $calculo->opTotalEst);
        $calculo->sinGesRutPorVar = $calculo->get_variacion_mes_anterior($calculo->sinGesRutPorMesAct, $calculo->sinGesRutPorTrim3);
        $calculo->sinGesRutPorVarPor = $calculo->get_variacion_mes_anterior_por($calculo->sinGesRutPorVar, $calculo->sinGesRutPorTrim3);
        
        /* #25 - # PROMESA_PAGO */
        $calculo->promRutMesAct = $panelMesActual->promesa_pago;
        $calculo->promRutTrim1 = $panelTrim1->promesa_pago;
        $calculo->promRutTrim2 = $panelTrim2->promesa_pago;
        $calculo->promRutTrim3 = $panelTrim3->promesa_pago;
        $calculo->promRutEst = $panelEst->promesa_pago;
        $calculo->promRutVar = $calculo->get_variacion_mes_anterior($calculo->promRutMesAct, $calculo->promRutTrim3);
        $calculo->promRutVarPor = $calculo->get_variacion_mes_anterior_por($calculo->promRutVar, $calculo->promRutTrim3);

        /* #26 - % PP */
        $calculo->promRutPorMesAct = $calculo->get_promesas_rut_porcentaje($calculo->promRutMesAct, $calculo->opTotalMesAct);
        $calculo->promRutPorTrim1 = $calculo->get_promesas_rut_porcentaje($calculo->promRutTrim1, $calculo->opTotalTrim1);
        $calculo->promRutPorTrim2 = $calculo->get_promesas_rut_porcentaje($calculo->promRutTrim2, $calculo->opTotalTrim2);
        $calculo->promRutPorTrim3 = $calculo->get_promesas_rut_porcentaje($calculo->promRutTrim3, $calculo->opTotalTrim3);
        $calculo->promRutPorEst = $calculo->get_promesas_rut_porcentaje($calculo->promRutEst, $calculo->opTotalEst);
        $calculo->promRutPorVar = $calculo->get_variacion_mes_anterior( $calculo->promRutPorMesAct, $calculo->promRutPorTrim3);
        $calculo->promRutPorVarPor = $calculo->get_variacion_mes_anterior_por( $calculo->promRutPorVar, $calculo->promRutPorTrim3);

        /* #27 - # PROMESA CUMPLIDA */
        $calculo->promCumRutMesAct = $panelMesActual->promesa_cumplida;
        $calculo->promCumRutTrim1 = $panelTrim1->promesa_cumplida;
        $calculo->promCumRutTrim2 = $panelTrim2->promesa_cumplida;
        $calculo->promCumRutTrim3 = $panelTrim3->promesa_cumplida;
        $calculo->promCumRutEst = $panelEst->promesa_cumplida;
        $calculo->promCumRutVar = $calculo->get_variacion_mes_anterior($calculo->promCumRutMesAct, $calculo->promCumRutTrim3);
        $calculo->promCumRutVarPor = $calculo->get_variacion_mes_anterior_por($calculo->promCumRutVar, $calculo->promCumRutTrim3);
        
        /* #28 - % PROMESA CUMPLIDA */
        $calculo->promCumRutPorMesAct = $calculo->get_promesas_cumplidas_rut_porcentaje($calculo->promCumRutMesAct, $calculo->promRutMesAct);
        $calculo->promCumRutPorTrim1 = $calculo->get_promesas_cumplidas_rut_porcentaje($calculo->promCumRutTrim1, $calculo->promRutTrim1);
        $calculo->promCumRutPorTrim2 = $calculo->get_promesas_cumplidas_rut_porcentaje($calculo->promCumRutTrim2, $calculo->promRutTrim2);
        $calculo->promCumRutPorTrim3 = $calculo->get_promesas_cumplidas_rut_porcentaje($calculo->promCumRutTrim3, $calculo->promRutTrim3);
        $calculo->promCumRutPorEst = $calculo->get_promesas_cumplidas_rut_porcentaje($calculo->promCumRutEst, $calculo->promRutEst);
        $calculo->promCumRutPorVar = $calculo->get_variacion_mes_anterior($calculo->promCumRutPorMesAct, $calculo->promCumRutPorTrim3);
        $calculo->promCumRutPorVarPor = $calculo->get_variacion_mes_anterior_por($calculo->promCumRutPorVar, $calculo->promCumRutPorTrim3);
        
        /* #29 - RATIO_NEGOCIACION */
        $calculo->ratNegMesAct = $calculo->get_ratio_negociacion($calculo->promCumRutPorMesAct, $calculo->promRutPorMesAct);
        $calculo->ratNegTrim1 = $calculo->get_ratio_negociacion($calculo->promCumRutPorTrim1, $calculo->promRutPorTrim1);
        $calculo->ratNegTrim2 = $calculo->get_ratio_negociacion($calculo->promCumRutPorTrim2, $calculo->promRutPorTrim2);
        $calculo->ratNegTrim3 = $calculo->get_ratio_negociacion($calculo->promCumRutPorTrim3, $calculo->promRutPorTrim3);
        $calculo->ratNegEst = $calculo->get_ratio_negociacion($calculo->promCumRutPorEst, $calculo->promRutPorEst);
        $calculo->ratNegVar = $calculo->get_variacion_mes_anterior($calculo->ratNegMesAct, $calculo->ratNegTrim3);
        $calculo->ratNegVarPor = $calculo->get_variacion_mes_anterior_por($calculo->ratNegVar, $calculo->ratNegTrim3);

        /* #30 - RATIO_EXITO */
        $calculo->ratExitoMesAct = $calculo->get_ratio_exito($calculo->ratNegMesAct, $calculo->cDRutPorMesAct);
        $calculo->ratExitoTrim1 = $calculo->get_ratio_exito($calculo->ratNegTrim1, $calculo->cDRutPorTrim1);
        $calculo->ratExitoTrim2 = $calculo->get_ratio_exito($calculo->ratNegTrim2, $calculo->cDRutPorTrim2);
        $calculo->ratExitoTrim3 = $calculo->get_ratio_exito($calculo->ratNegTrim3, $calculo->cDRutPorTrim3);
        $calculo->ratExitoEst = $calculo->get_ratio_exito($calculo->ratNegEst, $calculo->cDRutPorEst);
        $calculo->ratExitoVar = $calculo->get_variacion_mes_anterior($calculo->ratExitoMesAct, $calculo->ratExitoTrim3);
        $calculo->ratExitoVarPor = $calculo->get_variacion_mes_anterior_por($calculo->ratExitoVar, $calculo->ratExitoTrim3);

        return view('panel.home', compact('calculo'));
    }

    public function filtrar_campana(Request $request){

        $request->validate(
            [
                'campana'=>[new ValidaSelect]
            ]
        );
        //echo $request->input("campana");
        return redirect()->route('panel_inicio', ['campanaId' => $request->input("campana")]);
    }

    public function get_panel($campanaId, $periodo){
        
        $panel = Panel::where('campana','=', $campanaId)
        ->where('periodo', '=', $periodo)
        ->orderBy('id', 'DESC')
        ->first();

        if($panel == null){
            $panelF = new Panel();
            $panelF->periodo= $periodo;
            $panelF->campana= $campanaId;
            $panelF->numero_cuentas= 0;
            $panelF->deuda_total= 0;
            $panelF->deuda_pagada= 0;
            $panelF->total_cd= 0;
            $panelF->total_ci= 0;
            $panelF->total_cr= 0;
            $panelF->total_sc= 0;
            $panelF->total_otro= 0;
            $panelF->total_cd_rut= 0;
            $panelF->total_ci_rut= 0;
            $panelF->total_cr_rut= 0;
            $panelF->total_sc_rut= 0;
            $panelF->total_otro_rut= 0;
            $panelF->sin_gestion= 0;
            $panelF->promesa_pago= 0;
            $panelF->promesa_cumplida= 0;
        }else{
            
            $panelF = new Panel();
            $panelF->periodo= $periodo;
            $panelF->campana= $campanaId;
            $panelF->numero_cuentas= $panel['numero_cuentas'] == null ? 0 : $panel['numero_cuentas'];
            $panelF->deuda_total= $panel['deuda_total'] == null ? 0 : $panel['deuda_total'];
            $panelF->deuda_pagada= $panel['deuda_pagada'] == null ? 0 : $panel['deuda_pagada'];
            $panelF->total_cd= $panel['total_cd'] == null ? 0 : $panel['total_cd'];
            $panelF->total_ci= $panel['total_ci'] == null ? 0 : $panel['total_ci'];
            $panelF->total_cr= $panel['total_cr'] == null ? 0 : $panel['total_cr'];
            $panelF->total_sc= $panel['total_sc'] == null ? 0 : $panel['total_sc'];
            $panelF->total_otro= $panel['total_otro'] == null ? 0 : $panel['total_otro'];
            $panelF->total_cd_rut= $panel['total_cd_rut'] == null ? 0 : $panel['total_cd_rut'];
            $panelF->total_ci_rut= $panel['total_ci_rut'] == null ? 0 : $panel['total_ci_rut'];
            $panelF->total_cr_rut= $panel['total_cr_rut'] == null ? 0 : $panel['total_cr_rut'];
            $panelF->total_sc_rut= $panel['total_sc_rut'] == null ? 0 : $panel['total_sc_rut'];
            $panelF->total_otro_rut= $panel['total_otro_rut'] == null ? 0 : $panel['total_otro_rut'];
            $panelF->sin_gestion= $panel['sin_gestion'] == null ? 0 : $panel['sin_gestion'];
            $panelF->promesa_pago= $panel['promesa_pago'] == null ? 0 : $panel['promesa_pago'];
            $panelF->promesa_cumplida= $panel['promesa_cumplida'] == null ? 0 : $panel['promesa_cumplida'];
        }
        
        return $panelF;
    }

}
