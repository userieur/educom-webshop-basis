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

    function validatePassword($key, $value) {
        $error = "";
        if (str_contains($key, "check")) {
            $firstEntry = $_POST[substr($key, 0, -5)];
            $firstEntry = trim($firstEntry);
            $firstEntry = stripslashes($firstEntry);
            $firstEntry = htmlspecialchars($firstEntry);
            if (empty($value)) {
                $error = "Please repeat password";
            } elseif ($value != $firstEntry) {
                $error = "Password does not match"; 
            }    
        } else { 
            if (empty($value)) {
                $error = "Please enter password";
            } elseif (!preg_match("/^[a-zA-Z-' ]*$/",$value)) {
                $error = "Only letters and white space allowed"; 
            }
        }
        return array("value"=> $value, "error"=> $error);
    }

    function validateInput($key, $type) {
        $value = "";
        if (array_key_exists($key, $_POST)) {
            $value = $_POST[$key];
        }
        $value = trim($value);
        $value = stripslashes($value);
        $value = htmlspecialchars($value);

        switch ($type) {
            case 'text':
                $output = validateText($value);
                break;
            case 'email':
                $output = validateEmail($value);
                break;
            case 'phone':
                $output = validatePhone($value);
                break;
            case 'comment':
                $output = validateComment($value);
                break;
            case 'password':
                $output = validatePassword($key, $value);
                break;
            case 'select':
            case 'radio':
            case 'textbox':
                $output = array("value"=> $value, "error"=> "");
                break;
            default:
                $output = 'what you doing';
                break;
        }
        return $output;
    }            

    function checkDatabase ($key, $database) {
        // open database
        // check entry voor 
        // finduser by email
        // save user
    }

    function checkForErrors(iterable $keyTypeArray) {
        $allValuesAndErrors = array();
        $allErrors = array();
        $noErrors = false;
        foreach ($keyTypeArray as $key => $type) {
            $output = validateInput($key, $type);
            $allValuesAndErrors += [$key => $output];
            $allErrors[] = $output['error'];
        }
        if (implode("", $allErrors) == "") {
            $noErrors = true;
        }
        return array($allValuesAndErrors, $noErrors);
    }

    function validateForm($formArray) {
        $keyTypeArray = array();
        foreach($formArray as $itemArray) {
            $keyTypeArray += [$itemArray[0] => $itemArray[1]];
        }
        $output = checkForErrors($keyTypeArray);
        return $output;
    }
?>