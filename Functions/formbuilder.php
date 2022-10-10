<?php

    function showForm($page, $css, $array) {
            showFormStart($page, $css);
            showFormItems($array);
            showFormEnd();
        }

    function showFormStart($page, $css) {
        echo '<form method="POST" action="index.php">
                <div class="form">
                <input type="hidden" id="page" name="page" value="' . $page . '">';
    }

    function showFormItems($array) {
        foreach($array as $item){
            $key = $item[0];
            $type = $item[1];
            $label = $item[2];
            isset($item[3]) ? $placeholder = $item[3] : $placeholder = "";
            isset($item[4]) ? $options = $item[4] : $options = "";
            showFormItem([$key, $type, $label, $placeholder, $options]);
        }   
    }

    function showFormEnd();
        echo '<input type="submit" value="Verstuur">
            </div>
        </form>';

    function showFormItem($key, $type, $label, $placeholder, $options) {
        createLabel($key, $type, $label)
        createInputField($key, $type, $label, $placeholder, $options)
        createSpan($key)
    }

    function createLabel($type, $key, $label) {
        switch ($type) {
            case 'text':
            case 'email':
            case 'phone':
            case 'select':
                echo '<label class="field" for="' . $key . '">' . $label . '</label>';
                break;
            case 'radio';
                echo '<p>' . $label . '</p>';
                break;
            case 'textbox';
                echo '<label for="' . $key . '">' . $label . '</label>';
                break;
            default:
                break;
        }
    }

    function createInputField($key, $type, $label, $placeholder, $options) {
        switch ($type) {
            case 'text':
            case 'email':
            case 'phone':
                echo '<input type="' . $type . '" id="' . $key . '" name="' . $key . '" 
                        ' . (($type == 'phone') ? ('pattern"=[0-9]{2}[0-9]{8}|[0-9]{3}[0-9]{7}" ') : "") . '
                        value="' . (isset($allValuesandErrors[$key]['value']) ? $allValuesandErrors[$key]['value'] : "") . '" 
                        placeholder="' . $placeholder . '">';
                break;
            case 'select':
                echo '<select required id="' . $key . '" name="' . $key . '" placeholder="...">
                        <option selected value="" disabled>' . $placeholder . '</option>';
                foreach($options as $value => $itemtext) { // 'man' => 'Dhr.'
                    echo '<option' . (isset($allValuesandErrors[$key]['value']) && $allValuesandErrors[$key]['value'] == $value ) ? "selected" : "") . ' 
                          value="' . $value . '">' . $itemtext . '</option>';
                } echo '</select>';
                break;
            case 'radio':
                foreach($options as $id => $value) {
                    echo '<input required type="radio" id="' . $id . '" name="' . $key . '"
                            ' . ((isset($allValuesandErrors[$key]['value']) && $allValuesandErrors[$key]['value'] == $value) ? "checked" : "") . '
                            value="' . $value . '">
                            <label for="' . $id . '">' . $value . '</label>';
                } echo '<br>';
                break;
            case 'textbox':
                echo '<textarea id="' . $key . '" name="' . $key . '" rows="4" cols="50" placeholder="' . $placeholder . '">
                        ' . (isset($allValuesandErrors[$key]['value']) ? $allValuesandErrors[$key]['value'] : "") . '
                        </textarea><br>';
                break;
            default:
                break;
        }
    }

    function createSpan() {
        echo '<span class="error">' . (isset($allValuesandErrors[$key]['error']) ? $allValuesandErrors[$key]['error'] : "") . '</span><br>';
    }
    
    function showThankYou($allValuesandErrors, $formArray) {
        echo '<h3>You are Amazing</h3>
              <h5>The data you have entered:</h5>
              <div>';
        foreach($formArray as $item) {
            $key = $item[0]
            $label = $item[2]
            echo '<p>' . $label . '</p><br>' . $allValuesandErrors[$key]['value'];
        echo '</div>';
        }
    }
?>