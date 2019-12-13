
<?php
class Utils{
  public static function isUser(){

    if (!isset($_SESSION['user'])) {

      header("location:".BASE_URL."principal/disconnect");
    }

    return true;
  }//fin class isUser()


  public static function isAdmin(){

    if (!isset($_SESSION['admin'])) {

      header("location:".BASE_URL."principal/disconnect");
    }

    return true;
  }


  public static function deleteSession($session){
    $result = false;
    if(isset($_SESSION[$session])){
      $_SESSION[$session] = null;
      unset($session);
      $result = true;
    }
    return $result;
  }//fin function deleteSession

  public static function saveImage($imagen){

    $result = false;

     if (isset($imagen)) {

       //el nombre de el archivos
       $filename = $imagen['name'];

       //el tipo de archivo,la extension png....
       $mimetype = $imagen['type'];

       //la locacion temporal de el archivo
       $tempfile=$imagen['tmp_name'];

       if ($mimetype == 'image/jpeg' || $mimetype == 'image/jpg' || $mimetype == 'image/png'|| $mimetype == 'image/gif') {

         if (!is_dir('images')) {

           mkdir('images',0007,true);
         }

         move_uploaded_file($tempfile,'images/'.$filename);

         $result = true;
     }//check image type
   }//check if image exist
   return $result;
  } //fin function saveImage


  public static function statsBank(){

    $stats = array(
      'count' => 0,
      'cost' => 0,
      'units' => 0
    );

    if (isset($_SESSION['bank'])) {
        $stats['count'] = count($_SESSION['bank']);

        $bank = $_SESSION['bank'];

        foreach ($bank as $element) {

        $stats['cost']+= $element['total_price_units'] * $element['units'];

        $stats['units']+=$element['units'];
        }
    }

    return $stats;
  }//fin function statsBank()

}//fin class Utils
?>
