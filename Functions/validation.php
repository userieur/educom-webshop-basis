<?php
    function validateNames($value) {
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

    // van fieldname naar type (hetzelfde idee als bij formbuilder, scheelt opties)
    // dus misschien type meegeven van parent functie, zodat fieldname (key) nog steeds gebruikt kan worden
    // om post value op te halen
    function validateInput($fieldName) {
        $data = "";
        if (array_key_exists($fieldName, $_POST)) {
            $data = $_POST[$fieldName];
        }
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        switch ($fieldName) {
            case 'fname':
            case 'lname':
            case 'uname':
                $output = validateNames($data);
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
            case 'none':
            case 'pref':
            case 'sex':
            case 'story':
                $output = array("value"=> $data, "error"=> "");
                break;
            default:
                $output = 'what you doing';
                break;
        }
        return $output;
    }            

    function checkForErrors(iterable $fields) {
        $allValuesAndErrors = array();
        $allErrors = array();
        $noErrors = false;
        foreach ($fields as $fieldName) {
            $output = validateInput($fieldName);
            $allValuesAndErrors += [$fieldName => $output];
            $allErrors[] = $output['error'];
        }
        if (implode("", $allErrors) == "") {
            $noErrors = true;
        }
        return array($allValuesAndErrors, $noErrors);
    }

    // deze moet nog
    function formValidation($formArray) {
        $keyArray = array();
        foreach($formArray as $itemArray) {
            $keyArray[] = $itemArray[0];
        }
    }
?>