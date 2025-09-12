<?php
require '../../modelo/modelo_colegio.php';
$cole = new Colegio();

$idcolegio = htmlspecialchars($_POST['idcolegio'],ENT_QUOTES,'UTF-8');

//$logoImg  = htmlspecialchars($_POST['logoImg'],ENT_QUOTES,'UTF-8');
$NamelogoImg  = htmlspecialchars($_POST['NamelogoImg'],ENT_QUOTES,'UTF-8');

//$paisImg  = htmlspecialchars($_POST['paisImg'],ENT_QUOTES,'UTF-8');
$NamepaisImg  = htmlspecialchars($_POST['NamepaisImg'],ENT_QUOTES,'UTF-8');

//$bannerImg  = htmlspecialchars($_POST['bannerImg'],ENT_QUOTES,'UTF-8');
$NamebannImg  = htmlspecialchars($_POST['NamebannImg'],ENT_QUOTES,'UTF-8');

$colegioNombre  = htmlspecialchars($_POST['colegioNombre'],ENT_QUOTES,'UTF-8');
$colegioUbic  = htmlspecialchars($_POST['colegioUbic'],ENT_QUOTES,'UTF-8');
$colegioEmail  = htmlspecialchars($_POST['colegioEmail'],ENT_QUOTES,'UTF-8');
$ColegioTelefono  = htmlspecialchars($_POST['ColegioTelefono'],ENT_QUOTES,'UTF-8');
$ugel  = htmlspecialchars($_POST['ugel'],ENT_QUOTES,'UTF-8');



if ($idcolegio==null) {

   if(is_array($_FILES) && count($_FILES)>0){
       $Upl=move_uploaded_file($_FILES["logoImg"]["tmp_name"],"../../imagenes/".$NamelogoImg);
       $Upl=move_uploaded_file($_FILES["paisImg"]["tmp_name"],"../../imagenes/".$NamepaisImg);
       $Upl=move_uploaded_file($_FILES["bannerImg"]["tmp_name"],"../../imagenes/".$NamebannImg);
       $consulta= $cole->RegistrarDatosColegio($NamelogoImg,$NamepaisImg,$NamebannImg,$colegioNombre,$colegioUbic,$colegioEmail,$ColegioTelefono,$ugel);  

       echo $consulta;    
   }else{

   }

}else{



    if (!empty($_FILES["logoImg"])) {
        $phatlogo ="../../imagenes/".$NamelogoImg;
        if (file_exists($phatlogo)) {
           unlink($phatlogo);
       }

   }

   if (!empty($_FILES["escudoPais"])) {
    $phatpais ="../../imagenes/".$NamepaisImg;
    if (file_exists($phatpais)) {
     unlink($phatpais); 
 }

}
if (!empty($_FILES["bannerImg"])) {
    $phatbanner ="../../imagenes/".$NamebannImg;
    if (file_exists($phatbanner)) {
       unlink($phatbanner);
   }

}




if(is_array($_FILES) && count($_FILES)>0){

    if (!empty($_FILES["logoImg"])) {
      $Upl=move_uploaded_file($_FILES["logoImg"]["tmp_name"],"../../imagenes/".$NamelogoImg);
    }
    if (!empty($_FILES["paisImg"])) {
    $Upl=move_uploaded_file($_FILES["paisImg"]["tmp_name"],"../../imagenes/".$NamepaisImg);
    }
    if (!empty($_FILES["bannerImg"])) {
    $Upl=move_uploaded_file($_FILES["bannerImg"]["tmp_name"],"../../imagenes/".$NamebannImg);
    }
}

 $consulta= $cole->ActualizarDatosColegio($NamelogoImg,$NamepaisImg,$NamebannImg,$colegioNombre,$colegioUbic,$colegioEmail,$ColegioTelefono,$idcolegio,$ugel);  

 echo $consulta;

}
?>