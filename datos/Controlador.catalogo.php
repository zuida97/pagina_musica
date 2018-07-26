<?php
    require_once '../Negocio/Class.catalogo.php';
    require_once '../Negocio/class.Conexion.php';
    // file_uploads = On;
    function mostrar(){
        $sql="SELECT * FROM catalogo";
        $conexion = new Conexion();
        $resp= $conexion->Consulta($sql);
        if (isset($_POST['enviar'])) {
            $nombre=$_POST['buscar'];
            $sql="SELECT * FROM catalogo WHERE nombre='$nombre'";
            $conexion = new Conexion();
            $resp= $conexion->Consulta($sql);
        }
        return $resp;
    }
    function insertar(){
        $target_dir = "assets/img/catalogo/";
        $target_file = $target_dir . basename($_FILES["fileToUpload"]["link"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        if (isset($_POST['guardar'])) {
            $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
            if($check !== false) {
                echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
            $nombre=$_POST['nom'];
            $grupo=$_POST['grup'];
            $genero=$_POST['gen'];
            $descripcion=$_POST['info'];
            $precio=$_POST['pre'];
            $stock=$_POST['stoc'];
            // $link=$_POST['link'];
            $cat=new catalogo($nombre,$grupo,$descripcion,$genero,$precio,$stock,$link);
            $sql="INSERT INTO catalogo VALUES('$link','$nombre','$grupo','$descripcion','$genero','$precio','$stock')";
            $conexion = new Conexion();
            $resp= $conexion->InMoEl($sql);
            return $resp;
        }
    }
?>
