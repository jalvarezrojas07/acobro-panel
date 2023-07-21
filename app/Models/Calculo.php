<?php

namespace App\Models;
use DB;

class Calculo{

    public string $campanaId;
    public array $campanas;
    public string $mesActual;
    public string $mesTrimestre1;
    public string $mesTrimestre2;
    public string $mesTrimestre3;
    public string $mesEstacional;
    public array $codigosCD;
    public array $codigosCI;
    public array $codigosGR;
    public array $codigosSC;

    /* #1 - Total cuentas mororsas */
    public int $opTotalMesAct;
    public int $opTotalTrim1;
    public int $opTotalTrim2;
    public int $opTotalTrim3;
    public int $opTotalEst;
    public int $opTotalVar;
    public float $opTotalVarPor;

    /* #2 - MM$ DEUDA */
    public int $deudaTotalMesAct;
    public int $deudaTotalTrim1;
    public int $deudaTotalTrim2;
    public int $deudaTotalTrim3;
    public int $deudaTotalEst;
    public int $deudaTotalVar;
    public float $deudaTotalVarPor;

    /* #3 - MM$ RECUPERO */
    public int $deudaPagadaMesAct;
    public int $deudaPagadaTrim1;
    public int $deudaPagadaTrim2;
    public int $deudaPagadaTrim3;
    public int $deudaPagadaEst;
    public int $deudaPagadaVar;
    public float $deudaPagadaVarPor;

    /* #4 - PRODUCTIVIDAD */
    public float $productividadMesAct;
    public float $productividadTrim1;
    public float $productividadTrim2;
    public float $productividadTrim3;
    public float $productividadEst;
    public float $productividadVar;
    public float $productividadVarPor;

    /* #5 - INTENSIDAD CARTERA */
    public float $intCarMesAct;
    public float $intCarTrim1;
    public float $intCarTrim2;
    public float $intCarTrim3;
    public float $intCarEst;
    public float $intCarVar;
    public float $intCarVarPor;

    /* #6 - TOTAL GESTIONES*/
    public int $totalGesMesAct;
    public int $totalGesTrim1;
    public int $totalGesTrim2;
    public int $totalGesTrim3;
    public int $totalGesEst;
    public int $totalGesVar;
    public float $totalGesVarPor;

    /* #7 - # TOTAL CD */
    public int $totalCDMesAct;
    public int $totalCDTrim1;
    public int $totalCDTrim2;
    public int $totalCDTrim3;
    public int $totalCDEst;
    public int $totalCDVar;
    public float $totalCDVarPor;

    /* #8 -TOTAL CI */
    public int $totalCIMesAct;
    public int $totalCITrim1;
    public int $totalCITrim2;
    public int $totalCITrim3;
    public int $totalCIEst;
    public int $totalCIVar;
    public float $totalCIVarPor;

    /* #9 -TOTAL CR */
    public int $totalCRMesAct;
    public int $totalCRTrim1;
    public int $totalCRTrim2;
    public int $totalCRTrim3;
    public int $totalCREst;
    public int $totalCRVar;
    public float $totalCRVarPor;

    /* #10 - TOTAL SC */
    public int $totalSCMesAct;
    public int $totalSCTrim1;
    public int $totalSCTrim2;
    public int $totalSCTrim3;
    public int $totalSCEst;
    public int $totalSCVar;
    public float $totalSCVarPor;

    /* #11 - TOTAL OTRO */
    public int $otrosConMesAct;
    public int $otrosConTrim1;
    public int $otrosConTrim2;
    public int $otrosConTrim3;
    public int $otrosConEst;
    public int $otrosConVar;
    public float $otrosConVarPor;

    /* #12 - # GESTIONADAS */
    public int $totalGesRutMesAct;
    public int $totalGesRutTrim1;
    public int $totalGesRutTrim2;
    public int $totalGesRutTrim3;
    public int $totalGesRutEst;
    public int $totalGesRutVar;
    public float $totalGesRutVarPor;

    /* #13 - # CONTACTO_DIRECTO */
    public int $conDirRutMesAct;
    public int $conDirRutTrim1;
    public int $conDirRutTrim2;
    public int $conDirRutTrim3;
    public int $conDirRutEst;
    public int $conDirRutVar;
    public float $conDirRutVarPor;

    /* #14 - # CONTACTO_INDIRECTO */
    public int $conIndRutMesAct;
    public int $conIndRutTrim1;
    public int $conIndRutTrim2;
    public int $conIndRutTrim3;
    public int $conIndRutEst;
    public int $conIndRutVar;
    public float $conIndRutVarPor;

