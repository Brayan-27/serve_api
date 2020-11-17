<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept, Authorization, x-xsrf-token");
header("Content-Type: application/json; charset=UTF-8");

include "config.php";

$postjson = json_decode(file_get_contents('php://input'), true);
$today = date('Y-m-d H:i:s');

if($postjson['aksi'] == "proses_register") {

  $cekemail = mysqli_fetch_array(mysqli_query($mysqli, "SELECT email_address FROM tb_users WHERE email_address='$postjson[email_address]'"));

  if($cekemail['email_address']==$postjson['email_address']) {
    $result = json_encode(array('success'=>false, 'msg'=>'Email is already'));
  }else{

    $password = md5($postjson['password']);
    $insert = mysqli_query($mysqli, "INSERT INTO tb_users SET 
    your_name       = '$postjson[your_name]',
    gender          = '$postjson[gender]',
    date_birthday   = '$postjson[date_birth]',
    email_address   = '$postjson[email_address]',
    password        = '$password',
    created_at      = '$today'
    ");
    if($insert){
      $result = json_encode(array('success' =>true, 'msg'=>'Registro Exitoso'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Error al Registrar'));
    }
  } 
  echo $result;
}




elseif($postjson['aksi'] == "proses_login") {

  $password = md5($postjson['password']);
  $logindata = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM tb_users WHERE email_address='$postjson[email_address]' AND password='$password'")); 
  $data = array(
    'id_user'       => $logindata['id_user'],
    'your_name'       => $logindata['your_name'],
    'gender'          => $logindata['gender'],
    'date_birthday'   => $logindata['date_birthday'],
    'email_address'   => $logindata['email_address']
  );
  if($logindata){
    $result = json_encode(array('success' =>true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' =>false));
  }
  echo $result;
}


elseif($postjson['aksi'] == "load_users") {
  $data = array();

  $query = mysqli_query($mysqli, "SELECT * FROM tb_users ORDER BY id_user DESC LIMIT $postjson[start],$postjson[limit]");

  while ($rows = mysqli_fetch_array($query)){

    $data[] = array(
      'id_user'         =>$rows['id_user'],
      'your_name'       =>$rows['your_name'],
      'gender'          =>$rows['gender'],
      'date_birthday'   =>$rows['date_birthday'],
      'email_address'   =>$rows['email_address']
    );
  }
  
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}




elseif($postjson['aksi'] == "del_users") {
  
  $query = mysqli_query($mysqli, "DELETE FROM tb_users WHERE id_user='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}


elseif($postjson['aksi'] == "eliminar_PDA") {
  
  $query = mysqli_query($mysqli, "DELETE FROM pedidos_diario_altiplano WHERE id_PDA='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}


elseif($postjson['aksi'] == "eliminar_PDL") {
  
  $query = mysqli_query($mysqli, "DELETE FROM pedidos_diario_llano WHERE id_PDL='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}

elseif($postjson['aksi'] == "eliminar_PDV") {
  
  $query = mysqli_query($mysqli, "DELETE FROM pedidos_diario_valle WHERE id_PDV='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}


elseif($postjson['aksi'] == "eliminar_PSA") {
  
  $query = mysqli_query($mysqli, "DELETE FROM pedidos_semanal_altiplano WHERE id_PSA='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}


elseif($postjson['aksi'] == "eliminar_PSL") {
  
  $query = mysqli_query($mysqli, "DELETE FROM pedidos_semanal_llanos WHERE id_PSL='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}

elseif($postjson['aksi'] == "eliminar_PSV") {
  
  $query = mysqli_query($mysqli, "DELETE FROM pedidos_semanal_valle WHERE id_PSV='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}

elseif($postjson['aksi'] == "eliminar_MSA") {
  
  $query = mysqli_query($mysqli, "DELETE FROM tb_semanala WHERE id_a='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}

elseif($postjson['aksi'] == "eliminar_MSL") {
  
  $query = mysqli_query($mysqli, "DELETE FROM tb_semanall WHERE id_l='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}

elseif($postjson['aksi'] == "eliminar_MSV") {
  
  $query = mysqli_query($mysqli, "DELETE FROM tb_semanalv WHERE id_s='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}

elseif($postjson['aksi'] == "eliminar_DA") {
  
  $query = mysqli_query($mysqli, "DELETE FROM dato_diarioa WHERE id_DA='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}

elseif($postjson['aksi'] == "eliminar_DL") {
  
  $query = mysqli_query($mysqli, "DELETE FROM dato_diariol WHERE id_DL='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}

elseif($postjson['aksi'] == "eliminar_DV") {
  
  $query = mysqli_query($mysqli, "DELETE FROM dato_diariov WHERE id_DV='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}


elseif($postjson['aksi'] == "proses_crud") {

  $password = md5($postjson['password']);
  $cekpass = mysqli_fetch_array(mysqli_query($mysqli, "SELECT password FROM tb_users WHERE id_user = '$postjson[id]'"));

  if($postjson['password']==""){
    $password= $cekpass['password'];
  }else{
    $password= md5($postjson['password']);
  }
  if ($postjson['action']=='Create') {
    $cekemail = mysqli_fetch_array(mysqli_query($mysqli, "SELECT email_address FROM tb_users WHERE email_address='$postjson[email_address]'"));

    if($cekemail['email_address']==$postjson['email_address']) {
      $result = json_encode(array('success'=>false, 'msg'=>'Email is already'));
    }else{
  
      $insert = mysqli_query($mysqli, "INSERT INTO tb_users SET 
        your_name       = '$postjson[your_name]',
        gender          = '$postjson[gender]',
        date_birthday   = '$postjson[date_birth]',
        email_address   = '$postjson[email_address]',
        password        = '$password',
        created_at      = '$today'
      ");
      if($insert){
        $result = json_encode(array('success' =>true, 'msg'=>'Registro Exitoso'));
      }else{
        $result = json_encode(array('success' =>false, 'msg'=>'Error al Registrar'));
      }
    }
  } else{

    $updt = mysqli_query($mysqli, "UPDATE tb_users SET 
      your_name       = '$postjson[your_name]',
      gender          = '$postjson[gender]',
      date_birthday   = '$postjson[date_birth]',
      password        = '$password' WHERE id_user='$postjson[id]'
    ");
    if($updt){
      $result = json_encode(array('success' =>true, 'msg'=>'Modificación Exitosa'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Error al Modificar'));
    }
  }
  echo $result;
}



elseif($postjson['aksi'] == "load_single_data") {
  $query = mysqli_query($mysqli, "SELECT * FROM tb_users WHERE id_user = '$postjson[id]'");

  while ($rows = mysqli_fetch_array($query)){

    $data = array(
      'your_name'       =>$rows['your_name'],
      'gender'          =>$rows['gender'],
      'date_birthday'   =>$rows['date_birthday'],
      'email_address'   =>$rows['email_address']
    );
  }
  
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
  echo $result;
}




if($postjson['aksi'] == "proses_registeradmin") {

  $cekemail = mysqli_fetch_array(mysqli_query($mysqli, "SELECT usuarioadmin FROM tb_usersadmin WHERE usuarioadmin='$postjson[usuarioadmin]'"));

  if($cekemail['usuarioadmin']==$postjson['usuarioadmin']) {
    $result = json_encode(array('success'=>false, 'msg'=>'Email is already'));
  }else{

    $passadmin = md5($postjson['passadmin']);
    $insert = mysqli_query($mysqli, "INSERT INTO tb_usersadmin SET 
    usuarioadmin       = '$postjson[usuarioadmin]',
    passadmin        = '$passadmin',
    created_ata      = '$today'
    ");
    if($insert){
      $result = json_encode(array('success' =>true, 'msg'=>'Register successfuly'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Register error'));
    }
  } 
  echo $result;
}


elseif($postjson['aksi'] == "proses_loginadim") {

  $passadmin = md5($postjson['passadmin']);
  $logindata = mysqli_fetch_array(mysqli_query($mysqli, "SELECT * FROM tb_usersadmin WHERE usuarioadmin='$postjson[usuarioadmin]' AND passadmin='$passadmin'")); 
  $data = array(
    'id_usera'       => $logindata['id_usera'],
    'usuarioadmin'       => $logindata['usuarioadmin']
  );
  if($logindata){
    $result = json_encode(array('success' =>true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' =>false));
  }
  echo $result;
}

elseif($postjson['aksi'] == "load_usersadmin") {
  $data = array();

  $query = mysqli_query($mysqli, "SELECT * FROM tb_usersadmin ORDER BY id_usera DESC LIMIT $postjson[start],$postjson[limit]");

  while ($rows = mysqli_fetch_array($query)){

    $data[] = array(
      'id_usera'         =>$rows['id_usera'],
      'usuarioadmin'       =>$rows['usuarioadmin']
    );
  }
  
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}


elseif($postjson['aksi'] == "del_usersadmin") {
  
  $query = mysqli_query($mysqli, "DELETE FROM tb_usersadmin WHERE id_usera='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}


elseif($postjson['aksi'] == "del_productoA") {
  
  $query = mysqli_query($mysqli, "DELETE FROM productoa WHERE id_PA='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}


elseif($postjson['aksi'] == "del_productoV") {
  
  $query = mysqli_query($mysqli, "DELETE FROM productov WHERE id_PV='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}


elseif($postjson['aksi'] == "del_productoL") {
  
  $query = mysqli_query($mysqli, "DELETE FROM productol WHERE id_PL='$postjson[id]'");
  
  if($query){
    $result = json_encode(array('success' => true));
  }else{
    $result = json_encode(array('success' => false));
  }
   
  echo $result;
}







elseif($postjson['aksi'] == "load_single_dataPDA") {
  $query = mysqli_query($mysqli, "SELECT * FROM pedidos_diario_altiplano WHERE id_PDA = '$postjson[id]'");

  while ($rows = mysqli_fetch_array($query)){

    $data = array(
      'Des_de_alimnentos'       =>$rows['Des_de_alimnentos'],
      'Unidad_de_Media'          =>$rows['Unidad_de_Media'],
      'Gr_ML_Desayuno'   =>$rows['Gr_ML_Desayuno'],
      'Gr_ML_Sopa'   =>$rows['Gr_ML_Sopa'],
      'Gr_ML_Segundo'   =>$rows['Gr_ML_Segundo'],
      'Gr_ML_Cena'   =>$rows['Gr_ML_Cena']
    );
  }
  
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
  echo $result;
}


elseif($postjson['aksi'] == "load_single_dataPDL") {
  $query = mysqli_query($mysqli, "SELECT * FROM pedidos_diario_llano WHERE id_PDL = '$postjson[id]'");

  while ($rows = mysqli_fetch_array($query)){

    $data = array(
      'Des_de_alimnentos'       =>$rows['Des_de_alimnentos'],
      'Unidad_de_Media'          =>$rows['Unidad_de_Media'],
      'Gr_ML_Desayuno'   =>$rows['Gr_ML_Desayuno'],
      'Gr_ML_Sopa'   =>$rows['Gr_ML_Sopa'],
      'Gr_ML_Segundo'   =>$rows['Gr_ML_Segundo'],
      'Gr_ML_Cena'   =>$rows['Gr_ML_Cena']
    );
  }
  
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
  echo $result;
}


elseif($postjson['aksi'] == "load_single_dataPDV") {
  $query = mysqli_query($mysqli, "SELECT * FROM pedidos_diario_valle WHERE id_PDV = '$postjson[id]'");

  while ($rows = mysqli_fetch_array($query)){

    $data = array(
      'Des_de_alimnentos'       =>$rows['Des_de_alimnentos'],
      'Unidad_de_Media'          =>$rows['Unidad_de_Media'],
      'Gr_ML_Desayuno'   =>$rows['Gr_ML_Desayuno'],
      'Gr_ML_Sopa'   =>$rows['Gr_ML_Sopa'],
      'Gr_ML_Segundo'   =>$rows['Gr_ML_Segundo'],
      'Gr_ML_Cena'   =>$rows['Gr_ML_Cena']
    );
  }
  
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
  echo $result;
}

elseif($postjson['aksi'] == "load_single_dataMSA") {
  $query = mysqli_query($mysqli, "SELECT * FROM tb_semanala WHERE id_a = '$postjson[id]'");

  while ($rows = mysqli_fetch_array($query)){

    $data = array(
      'numsemana'       =>$rows['numsemana'],
      'descripcion'          =>$rows['descripcion'],
      'lunes'   =>$rows['lunes'],
      'martes'   =>$rows['martes'],
      'miercoles'   =>$rows['miercoles'],
      'jueves'   =>$rows['jueves'],
      'viernes'   =>$rows['viernes'],
      'sabado'   =>$rows['sabado'],
      'domingo'   =>$rows['domingo']
    );
  }
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
  echo $result;
}

elseif($postjson['aksi'] == "load_single_dataMSL") {
  $query = mysqli_query($mysqli, "SELECT * FROM tb_semanall WHERE id_l = '$postjson[id]'");

  while ($rows = mysqli_fetch_array($query)){

    $data = array(
      'numsemana'       =>$rows['numsemana'],
      'descripcion'          =>$rows['descripcion'],
      'lunes'   =>$rows['lunes'],
      'martes'   =>$rows['martes'],
      'miercoles'   =>$rows['miercoles'],
      'jueves'   =>$rows['jueves'],
      'viernes'   =>$rows['viernes'],
      'sabado'   =>$rows['sabado'],
      'domingo'   =>$rows['domingo']
    );
  }
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
  echo $result;
}


elseif($postjson['aksi'] == "load_single_dataMSV") {
  $query = mysqli_query($mysqli, "SELECT * FROM tb_semanalv WHERE id_s = '$postjson[id]'");

  while ($rows = mysqli_fetch_array($query)){

    $data = array(
      'numsemana'       =>$rows['numsemana'],
      'descripcion'          =>$rows['descripcion'],
      'lunes'   =>$rows['lunes'],
      'martes'   =>$rows['martes'],
      'miercoles'   =>$rows['miercoles'],
      'jueves'   =>$rows['jueves'],
      'viernes'   =>$rows['viernes'],
      'sabado'   =>$rows['sabado'],
      'domingo'   =>$rows['domingo']
    );
  }
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
  echo $result;
}


elseif($postjson['aksi'] == "load_single_dataPSA") {
  $query = mysqli_query($mysqli, "SELECT * FROM pedidos_semanal_altiplano WHERE id_PSA = '$postjson[id]'");

  while ($rows = mysqli_fetch_array($query)){

    $data = array(
      'Des_de_semana'       =>$rows['Des_de_semana'],
      'mes'          =>$rows['mes'],
      'lunes'   =>$rows['lunes'],
      'martes'   =>$rows['martes'],
      'miercoles'   =>$rows['miercoles'],
      'jueves'   =>$rows['jueves'],
      'viernes'   =>$rows['viernes'],
      'sabado'   =>$rows['sabado'],
      'domingo'   =>$rows['domingo']
    );
  }
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
  echo $result;
}


elseif($postjson['aksi'] == "load_single_dataPSV") {
  $query = mysqli_query($mysqli, "SELECT * FROM pedidos_semanal_valle WHERE id_PSV = '$postjson[id]'");

  while ($rows = mysqli_fetch_array($query)){

    $data = array(
      'Des_de_semana'       =>$rows['Des_de_semana'],
      'mes'          =>$rows['mes'],
      'lunes'   =>$rows['lunes'],
      'martes'   =>$rows['martes'],
      'miercoles'   =>$rows['miercoles'],
      'jueves'   =>$rows['jueves'],
      'viernes'   =>$rows['viernes'],
      'sabado'   =>$rows['sabado'],
      'domingo'   =>$rows['domingo']
    );
  }
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
  echo $result;
}


elseif($postjson['aksi'] == "load_single_dataPSL") {
  $query = mysqli_query($mysqli, "SELECT * FROM pedidos_semanal_llanos WHERE id_PSL = '$postjson[id]'");

  while ($rows = mysqli_fetch_array($query)){

    $data = array(
      'Des_de_semana'       =>$rows['Des_de_semana'],
      'mes'          =>$rows['mes'],
      'lunes'   =>$rows['lunes'],
      'martes'   =>$rows['martes'],
      'miercoles'   =>$rows['miercoles'],
      'jueves'   =>$rows['jueves'],
      'viernes'   =>$rows['viernes'],
      'sabado'   =>$rows['sabado'],
      'domingo'   =>$rows['domingo']
    );
  }
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
  echo $result;
}



elseif($postjson['aksi'] == "mod_crudPDA") {

  $updt = mysqli_query($mysqli, "UPDATE pedidos_diario_altiplano SET 
      Des_de_alimnentos       = '$postjson[Des_de_alimnentos]',
      Unidad_de_Media          = '$postjson[Unidad_de_Media]',
      Gr_ML_Desayuno   = '$postjson[Gr_ML_Desayuno]',
      Gr_ML_Sopa   = '$postjson[Gr_ML_Sopa]',
      Gr_ML_Segundo   = '$postjson[Gr_ML_Segundo]',
      Gr_ML_Cena       = '$postjson[Gr_ML_Cena]' WHERE id_PDA='$postjson[id]'
    ");
    if($updt){
      $result = json_encode(array('success' =>true, 'msg'=>'successfuly'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Proses error'));
    }
  echo $result;
}


elseif($postjson['aksi'] == "mod_crudPDV") {

  $updt = mysqli_query($mysqli, "UPDATE pedidos_diario_valle SET 
      Des_de_alimnentos       = '$postjson[Des_de_alimnentos]',
      Unidad_de_Media          = '$postjson[Unidad_de_Media]',
      Gr_ML_Desayuno   = '$postjson[Gr_ML_Desayuno]',
      Gr_ML_Sopa   = '$postjson[Gr_ML_Sopa]',
      Gr_ML_Segundo   = '$postjson[Gr_ML_Segundo]',
      Gr_ML_Cena       = '$postjson[Gr_ML_Cena]' WHERE id_PDV='$postjson[id]'
    ");
    if($updt){
      $result = json_encode(array('success' =>true, 'msg'=>'successfuly'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Proses error'));
    }
  echo $result;
}

elseif($postjson['aksi'] == "mod_crudPDL") {

  $updt = mysqli_query($mysqli, "UPDATE pedidos_diario_llano SET 
      Des_de_alimnentos       = '$postjson[Des_de_alimnentos]',
      Unidad_de_Media          = '$postjson[Unidad_de_Media]',
      Gr_ML_Desayuno   = '$postjson[Gr_ML_Desayuno]',
      Gr_ML_Sopa   = '$postjson[Gr_ML_Sopa]',
      Gr_ML_Segundo   = '$postjson[Gr_ML_Segundo]',
      Gr_ML_Cena       = '$postjson[Gr_ML_Cena]' WHERE id_PDL='$postjson[id]'
    ");
    if($updt){
      $result = json_encode(array('success' =>true, 'msg'=>'successfuly'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Proses error'));
    }
  echo $result;
}


elseif($postjson['aksi'] == "mod_crudMSA") {

  $updt = mysqli_query($mysqli, "UPDATE tb_semanala  SET 
      numsemana       = '$postjson[numsemana]',
      descripcion          = '$postjson[descripcion]',
      lunes   = '$postjson[lunes]',
      martes   = '$postjson[martes]',
      miercoles   = '$postjson[miercoles]',
      jueves   = '$postjson[jueves]',
      viernes   = '$postjson[viernes]',
      sabado   = '$postjson[sabado]',
      domingo       = '$postjson[domingo]' WHERE id_a='$postjson[id]'
    ");
    if($updt){
      $result = json_encode(array('success' =>true, 'msg'=>'successfuly'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Proses error'));
    }
  echo $result;
}


elseif($postjson['aksi'] == "mod_crudMSL") {

  $updt = mysqli_query($mysqli, "UPDATE tb_semanall  SET 
      numsemana       = '$postjson[numsemana]',
      descripcion          = '$postjson[descripcion]',
      lunes   = '$postjson[lunes]',
      martes   = '$postjson[martes]',
      miercoles   = '$postjson[miercoles]',
      jueves   = '$postjson[jueves]',
      viernes   = '$postjson[viernes]',
      sabado   = '$postjson[sabado]',
      domingo       = '$postjson[domingo]' WHERE id_l='$postjson[id]'
    ");
    if($updt){
      $result = json_encode(array('success' =>true, 'msg'=>'successfuly'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Proses error'));
    }
  echo $result;
}


elseif($postjson['aksi'] == "mod_crudMSV") {

  $updt = mysqli_query($mysqli, "UPDATE tb_semanalv  SET 
      numsemana       = '$postjson[numsemana]',
      descripcion          = '$postjson[descripcion]',
      lunes   = '$postjson[lunes]',
      martes   = '$postjson[martes]',
      miercoles   = '$postjson[miercoles]',
      jueves   = '$postjson[jueves]',
      viernes   = '$postjson[viernes]',
      sabado   = '$postjson[sabado]',
      domingo       = '$postjson[domingo]' WHERE id_s='$postjson[id]'
    ");
    if($updt){
      $result = json_encode(array('success' =>true, 'msg'=>'successfuly'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Proses error'));
    }
  echo $result;
}

elseif($postjson['aksi'] == "mod_crudPSA") {

  $updt = mysqli_query($mysqli, "UPDATE pedidos_semanal_altiplano  SET 
      Des_de_semana       = '$postjson[Des_de_semana]',
      mes          = '$postjson[mes]',
      lunes   = '$postjson[lunes]',
      martes   = '$postjson[martes]',
      miercoles   = '$postjson[miercoles]',
      jueves   = '$postjson[jueves]',
      viernes   = '$postjson[viernes]',
      sabado   = '$postjson[sabado]',
      domingo       = '$postjson[domingo]' WHERE id_PSA='$postjson[id]'
    ");
    if($updt){
      $result = json_encode(array('success' =>true, 'msg'=>'successfuly'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Proses error'));
    }
  echo $result;
}




elseif($postjson['aksi'] == "mod_crudPSL") {

  $updt = mysqli_query($mysqli, "UPDATE pedidos_semanal_llanos  SET 
      Des_de_semana       = '$postjson[Des_de_semana]',
      mes          = '$postjson[mes]',
      lunes   = '$postjson[lunes]',
      martes   = '$postjson[martes]',
      miercoles   = '$postjson[miercoles]',
      jueves   = '$postjson[jueves]',
      viernes   = '$postjson[viernes]',
      sabado   = '$postjson[sabado]',
      domingo       = '$postjson[domingo]' WHERE id_PSL='$postjson[id]'
    ");
    if($updt){
      $result = json_encode(array('success' =>true, 'msg'=>'successfuly'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Proses error'));
    }
  echo $result;
}



elseif($postjson['aksi'] == "mod_crudPSV") {

  $updt = mysqli_query($mysqli, "UPDATE pedidos_semanal_valle  SET 
      Des_de_semana       = '$postjson[Des_de_semana]',
      mes          = '$postjson[mes]',
      lunes   = '$postjson[lunes]',
      martes   = '$postjson[martes]',
      miercoles   = '$postjson[miercoles]',
      jueves   = '$postjson[jueves]',
      viernes   = '$postjson[viernes]',
      sabado   = '$postjson[sabado]',
      domingo       = '$postjson[domingo]' WHERE id_PSV='$postjson[id]'
    ");
    if($updt){
      $result = json_encode(array('success' =>true, 'msg'=>'successfuly'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Proses error'));
    }
  echo $result;
}



elseif($postjson['aksi'] == "mod_crudPA") {

  $updt = mysqli_query($mysqli, "UPDATE productoa  SET 
      tipo       = '$postjson[tipo]',
      nombreali       = '$postjson[nombreali]',
      cantidad_pro       = '$postjson[cantidad_pro]',
      cantidad_min       = '$postjson[cantidad_min]',
      cantidad_med       = '$postjson[cantidad_med]',
      cantidad_max       = '$postjson[cantidad_max]' WHERE id_PA='$postjson[id]'
    ");
    if($updt){
      $result = json_encode(array('success' =>true, 'msg'=>'successfuly'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Proses error'));
    }
  echo $result;
}

elseif($postjson['aksi'] == "mod_crudPV") {

  $updt = mysqli_query($mysqli, "UPDATE productov  SET 
      tipo       = '$postjson[tipo]',
      nombreali       = '$postjson[nombreali]',
      cantidad_pro       = '$postjson[cantidad_pro]',
      cantidad_min       = '$postjson[cantidad_min]',
      cantidad_med       = '$postjson[cantidad_med]',
      cantidad_max       = '$postjson[cantidad_max]' WHERE id_PV='$postjson[id]'
    ");
    if($updt){
      $result = json_encode(array('success' =>true, 'msg'=>'successfuly'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Proses error'));
    }
  echo $result;
}


elseif($postjson['aksi'] == "mod_crudPL") {

  $updt = mysqli_query($mysqli, "UPDATE productol  SET 
      tipo       = '$postjson[tipo]',
      nombreali       = '$postjson[nombreali]',
      cantidad_pro       = '$postjson[cantidad_pro]',
      cantidad_min       = '$postjson[cantidad_min]',
      cantidad_med       = '$postjson[cantidad_med]',
      cantidad_max       = '$postjson[cantidad_max]' WHERE id_PL='$postjson[id]'
    ");
    if($updt){
      $result = json_encode(array('success' =>true, 'msg'=>'successfuly'));
    }else{
      $result = json_encode(array('success' =>false, 'msg'=>'Proses error'));
    }
  echo $result;
}


elseif($postjson['aksi'] == "load_single_dataPA") {
  $query = mysqli_query($mysqli, "SELECT * FROM productoa WHERE id_PA = '$postjson[id]'");

  while ($rows = mysqli_fetch_array($query)){

    $data = array(
      'tipo'       =>$rows['tipo'],
      'nombreali'          =>$rows['nombreali'],
      'cantidad_pro'          =>$rows['cantidad_pro'],   
      'cantidad_min'          =>$rows['cantidad_min'],   
      'cantidad_med'          =>$rows['cantidad_med'],
      'cantidad_max'          =>$rows['cantidad_max'],       
    );
  }
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
  echo $result;
}



elseif($postjson['aksi'] == "load_single_dataPV") {
  $query = mysqli_query($mysqli, "SELECT * FROM productov WHERE id_PV = '$postjson[id]'");

  while ($rows = mysqli_fetch_array($query)){

    $data = array(
      'tipo'       =>$rows['tipo'],
      'nombreali'          =>$rows['nombreali'],
      'cantidad_pro'          =>$rows['cantidad_pro'],   
      'cantidad_min'          =>$rows['cantidad_min'],   
      'cantidad_med'          =>$rows['cantidad_med'],
      'cantidad_max'          =>$rows['cantidad_max'],         
    );
  }
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
  echo $result;
}


elseif($postjson['aksi'] == "load_single_dataPL") {
  $query = mysqli_query($mysqli, "SELECT * FROM productol WHERE id_PL = '$postjson[id]'");

  while ($rows = mysqli_fetch_array($query)){

    $data = array(
      'tipo'       =>$rows['tipo'],
      'nombreali'          =>$rows['nombreali'],
      'cantidad_pro'          =>$rows['cantidad_pro'],   
      'cantidad_min'          =>$rows['cantidad_min'],   
      'cantidad_med'          =>$rows['cantidad_med'],
      'cantidad_max'          =>$rows['cantidad_max'],          
    );
  }
  if($query){
    $result = json_encode(array('success' => true, 'result'=>$data));
  }else{
    $result = json_encode(array('success' => false));
  }
  echo $result;
}






?>

