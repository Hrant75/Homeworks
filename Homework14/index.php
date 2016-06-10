<!DOCTYPE html>
<html>
<head>
    <title>random size Matrix</title>
    <meta charset="UTF-8">
    <link href="main.css" type="text/css" rel="stylesheet">

</head>
    <body>
        <p>random size Matrix (3 to 20) please reload page to change the size</p>
        <input type="button" value="Reload Page" onClick="window.location.reload()"><br>

        <?php
        $matrixHTML = '';
        $n = rand(3,20);
        echo 'and now it is'.$n;
        for($i=0; $i<$n; $i++){
            $matrixHTML .= '<div>';
            for($j=0; $j<$n; $j++){
                if( $i==0 || $i==$n-1 || $j==0 || $j==$n-1 || $i+$j==$n-1){
                    $matrixHTML .= '<span style="background-color:#d6d6d6;width:'.(100/$n).'%">'.($i+1).','.($j+1);
                }
                else{
                    $matrixHTML .= '<span style="background-color:#e6e6e6;width:'.(100/$n).'%">'.($i+1).','.($j+1);
                }
                $matrixHTML .= '</span>';
            }
            $matrixHTML .= '</div>';

        }
        echo $matrixHTML;
        ?>
    
    </body>


</html>