<?php
    require_once("Functions/functions.php");
    // echo ($_SERVER["PHP_SELF"]);
    // echo var_dump($_SERVER);

    // $test = [1,2,3,4,5];
    // echo var_dump($test);

    // function doSome($array) {
    //     echo var_dump($array);
    //     foreach ($array as $item) {
    //         echo $item . '<br>';
    //     }
    // }
        
    // doSome($test);

    $page = getRequestedPage();
    $pageTitle = createTitle($page);
    showResponsePage($page, $pageTitle);
?>