    /* #15 - # CANAL_REMOTO*/
    public int $canRemRutMesAct;
    public int $canRemRutTrim1;
    public int $canRemRutTrim2;
    public int $canRemRutTrim3;
    public int $canRemRutEst;
    public int $canRemRutVar;
    public float $canRemRutVarPor;

    /* #16 - # SIN_CONTACTO */
    public int $sinConRutMesAct;
    public int $sinConRutTrim1;
    public int $sinConRutTrim2;
    public int $sinConRutTrim3;
    public int $sinConRutEst;
    public int $sinConRutVar;
    public float $sinConRutVarPor;

    /* #17 - # OTRO */
    public int $otrosConRutMesAct;
    public int $otrosConRutTrim1;
    public int $otrosConRutTrim2;
    public int $otrosConRutTrim3;
    public int $otrosConRutEst;
    public int $otrosConRutVar;
    public float $otrosConRutVarPor;

    /* #18 - # SIN_GESTION */
    public int $SinGesRutMesAct;
    public int $SinGesRutTrim1;
    public int $SinGesRutTrim2;
    public int $SinGesRutTrim3;
    public int $SinGesRutEst;
    public int $SinGesRutVar;
    public float $SinGesRutVarPor;

    /* #19 - % CD */
    public float $cDRutPorMesAct;
    public float $cDRutPorTrim1;
    public float $cDRutPorTrim2;
    public float $cDRutPorTrim3;
    public float $cDRutPorEst;
    public float $cDRutPorVar;
    public float $cDRutPorVarPor;

    /* #20 - % CI */
    public float $cIRutPorMesAct;
    public float $cIRutPorTrim1;
    public float $cIRutPorTrim2;
    public float $cIRutPorTrim3;
    public float $cIRutPorEst;
    public float $cIRutPorVar;
    public float $cIRutPorVarPor;

    /* #21 - % CR */
    public float $cRRutPorMesAct;
    public float $cRRutPorTrim1;
    public float $cRRutPorTrim2;
    public float $cRRutPorTrim3;
    public float $cRRutPorEst;
    public float $cRRutPorVar;
    public float $cRRutPorVarPor;

    /* #22 - % SC */
    public float $sCRutPorMesAct;
    public float $sCRutPorTrim1;
    public float $sCRutPorTrim2;
    public float $sCRutPorTrim3;
    public float $sCRutPorEst;
    public float $sCRutPorVar;
    public float $sCRutPorVarPor;

    /* #23 - % OTRO */
    public float $otroConRutPorMesAct;
    public float $otroConRutPorTrim1;
    public float $otroConRutPorTrim2;
    public float $otroConRutPorTrim3;
    public float $otroConRutPorEst;
    public float $otroConRutPorVar;
    public float $otroConRutPorVarPor;

    /* #24 - % SG */
    public float $sinGesRutPorMesAct;
    public float $sinGesRutPorTrim1;
    public float $sinGesRutPorTrim2;
    public float $sinGesRutPorTrim3;
    public float $sinGesRutPorEst;
    public float $sinGesRutPorVar;
    public float $sinGesRutPorVarPor;

    /* #25 - # PROMESA_PAGO */
    public int $promRutMesAct;
    public int $promRutTrim1;
    public int $promRutTrim2;
    public int $promRutTrim3;
    public int $promRutEst;
    public int $promRutVar;
    public float $promRutVarPor;

    /* #26 - % PP */
    public float $promRutPorMesAct;
    public float $promRutPorTrim1;
    public float $promRutPorTrim2;
    public float $promRutPorTrim3;
    public float $promRutPorEst;
    public float $promRutPorVar;
    public float $promRutPorVarPor;

    /* #27 - # PROMESA CUMPLIDA */
    public int $promCumRutMesAct;
    public int $promCumRutTrim1;
    public int $promCumRutTrim2;
    public int $promCumRutTrim3;
    public int $promCumRutEst;
    public int $promCumRutVar;
    public float $promCumRutVarPor;

    /* #28 - % PROMESA CUMPLIDA */
    public float $promCumRutPorMesAct;
    public float $promCumRutPorTrim1;
    public float $promCumRutPorTrim2;
    public float $promCumRutPorTrim3;
    public float $promCumRutPorEst;
    public float $promCumRutPorVar;
    public float $promCumRutPorVarPor;

    /* #29 - RATIO_NEGOCIACION */
    public float $ratNegMesAct;
    public float $ratNegTrim1;
    public float $ratNegTrim2;
    public float $ratNegTrim3;
    public float $ratNegEst;
    public float $ratNegVar;
    public float $ratNegVarPor;

