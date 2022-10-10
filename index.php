<?php
    require_once("Functions/pagebuilder.php");
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
    
    $arr = array('first' => 'a', 'second' => 'b', );
    $key = array_search ('a', $arr);
    foreach($arr as $key => $value){
        echo $key . ' ' . $value;
        echo '<br>';
        // echo key($arr);
    }


    // doSome($test);

    $page = getRequestedPage();
    $pageTitle = createTitle($page);
    showResponsePage($page, $pageTitle);
?>