<?php
    function validate_names($value) {
        $error = "";
        if (empty($value)) {
            $error = "Name is required";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/",$value)) {
            $error = "Only letters and white space allowed"; 
        }
        return array("value"=> $value, "error"=> $error);
    }

    function validate_email($value) {
        $error = "";
        if (empty($value)) {
            $error = "E-mail address is required";
        } elseif (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            $error = "Please enter a correct e-mail address";
        }
            return array("value"=> $value, "error"=> $error);
    }

    function validate_phone($value) {
        $error = "";
        if (empty($value)) {
            $error = "Phone is required";
        } elseif (!is_numeric($value)) {
            $error = "Please enter a correct phone number";
        }
        return array("value"=> $value, "error"=> $error);
    }

    function validate_comment($value) {
        $error = "";
        if (empty($value)) {
            $error = "Please enter reasons";
        return array("value"=> $value, "error"=> $error);
        }
    }

    function validate_input($fieldname) {
        $data = "";
        if (array_key_exists($fieldName, $_POST)) {
            $data = $_POST[$fieldName];
        }
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        switch ($fieldname) {
            case 'fname':
            case 'lname':
                $output = validate_names($data);
                break;
            case 'email':
                $output = validate_email($data);
                break;
            case 'phone':
                $output = validate_phone($data);
                break;
            case 'comment':
                $output = validate_comment($data);
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

    function checkForErrors($fields) {
        $allValuesAndErrors = array();
        $allErrors = array();
        $noErrors = false;
        foreach ($fields as $fieldname) {
            $output = validate_input($fieldname);
            $allValuesAndErrors += [$fieldName => $output];
            $allErrors[] = $output['error'];
        }
        if (implode("", $allErrors) == "") {
            $noErrors = true;
        }
        return array($allValuesAndErrors, $noErrors);
    }
?>