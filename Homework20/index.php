<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File System</title>
    <link href="style.css" type="text/css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
</head>
<body>

    <div class="container">

    <?php
        
    $tpmPath = $_SERVER["SCRIPT_FILENAME"];
//    $tpmPath = substr($tpmPath, 0, strrpos($tpmPath, '/'));
    $tpmPath = substr(substr($tpmPath, 0, strrpos($tpmPath, '/')), 0, strrpos($tpmPath, '/') + 1);
    define('ROOT_PATH', $tpmPath.'/');

    function mkYellow($searchResult, $counter){
        foreach ($searchResult as $value) {
            if($value == $counter){
                echo 'style="background-color:yellow" ';
            }
        }
    }

    function myScanDir($path = ""){

        if(isset($_GET['path'])){    //haskananq wortex enq gtnvum
            $path = $_GET['path'];
        }else     if ($path == ""){
            $path = ROOT_PATH;
        }
        if(isset($_POST['path'])){
            $path = $_POST['path'];
        }
        if($path == ""){$path = '/';}

        if (!empty($_FILES["upload"])) {   //faily upload anenq
            $myFile = $_FILES["upload"];

            if ($myFile["error"] !== UPLOAD_ERR_OK) {
                echo "<p>An error occurred.</p>";
                exit;
            }

            // ensure a safe filename
            $name = preg_replace("/[^A-Z0-9._-]/i", "_", $myFile["name"]);

            // don't overwrite an existing file
            $i = 0;
            $parts = pathinfo($name);
            while (file_exists($path . $name)) {
                $i++;
                $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
            }

            // preserve file from temporary directory
            $success = move_uploaded_file($myFile["tmp_name"], $path . $name);
            if (!$success) {
                echo "<p>Unable to save file.</p>";
                exit;
            }

            // set proper permissions on the new file
            chmod($path . $name, 0777);
        }
        if(!is_readable($path)){
            die;
        } else{
            $result = scandir($path);
        }

        echo ' <br><br>
        <form action="index.php" enctype="multipart/form-data" class="form-inline">
            <div class="form-group">
                <input type="hidden" value="'.$path.'" name="path">
                <input type="text" name="search" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-info form-control">Search</button>
        </form>';
        $searchResult = [];
        if(isset($_GET['search'])){
            $strSearch = $_GET['search'];
            foreach($result as $index => $item){
                if(strpos($item, $strSearch) !== false){
                    $searchResult[] = $index;
                }
            }
        }
        echo '<br>';

        $dotSearchResult = array_search('.', $result);
        unset($result[$dotSearchResult]);
        $counter = 1;

        foreach ($result as $index => $item){

            $nestedPath = $path . $item . '/';
            $midifiedPath = ltrim($path, '/var/www/html');

            if(is_dir($nestedPath)){
                if($item == '..') {
                    $nestedPath = substr($nestedPath, 0, strrpos(substr($nestedPath, 0, strrpos($nestedPath, '/')), '/'));
                    $nestedPath = substr($nestedPath, 0, strrpos($nestedPath, '/') + 1);
                    echo '<a class="icon up" href="index.php' . '?path=' . $nestedPath . '">' . $item . '</a><br>';
                } else {
                    echo '<a class="icon dir" style="color:black" href="index.php' . '?path=' . $nestedPath . ' " ';
                    mkYellow($searchResult, $counter);
                    echo '>'. $item . '</a><br>';

                }
            } else {
                if( strpbrk($path, 'var/www/html') && (filesize($path . $item) > 11)  && exif_imagetype($path . $item)){

                    echo '<a class="icon file" href="#"  data-toggle="modal" data-target="#id'.$counter.'"';
                    mkYellow($searchResult, $counter);
                    echo ' >' . $item . '</a> '.date("d M Y H:i:s.",filemtime($path . $item));
                    echo '<div class="modal fade" id="id'.$counter.'" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog modal-sm"> <div class="modal-content">
                    '.'<img src="';
                    echo '/'.$midifiedPath . $item;
                    echo '" class="img-rounded img-responsive"></div></div></div><br>';
                } else{
                    echo '<span ';
                    mkYellow($searchResult, $counter);
                    echo ' class="icon file">' . $item . '</span> '.date("d M Y H:i:s.",filemtime($path . $item)) . '<br>';
                }
            }
            $counter++;

        }
        echo ' <br><br>
        <form action="index.php" method="post" enctype="multipart/form-data" class="form-inline">
            <div class="form-group">
                <input type="hidden" value="'.$path.'" name="path">
                <input type="file" value="Upload File" name="upload" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-info form-control">Upload File</button>
        </form>';

        return $result;
    }

    myScanDir();

    ?>
    </div>

    <br><br>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</body>
</html>




