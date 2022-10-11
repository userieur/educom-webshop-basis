<?php
    function validateText($value) {
        $error = "";
        if (empty($value)) {
            $error = "Name is required";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/",$value)) {
            $error = "Only letters and white space allowed"; 
        }
        return array("value"=> $value, "error"=> $error);
    }

    function validateEmail($value) {
        $error = "";
        if (empty($value)) {
            $error = "E-mail address is required";
        } elseif (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $error = "Please enter a correct e-mail address";
        }
            return array("value"=> $value, "error"=> $error);
    }

    function validatePhone($value) {
        $error = "";
        if (empty($value)) {
            $error = "Phone is required";
        } elseif (!is_numeric($value)) {
            $error = "Please enter a correct phone number";
        }
        return array("value"=> $value, "error"=> $error);
    }

    function validateComment($value) {
        $error = "";
        if (empty($value)) {
            $error = "Please enter reasons";
        return array("value"=> $value, "error"=> $error);
        }
    }

    // Eigenlijk wil ik zeker weten dat ik niet */![spatie] achtige characters er
    // uit haal, en tegelijkertijd wel veilig..
    function validatePassword($value) {
        $error = "";
        $check = $_POST['check'];
        if (empty($value)) {
            $error = "Please enter password";
        } elseif ($value != $check) {
            $error = "Password does not match"; 
        }
        return array("value"=> $value, "error"=> $error);
    }

    function validateInput($key, $type) {
        $data = "";
        // PHP_EOL . var_dump($key);
        // PHP_EOL . var_dump($type);
        if (array_key_exists($key, $_POST)) {
            $data = $_POST[$key];
        }
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        switch ($type) {
            case 'text':
                $output = validateText($data);
                break;
            case 'email':
                $output = validateEmail($data);
                break;
            case 'phone':
                $output = validatePhone($data);
                break;
            case 'comment':
                $output = validateComment($data);
                break;
            case 'password':
                $output = validatePassword($data);
                break;
            case 'select':
            case 'radio':
            case 'textbox':
                $output = array("value"=> $data, "error"=> "");
                break;
            default:
                $output = 'what you doing';
                break;
        }
        return $output;
    }            

    function checkForErrors(iterable $keyTypeArray) {
        // var_dump($keyTypeArray);
        $allValuesAndErrors = array();
        $allErrors = array();
        $noErrors = false;
        foreach ($keyTypeArray as $key => $type) {
            // var_dump($key) . PHP_EOL;
            // var_dump($type) . PHP_EOL;
            $output = validateInput($key, $type);
            $allValuesAndErrors += [$key => $output];
            // var_dump($output);
            $allErrors[] = $output['error'];
        }
        if (implode("", $allErrors) == "") {
            $noErrors = true;
        }
        return array($allValuesAndErrors, $noErrors);
    }

    function validateForm($formArray) {
        // var_dump($formArray);
        $keyTypeArray = array();
        foreach($formArray as $itemArray) {
            $keyTypeArray += [$itemArray[0] => $itemArray[1]];
        }
        $output = checkForErrors($keyTypeArray);
        return $output;
    }
?>