    /* #30 - RATIO_EXITO */
    public float $ratExitoMesAct;
    public float $ratExitoTrim1;
    public float $ratExitoTrim2;
    public float $ratExitoTrim3;
    public float $ratExitoEst;
    public float $ratExitoVar;
    public float $ratExitoVarPor;

    public function get_variacion_mes_anterior($mesActual, $trimestre3){
        return ($mesActual - $trimestre3);
    }

    public function get_variacion_mes_anterior_por($variacion, $trimestre3){
        return $trimestre3 == 0 ? 0 : round((($variacion / $trimestre3) * 100), 2);
    }

    /* #4 - PRODUCTIVIDAD */
    public function get_productividad($deudaPagadaMes, $deudaTotalMes){
        return $deudaTotalMes == 0 ? 0 : number_format((($deudaPagadaMes*100)/$deudaTotalMes), 2);
    }

    /* #5 - INTENSIDAD CARTERA */
    public function get_intensidad_cartera($totalGesRutMes, $totalGesMes){
        return $totalGesMes == 0 ? 0 : round(($totalGesRutMes/$totalGesMes), 1);
    }

    /* #6 - TOTAL GESTIONES*/
    public function get_total_gestionado(
        $totalCDMesAct,
        $totalCIMesAct,
        $totalCRMesAct,
        $totalSCMesAct,
        $otrosContactosMesAct
    ){
        return ($totalCDMesAct + $totalCIMesAct + $totalCRMesAct + $totalSCMesAct + $otrosContactosMesAct);
    }

    /* #12 - # GESTIONADAS */
    public function get_total_gestionado_rut(
        $conDirRutMes,
        $conIndRutMes,
        $canRemRutMes,
        $sinConRutMes,
        $otrosConRutMes
    ){
        return ($conDirRutMes + $conIndRutMes + $canRemRutMes + $sinConRutMes + $otrosConRutMes);
    }
 
    /* #19 - % CD */
    public function get_contacto_directo_rut_procentaje($conDirMes, $totalGesRutMes){
        return $totalGesRutMes == 0 ? 0 : round((($conDirMes*100)/$totalGesRutMes), 1);
    }

    /* #20 - % CI */
    public function get_contacto_indirecto_rut_procentaje($conIndRutMes, $totalGesRutMes){
        return $totalGesRutMes == 0 ? 0 : round((($conIndRutMes*100)/$totalGesRutMes), 1);
    }

    /* #21 - % CR */
    public function get_canal_remoto_rut_procentaje($canRemRutMes, $totalGesRutMes){
        return $totalGesRutMes == 0 ? 0 : round((($canRemRutMes*100)/$totalGesRutMes), 1);
    }

    /* #22 - % SC */
    public function get_sin_contacto_rut_procentaje($sinConRutMes, $totalGesRutMes){
        return $totalGesRutMes == 0 ? 0 : round((($sinConRutMes*100)/$totalGesRutMes), 1);
    }

    /* #23 - % OTRO */
    public function get_otro_contacto_rut_procentaje($otrosConRutMes, $totalGesRutMes){
        return $totalGesRutMes == 0 ? 0 : round((($otrosConRutMes*100)/$totalGesRutMes), 1);
    }

    /* #24 - % SG */
    public function get_sin_gestion_rut_procentaje($rutSinGesMes, $opTotalMes){
        return $opTotalMes == 0 ? 0 : round((($rutSinGesMes*100)/$opTotalMes), 1);
    }

    /* #26 - % PP */
    public function get_promesas_rut_porcentaje($promesasMes, $opeTotalMes){
        return $opeTotalMes == 0 ? 0 : round((($promesasMes*100)/$opeTotalMes), 1);
    }

    /* #28 - % PROMESA CUMPLIDA */
    public function get_promesas_cumplidas_rut_porcentaje($proCumRutMes, $proRutMes){
        return $proRutMes == 0 ? 0 : round((($proCumRutMes*100)/$proRutMes), 1);
    }

    /* #29 - RATIO_NEGOCIACION */
    public function get_ratio_negociacion($proCumRutPorMes, $proRutPorMes){
        return $proRutPorMes == 0 ? 0 : round(($proCumRutPorMes/$proRutPorMes), 1);
    }

    /* #30 - RATIO_EXITO */
    public function get_ratio_exito($ratNeg, $cDRutPorMes){
        return $cDRutPorMes == 0 ? 0 : round(($ratNeg/$cDRutPorMes), 1);
    }
}

