<?php
    function ObtenerIP()
    {
      if (getenv("HTTP_CLIENT_IP") && strcasecmp(getenv("HTTP_CLIENT_IP"),"unknown"))
              $ip = getenv("HTTP_CLIENT_IP");
      else if (getenv("HTTP_X_FORWARDED_FOR") && strcasecmp(getenv("HTTP_X_FORWARDED_FOR"), "unknown"))
              $ip = getenv("HTTP_X_FORWARDED_FOR");
      else if (getenv("REMOTE_ADDR") && strcasecmp(getenv("REMOTE_ADDR"), "unknown"))
              $ip = getenv("REMOTE_ADDR");
      else if (isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] && strcasecmp($_SERVER['REMOTE_ADDR'], "unknown"))
              $ip = $_SERVER['REMOTE_ADDR'];
      else
              $ip = "IP desconocida";
      return($ip);
    }

    
    function Nombre_Mes($Numero_Mes)
    {
        $meses = array("nulo"               ,
                       "Enero"              ,
                       "Febrero"            ,
                       "Marzo"              ,
                       "Abril"              ,
                       "Mayo"               ,
                       "Junio"              ,
                       "Julio"              ,
                       "Agosto"             ,
                       "Septiembre"         ,
                       "Octubre"            ,
                       "Noviembre"          ,
                       "Diciembre"              ); 
        return $meses[$Numero_Mes];
    }
	function valida_rut($rut)
	{
    	$rut = preg_replace('/[^k0-9]/i', '', $rut);
    	$dv  = substr($rut, -1);
    	$numero = substr($rut, 0, strlen($rut)-1);
    	$i = 2;
    	$suma = 0;
    	foreach(array_reverse(str_split($numero)) as $v)
    	{
        	if($i==8)
            	$i = 2;
        		$suma += $v * $i;
        		++$i;
    	}
    	$dvr = 11 - ($suma % 11);
    
    	if($dvr == 11)
        	$dvr = 0;
    	if($dvr == 10)
        	$dvr = 'K';
    	if($dvr == strtoupper($dv)){
    		$resultado = "1";
        	return $resultado;
        }else {
    		$resultado = "2";
        	return $resultado;
        }
	}
    function conversorSegundosHoras($tiempo_en_segundos)
    {
        $horas      = floor($tiempo_en_segundos / 3600);
        $minutos    = floor(($tiempo_en_segundos - ($horas * 3600)) / 60);
        $segundos   = $tiempo_en_segundos - ($horas * 3600) - ($minutos * 60);
 
        $hora_texto = "";
        if ($horas > 0 ) {
            $hora_texto .= $horas . "h ";
        }
        if ($minutos > 0 ) {
            $hora_texto .= $minutos . "m ";
        }
        if ($segundos > 0 ) {
            $hora_texto .= $segundos . "s";
        }
        return $hora_texto;
    }
?>