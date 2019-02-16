<?php
      $conection = mysqli_connect('localhost', 'root', '', 'KasterTool_db');

      if($conection->connect_error) {
          die ('error de conexion(' . $conection->connect_errno . 
          ')' . $conection->connect_error);
      } else {

        $temp = '';
        $lineas = file('../sql/database.sql'); 
        
        foreach ($lineas as $linea) {
            $empiezaPor = substr(trim($linea), 0, 2);
            $acabaPor =  substr(trim($linea), -1, 1);
            
            if (empty($linea) || $empiezaPor == '--' || $empiezaPor == '/*' || $empiezaPor == '//') {
                continue;
            }

            $temp = $temp . $linea;

            if ($acabaPor == ';') { 
                $temp = mysqli_query($conection, $temp) or die(mysqli_error($conection));
                $temp = '';
            }      
        }
        $conection = null;
      header('Location: portada.php');
      die();
    }

?>