<?php
    function validate_names($value) {
        $error = "";
        if (empty($data)) {
            $error = "Name is required";
        } elseif (!preg_match("/^[a-zA-Z-' ]*$/",$data)) {
            $error = "Only letters and white space allowed"; 
        }
        return array("value"=> $value, "error"=> $errer);
    }

    function validate_email($data) {
        $validated = False;
        if (empty($data)) {
            $output = "E-mail address is required";
        } elseif (!filter_var($data, FILTER_VALIDATE_EMAIL)) {
            $output = "Please enter a correct e-mail address";
        } else {
            $validated = True;
            $output = $data;
            }
        return array($output, $validated);
    }

    function validate_phone($data) {
        $validated = False;
        if (empty($data)) {
            $output = "Phone is required";
        } elseif (!is_numeric($data)) {
            $output = "Please enter a correct phone number";
        } else {
            $validated = True;
            $output = $data;
            }
        return array($output, $validated);
    }

    function validate_select_one($data) {
        $validated = False;
        if (empty($data)) {
            $output = "Selection is required";
        } else {
            $validated = True;
            $output = $data;
            }
        return array($output, $validated);
    }

    function validate_comment($data) {
        $validated = False;
        if (empty($data)) {
            $output = "Please enter reasons";
        } else {
            $validated = True;
            $output = $data;
            }
        return array($output, $validated);
    }

    function validate_input($fieldname, $type) {
        $data = ""; 
        if (array_key_exists($fieldName, $_POST)) {
            $data = $_POST[$fieldName];
        }
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        if ($type = "name") {
            $output = validate_names($data);
        } elseif ($type = "email") {
            $output = validate_email($data);
        } elseif ($type = "phone") {
            $output = validate_email($data);
        } elseif ($type = "select_one") {
            $output = validate_select_one($data);
        } elseif ($type = "comment") {
            $output = validate_comment($data);
        } elseif ($type = "none") {
            $validated = True;
            $output = array($data, $validated);
        } else {
            $output = array("What you doing?", $validated);
        } 
        return array($output);
    }

    function check_no_errors($fields) {

    }
?>