
<?php
ob_start();
 require_once("../../Paginacion/Logeo.php")                 ;
 require_once("../../Clases/ClaseInformes.php")    ;
 require_once("../../Clases/ClaseFpdf.php")    ;
class PDF extends FPDF
{
    function Header()
    {

    global $HC_id               ; global $HC_Numero_Hoja    ; global $HC_Sector_Id        ;    global $HC_Fecha_Entrega;
    global $HC_Fecha_Devolucion ; global $HC_Fecha_Generada ; global $HC_Usuario_Asignada ;    global $HC_Consulta_Id;
    global $HD_id               ; global $HD_Hoja_Cabeza_Id ; global $HD_Item             ;    global $HD_Persona_Id;
    global $RE_Respuesta_Corta  ; global $HD_Respuesta_Id   ; global $HD_Fecha_Visita     ;    global $HD_Usuario_Id;
    global $US_Nombre           ; global $US_Apellido       ; global $HD_Observacion      ;    global $HD_Atencion_Id;
    global $PE_id               ; global $PE_Rut            ; global $PE_Nombre           ;    global $PE_Apellido;
    global $PE_Telefono         ; global $DI_id             ; global $DI_Unidad_Id        ;    global $UN_Unidad;
    global $UN_Sector_Id        ; global $SE_Sector         ; global $DI_Poblacion_Id     ;    global $PO_Poblacion;
    global $DI_Calle_Id         ; global $CA_Calle          ; global $DI_Numero           ;    global $DI_Block;
    global $DI_Departamento     ; global $DI_Casa           ; global $DI_Observacion;
    global $Movimiento          ; global $encuestador       ; global $numero_hoja         ; global $sector              ;
    global $consulta            ; global $Numero_Hoja_Paso  ; global $Pagina              ;
    global $Numero_Hoja         ;
    $titulo = '                                Registro Social de Hogares Hoja de Respuesta ';
    $fecha_hoy = date("Y-m-d");
    $subtitulo = "Encuestador    :".$encuestador;
    $subtitulo2 = "Num. Hoja Ruta :".$Numero_Hoja;
    $resultados = "Resultados Encuestas";
    $this->Image('../../img/logo.jpg',10,8,20);
    $this->SetFont('Arial','B',10); 
    $this->SetMargins( 10, 10) ;
    $this->Cell(0,1,$titulo,0,1,'L')     ;
    $this->ln(3);    
    $this->ln(1);
    $this->Cell(15,5,'Totales',1,0,'C')  ;        $this->Cell(10,5,'E',1,0,'C')        ;
    $this->Cell(10,5,'P1',1,0,'C')       ;        $this->Cell(10,5,'P2',1,0,'C')       ;
    $this->Cell(10,5,'P3',1,0,'C')       ;        $this->Cell(10,5,'P4',1,0,'C')       ;
    $this->Cell(10,5,'P5',1,0,'C')       ;        $this->Cell(10,5,'P6',1,0,'C')       ;
    $this->Cell(10,5,'P7',1,0,'C')       ;        $this->Cell(10,5,'P8',1,0,'C')       ;
    $this->Cell(10,5,'P9',1,0,'C')       ;        $this->Cell(10,5,'X',1,0,'C')        ;
    $this->Cell(30,5,'Encuestador',1,0,'C') ;     $this->Cell(50,5,$US_Nombre.' '.$US_Apellido,1,1,'C'); 
    $this->Cell(15,5,'',1,0,'C')         ;        $this->Cell(10,5,'',1,0,'C')         ;
    $this->Cell(10,5,'',1,0,'C')         ;        $this->Cell(10,5,'',1,0,'C')         ;
    $this->Cell(10,5,'',1,0,'C')         ;        $this->Cell(10,5,'',1,0,'C')         ;
    $this->Cell(10,5,'',1,0,'C')         ;        $this->Cell(10,5,'',1,0,'C')         ;
    $this->Cell(10,5,'',1,0,'C')         ;        $this->Cell(10,5,'',1,0,'C')         ;
    $this->Cell(10,5,'',1,0,'C')         ;        $this->Cell(10,5,'',1,0,'C')         ;
    $this->Cell(30,5,'Numero Hoja',1,0,'C');        $this->SetFont('Arial','B',16); 
    $this->Cell(50,5,$HC_Numero_Hoja,1,0,'C'); 
    $descripcion = '';
    if ($Movimiento == '10') { $descripcion = "Ingreso al Registro" ; }
    if ($Movimiento == '4')  { $descripcion = "Cambio de Domicilio" ; }
    if ($Movimiento == '14') { $descripcion = "Modulo de Vivienda" ; }
    $this->SetFont('Arial','B',10); 
    $this->Cell(70,5,$descripcion,1,1,'C'); 
    $this->SetFont('Arial','B',10); 
    $this->Cell(125,5,'',0,0,'C'); 
    $this->Cell(30,5,'Sector',1,0,'C');
    $this->SetFont('Arial','B',12); 
    $this->Cell(50,5,$SE_Sector,1,1,'C'); 
    $this->SetFont('Arial','B',8); 
    $this->Cell(125,5,'',0,0,'C'); 
    $this->Cell(30,5,'Fecha Emision',1,0,'C');
    $this->SetFont('Arial','B',12); 
    $this->Cell(50,5,$HC_Fecha_Generada,1,1,'C'); 
    $this->SetFont('Arial','B',8); 
    $this->ln(3);    
    $this->Cell(10,4,'#',1,0,'C'); 
    $this->Cell(10,4,'Soli.',1,0,'C'); 
    $this->Cell(35,4,'Nombres',1,0,'C');
    $this->Cell(20,4,'Rut',1,0,'C');
    $this->Cell(35,4,'Poblacion',1,0,'C');
    $this->Cell(55,4,'Calle',1,0,'C');
    $this->Cell(35,4,'Numero',1,0,'C');
    $this->Cell(35,4,'Telefono',1,0,'C');
    $this->Cell(15,4,'Res  Fec',1,0,'C');
    $this->Cell(15,4,'Res  Fec',1,0,'C');
    $this->Cell(15,4,'Res  Fec',1,1,'C');
        
    }
}
// Pie de página
function Footer()
{
    $this->SetY(-15);
    $this->SetFont('Arial','I',10);
}
$pdf = new PDF('L','mm','Legal');
$pdf->AddPage();
$pdf->AliasNbPages();
$pdf->SetFont('Arial','',8);
$pdf->SetTextColor(0x00,0x00,0x00);
$fecha_actual=strftime( "%Y-%m-%d", time() );
$Fecha_Generada = $_GET["Fecha_Generada"] ; $Movimiento = $_GET["Movimiento"];
$Numero_Hoja_Paso   =  0   ;
$Pagina             =  0   ;
$Numero_Hoja        =  0   ;
$hojas = new Informes();
$datos_hojas=$hojas->Get_Hojas_de_Ruta( $Fecha_Generada, $Movimiento );
for($i=0;$i<sizeof($datos_hojas);$i++)
{ 
    $HC_id                =   $datos_hojas[$i]["HC_id"]              ;    $HC_Numero_Hoja            =   $datos_hojas[$i]["HC_Numero_Hoja"];
    $HC_Sector_Id         =   $datos_hojas[$i]["HC_Sector_Id"]       ;    $HC_Fecha_Entrega          =   $datos_hojas[$i]["HC_Fecha_Entrega"];
    $HC_Fecha_Devolucion  =   $datos_hojas[$i]["HC_Fecha_Devolucion"];    $HC_Fecha_Generada         =   $datos_hojas[$i]["HC_Fecha_Generada"];
    $HC_Usuario_Asignada  =   $datos_hojas[$i]["HC_Usuario_Asignada"];    $HC_Consulta_Id            =   $datos_hojas[$i]["HC_Consulta_Id"];
    $HD_id                =   $datos_hojas[$i]["HD_id"]              ;    $HD_Hoja_Cabeza_Id         =   $datos_hojas[$i]["HD_Hoja_Cabeza_Id"];
    $HD_Item              =   $datos_hojas[$i]["HD_Item"]            ;    $HD_Persona_Id             =   $datos_hojas[$i]["HD_Persona_Id"];
    $RE_Respuesta_Corta   =   $datos_hojas[$i]["RE_Respuesta_Corta"] ;    $HD_Respuesta_Id           =   $datos_hojas[$i]["HD_Respuesta_Id"];
    $HD_Fecha_Visita      =   $datos_hojas[$i]["HD_Fecha_Visita"]    ;    $HD_Usuario_Id             =   $datos_hojas[$i]["HD_Usuario_Id"];
    $US_Nombre            =   $datos_hojas[$i]["US_Nombre"]          ;    $US_Apellido               =   $datos_hojas[$i]["US_Apellido"];
    $HD_Observacion       =   $datos_hojas[$i]["HD_Observacion"]     ;    $HD_Atencion_Id            =   $datos_hojas[$i]["HD_Atencion_Id"];
    $PE_id                =   $datos_hojas[$i]["PE_id"]              ;    $PE_Rut                    =   $datos_hojas[$i]["PE_Rut"];
    $PE_Nombre            =   $datos_hojas[$i]["PE_Nombre"]          ;    $PE_Apellido               =   $datos_hojas[$i]["PE_Apellido"];
    $PE_Telefono          =   $datos_hojas[$i]["PE_Telefono"]        ;    $DI_id                     =   $datos_hojas[$i]["DI_id"];
    $DI_Unidad_Id         =   $datos_hojas[$i]["DI_Unidad_Id"]       ;    $UN_Unidad                 =   $datos_hojas[$i]["UN_Unidad"];
    $UN_Sector_Id         =   $datos_hojas[$i]["UN_Sector_Id"]       ;    $SE_Sector                 =   $datos_hojas[$i]["SE_Sector"];
    $DI_Poblacion_Id      =   $datos_hojas[$i]["DI_Poblacion_Id"]    ;    $PO_Poblacion              =   $datos_hojas[$i]["PO_Poblacion"];
    $DI_Calle_Id          =   $datos_hojas[$i]["DI_Calle_Id"]        ;    $CA_Calle                  =   $datos_hojas[$i]["CA_Calle"];
    $DI_Numero            =   $datos_hojas[$i]["DI_Numero"]          ;    $DI_Block                  =   $datos_hojas[$i]["DI_Block"];
    $DI_Departamento      =   $datos_hojas[$i]["DI_Departamento"]    ;    $DI_Casa                   =   $datos_hojas[$i]["DI_Casa"];
    $DI_Observacion       =   $datos_hojas[$i]["DI_Observacion"]     ;
    
    if ( $HC_Numero_Hoja == $Numero_Hoja_Paso) 
    {   
    } 
    else 
    {
       $pdf->AddPage();
       $Pagina++;
       $Numero_Hoja = $HC_Numero_Hoja;
       $Numero_Hoja_Paso = $HC_Numero_Hoja;
    }


    $pdf->Cell(10,8,$HD_Item,1,0,'L'); 
    $pdf->Cell(10,8,"-",1,0,'L'); 
    $pdf->Cell(35,8,$PE_Nombre.' '.$PE_Apellido,1,0,'L');
    $pdf->Cell(20,8,$PE_Rut,1,0,'R');
    $pdf->Cell(35,8,$PO_Poblacion,1,0,'L');
    $pdf->Cell(55,8,$CA_Calle,1,0,'L');
    $pdf->Cell(35,8,$DI_Numero,1,0,'L');
    $pdf->Cell(35,8,$PE_Telefono,1,0,'L');
    
    $pdf->Cell(15,8,'',1,0,'L');
    $pdf->Cell(15,8,'',1,0,'L');
    $pdf->Cell(15,8,'',1,0,'L');
    $pdf->Ln(); //Hacer el salto de linea para la siguiente fila del registro
}
$pdf->Output('report','I');
?>
