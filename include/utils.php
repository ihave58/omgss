<?php
    function runUserInputSanitizationHook($value)
    {
        $value = filter_var($value, FILTER_SANITIZE_STRING);
        $value = filter_var($value, FILTER_SANITIZE_MAGIC_QUOTES);


        return $value;
    }

?>