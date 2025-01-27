<?php

require_once __DIR__ . '/../controller/fileController.php';
$fileController = new FileController();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    switch ($_GET['acao']) {
        case 'SalvarImagem':
            $uploadDir = '../../public/uploads/';
            $tiposPermitido = ['image/jpeg', 'image/png'];

            //caso a pasta nao exister criar ela.
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            echo $_FILES['image'];
            echo $_FILES['image']['type'];
            if(isset($_FILES['image']) &&  in_array($_FILES['image']['type'],$tiposPermitido)){

                //esse calculo é feito em bytes nesse caso seria 2mb 
                $tamanhoMaximo = 2 * 1024 * 1024;
                if($_FILES['sizes'] > $tamanhoMaximo){
                    echo "Arquivo muito grande";
                }else{
                    $fileTmpPath = $_FILES['image']['tmp_name'];
                    $fileName = $_FILES['image']['name'];
                    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
                    $newFileName = uniqid("img_") . '.' . $fileExtension;
                    $destino = $uploadDir . $newFileName;
    
                    if(move_uploaded_file($fileTmpPath,$destino)){
                        $result = $fileController->SalvarImagem($newFileName);
                        header("Location: ../../pages/foto/index.php");
                    }
                }
            }else{
                echo "ocorreu um erro ao enviar o arquivo";
            }
            break;
        default:
            echo 'Not found';
            break;
    }
}
