<?php
    function twoStringsIdentical($string1,$string2){
        if($string1 === $string2){
            return true;
        }else{
            return false;
        }
    }

    function encryptString($unencrypted){
        return hash('sha256',$unencrypted);
    }
?>