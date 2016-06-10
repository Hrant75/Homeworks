<!DOCTYPE html>
<html>
<head>
    <title>Quadratic equation by PHP</title>
    <meta charset="UTF-8">
    <link href="main.css" type="text/css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <p>Quadratic equation calculator</p>


        <form action="index.php" class="form-inline">
            <div class="form-group">
                <input type="number" class="form-control" id="a" placeholder="a" name="a">
                <label for="a"><span>x<sup>2</sup>+</span></label>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" id="b" placeholder="b"  name="b">
                <label for="b">x+</label>
            </div>
            <div class="form-group">
                <input type="number" class="form-control" id="c" placeholder="c" name="c">
                <label for="c">= 0</label>
            </div>
            <br><br>
            <button type="submit" class="btn btn-default">Calculate</button>
        </form>
        <br><br>

        <?php
            function calculate($a,$b,$c){

                $d=($b*$b)-(4*$a*$c);
                if($d<0){
                    echo 'Discriminant is less than 0';
                    return false;
                } else{
                    $x1=(-1*$b + sqrt($d))/(2*$a);
                    $x2=(-1*$b - sqrt($d))/(2*$a);
                    echo 'x1='.$x1.'<br><br>x2='.$x2;
                    return true;
                }
            }

            if(isset($_GET['a']) && isset($_GET['b']) && isset($_GET['c']) && $_GET['a']!='' && $_GET['b']!='' && $_GET['c']!='')
            {
                calculate( $_GET['a'], $_GET['b'], $_GET['c'] );
            } else {
                echo 'please enter all numbers';
            }
        ?>

    </div>

<script>

</script>


</body>
</html>