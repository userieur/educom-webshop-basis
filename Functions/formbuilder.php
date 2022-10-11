<?php

    function showForm($page, $css, $array, $allValuesandErrors) {
            showFormStart($page, $css);
            showFormItems($array, $allValuesandErrors);
            showFormEnd();
        }

    function showFormStart($page, $css) {
        echo '<form method="POST" action="index.php">
                <div class="' . $css . '">
                <input type="hidden" id="page" name="page" value="' . $page . '">' . PHP_EOL . PHP_EOL;
    }

    function showFormItems($array, $allValuesandErrors) {
        foreach($array as $item){
            $key = $item[0];
            $type = $item[1];
            $label = $item[2];
            isset($item[3]) ? $placeholder = $item[3] : $placeholder = "";
            isset($item[4]) ? $options = $item[4] : $options = "";
            showFormItem($key, $type, $label, $placeholder, $options, $allValuesandErrors);
        }   
    }

    function showFormEnd() {
        echo '<input type="submit" value="Verstuur">' . PHP_EOL;
        echo '</div>' . PHP_EOL;
        echo '</form>' . PHP_EOL;
    }


    function showFormItem($key, $type, $label, $placeholder, $options, $allValuesandErrors) {
        createLabel($key, $type, $label);
        createInputField($key, $type, $label, $placeholder, $options, $allValuesandErrors);
        createSpan($key, $allValuesandErrors);
    }

    function createLabel($key, $type, $label) {
        switch ($type) {
            case 'text':
            case 'email':
            case 'phone':
            case 'select':
                echo '<label class="field" for="' . $key . '">' . $label . '</label>' . PHP_EOL;
                break;
            case 'radio':
                echo '<p>' . $label . '</p>' . PHP_EOL;
                break;
            case 'textbox':
                echo '<label for="' . $key . '">' . $label . '</label><br>' . PHP_EOL;
                break;
            case 'password':
                break;
            default:
                break;
        }
    }

    function createInputField($key, $type, $label, $placeholder, $options, $allValuesandErrors) {
        switch ($type) {
            case 'text':
            case 'email':
            case 'phone':
                echo '<input type="' . $type . '" id="' . $key . '" name="' . $key . '" ' 
                        . (($type == 'phone') ? ('pattern"=[0-9]{2}[0-9]{8}|[0-9]{3}[0-9]{7}" ') : "") 
                        . 'value="' . (isset($allValuesandErrors[$key]['value']) ? $allValuesandErrors[$key]['value'] : "") 
                        . '" placeholder="' . $placeholder . '">' . PHP_EOL;
                break;
            case 'select':
                echo '<select required id="' . $key . '" name="' . $key . '" placeholder="...">'
                . '<option selected value="" disabled>' . $placeholder . '</option>' . PHP_EOL;
                foreach($options as $value => $itemtext) {
                    echo '<option ' . ((isset($allValuesandErrors[$key]['value']) && $allValuesandErrors[$key]['value'] == $value ) ? "selected" : "") 
                    . ' value="' . $value . '">' . $itemtext . '</option>' . PHP_EOL;
                } echo '</select>' . PHP_EOL;
                break;
            case 'radio':
                foreach($options as $id => $value) {
                    echo '<input required type="radio" id="' . $id . '" name="' . $key . '" ' 
                            . ((isset($allValuesandErrors[$key]['value']) && $allValuesandErrors[$key]['value'] == $value) ? "checked" : "") 
                            . ' value="' . $value . '">'
                            . '<label for="' . $id . '">' . $value . '</label>' . PHP_EOL;
                } echo '<br>';
                break;
            case 'textbox':
                echo '<textarea id="' . $key . '" name="' . $key . '" rows="4" cols="50" placeholder="' . $placeholder . '">' 
                      . (isset($allValuesandErrors[$key]['value']) ? $allValuesandErrors[$key]['value'] : "") 
                      . '</textarea><br>' . PHP_EOL;
                break;
            case 'password':
                echo '<label class="field" for="' . $key . '">' . $label . '</label>' . PHP_EOL;
                echo '<input required type="' . $type . '" id="' . $key . '" name="' . $key . '"' ;
                            // . ' pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}"'
                            // . ' title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters"';
                break;
            default:
                break;
        }
    }

    function createSpan($key, $allValuesandErrors) {
        echo '<span class="error">' . (isset($allValuesandErrors[$key]['error']) ? $allValuesandErrors[$key]['error'] : "") . '</span><br>' . PHP_EOL . PHP_EOL;
    }
    
    function showThankYou($allValuesandErrors, $formArray, $message) {
        echo '<h3>' . $message . '</h3>
              <h5>The data you have entered:</h5>
              <div>';
        // var_dump($allValuesandErrors);
        foreach($formArray as $item) {
            $key = $item[0];
            $type = $item[1];
            $label = $item[2];
            if ($type == 'password') {
                continue;
            }
            echo '<p>' . $label . '</p><br>' . $allValuesandErrors[$key]['value'];
        echo '</div>';
        }
    }
?>