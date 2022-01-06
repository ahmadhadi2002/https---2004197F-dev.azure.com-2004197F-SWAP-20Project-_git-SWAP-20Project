<?php
function check_input($input, $mandatory, $pattern) {
    
    $inputvalue=$_POST[$input];
    
    if (empty($inputvalue)) {
        printmessage("$input field is empty");
        if ($mandatory) return false;
        else printmessage("but $input is not mandatory");
    }
    if (strlen($pattern) > 0) {
        $ismatch=preg_match($pattern,$inputvalue);
        if (!$ismatch || $ismatch==0) {
            printmessage("$input field wrong format <br>");
            if ($mandatory) return false;
        }
    }
    return true;
}
?>