<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
    include_once('connect.php');
    require 'vendor/autoload.php';

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

    if (isset($_REQUEST['import-excel'])) {
        # code...
        $file= $_FILES['excel-file']['tmp_name'];
        $extension = pathinfo($_FILES['excel-file']['name'], PATHINFO_EXTENSION);
              echo "File Name: ".$_FILES["excel-file"]["name"]."<br>";
        if ($extension =='xls' || $extension =='xlsx' || $extension =='csv') {
            echo 'file select';
            # code...
            $obj = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
            $data = $obj->getActiveSheet()->toArray();
            
            for ($i=1; $i < count($data)  ; $i++) {

                   $matricule =   $data[$i][1]; 
                   $nom =   addslashes($data[$i][2]);
                   $prenom =   addslashes($data[$i][3]); 
                   $genre =   addslashes($data[$i][4]);
                   $dateNaiss =   addslashes($data[$i][5]);
                   $annee =   addslashes($data[$i][6]);
                   $classe =   addslashes($data[$i][0]);
                   
                   
                   
                   echo $matricule .'  ' . $nom .' '. $prenom .' '. $dateNaiss.' '.$genre .'<br>'.'<br>'.'<br>';
                   
                   $sql = $connexion->prepare("INSERT INTO eleves (matricule, nom, prenom, genre, dateNaissance, classe, annee) VALUES('$matricule','$nom','$prenom','$genre','$dateNaiss','$classe','$annee')");
                   
                                      
                   $sql->execute();
                
            }
            echo '<br>Le nombre de ligne copigné est: '.$i .'<br>';
            
        }else{
            echo 'fichier non selectionner';
        }
    }
    ?>

    <div><H1>import File excel</H1></div>
    <br>
    <form method="POST" enctype="multipart/form-data">
        <div>
            <p>select file excel</p>
            <input type="file" name="excel-file" class="form-control">
        </div>
        <div>
            <input type="submit" name="import-excel" value="Import">
        </div>
        <p style="color: red;">
        <?php
        if(!empty($msg)){
            echo $msg;
        }
        ?>
        </p>
    </form>
</body>
</html>