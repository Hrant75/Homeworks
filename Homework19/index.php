<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Survey - PHP Quiz</title>
    <link href="main.css" type="text/css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <?php

        if(isset($_GET['page'])){
            $currentPage = $_GET['page'];
        } else {
            $currentPage = -1;
        }

        $questions = [
          ['1. What does PHP stand for?', 3, ' Private Home Page', ' Personal Hypertext Processor', ' PHP: Hypertext Preprocessor'],
          ['2. PHP server scripts are surrounded by delimiters, which?', 3, ' &lt;&amp;&gt;...&lt;/&amp;&gt;', ' &lt;script&gt;...&lt;/script&gt;', '  &lt;?php...?&gt;', '  &lt;?php&gt;...&lt;/?&gt;'],
          ['3. How do you write "Hello World" in PHP', 2, '"Hello World";', 'echo "Hello World";', 'Document.Write("Hello World");'],
          ['4. All variables in PHP start with which symbol?', 1, '$', '!', '&'],
          ['5. What is the correct way to end a PHP statement?', 3, '&lt;/php&gt;', '.', ';', 'New line'],
          ['6. The PHP syntax is most similar to:', 1, 'Perl and C +', 'VBScript', 'JavaScript'],
          ['7. How do you get information from a form that is submitted using the "get" method?', 1, '$_GET[ ];', 'Request.Form;', 'Request.QueryString;'],
          ['8. When using the POST method, variables are displayed in the URL:', 2, 'True', 'False'],
          ['9. In PHP you can use both single quotes ( \' \' ) and double quotes ( " " ) for strings:', 1, 'True', 'False'],
          ['10. Include files must have the file extension ".inc"', 2, 'True', 'False'],
          ['11. What is the correct way to include the file "time.inc" ?', 3, '&lt;!-- include file="time.inc" --&gt;', '&lt;?php include:"time.inc"; ?&gt;', '&lt;?php include "time.inc"; ?&gt;', '&lt;?php include file="time.inc"; ?&gt;'],
          ['12. What is the correct way to create a function in PHP?', 2, 'new_function myFunction()', 'function myFunction()', 'create myFunction()'],
          ['13. What is the correct way to open the file "time.txt" as readable?', 3, 'fopen("time.txt","r+");', 'open("time.txt");', 'fopen("time.txt","r");', 'open("time.txt","read");'],
          ['14. PHP allows you to send emails directly from a script', 1, 'True', 'False'],
          ['15. Which superglobal variable holds information about headers, paths, and script locations?', 1, '$_SERVER', '$_GET', '$_SESSION', '$_GLOBALS'],
          ['16. What is the correct way to add 1 to the $count variable?', 1, '$count++;', 'count++;', '$count =+1', '++count'],
          ['17. What is a correct way to add a comment in PHP?', 3, '&lt;!--...--&gt;', '&lt;comment&gt;...&lt;/comment&gt;', '/*...*/', '*\...\*'],
          ['18. PHP can be run on Microsoft Windows IIS(Internet Information Server):', 2, 'False', 'True'],
          ['19. The die() and exit() functions do the exact same thing.', 2, 'False', 'True'],
          ['20. Which one of these variables has an illegal name?', 3, '$my_Var', '$myVar', '$my-Var']
        ];

        if(isset($_GET['score'])){
            $score = $_GET['score'];
        } else {
            $score = 0;
        }

        for($i=0; $i<20; $i++){
            if(isset($_GET['q'.($i)])){
                if( $_GET['q'.($i)] == $questions[$i][1] ){
                    $score++;
                }
            }
        }
    ?>

    <div class="container">
        <h1>PHP Quiz </h1>
    <?php
        if( $currentPage == -1 ) {
            echo '<div class="myContainer text-center">
                <h2>PHP Quiz by W3Schools</h2>
                <br><br>
                <form action="index.php">
                    <button type="submit" class="btn btn-info center-block" name="page" value="0">START</button>
                </form>
        </div>';
        }

        if($currentPage > -1 && $currentPage < count($questions)) {
            echo '<div class="myContainer"> 
             <h3>' . $questions[$currentPage][0] . '</h3>
            <form action="index.php" class="form-inline">
                <div class="form-group">';
                for ($i = 2; $i < count($questions[$currentPage]); $i++) {
                    echo '<input type="radio" name="q' . $currentPage . '" value="' . ($i - 1) . '" > ' . $questions[$currentPage][$i] . '<br>';
                }
                echo '</div><br><br>
                    <input type="hidden" name="page" value="' . ($currentPage + 1) . '">
                    <input type="hidden" name="score" value="' . $score . '">
                <button type="submit" class="btn btn-info center-block">Next</button>
            </form>
            </div>';
        }

        if($currentPage == 20){
            echo '<div class="myContainer text-center"><h3>Your score is '.$score.'</h3><br><h3>';
            if($score > 18){
                echo 'Great job. Thank you.';
            } else if($score > 14){
                echo 'Not bad. Thank you.';
            } else if($score > 10){
                echo 'Must work harder. Thank you.';
            } else if($score > 2){
                echo 'Very bad.';
            } else if($score <= 2){
                echo 'Դու կաֆել֊մետլախ խփել սովորի, ընգեր ջան։ Էսի քո բանը չի։ :-)';
            }
            echo '</h3><br>
                    <form action="index.php">
                    <button type="submit" class="btn btn-info center-block" name="page" value="-1">START AGAIN</button>
                </form></div>';
        }
    ?>
</div>

</body>
</html>



