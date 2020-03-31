<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if ( ! function_exists('waktu_data')){
    
    function waktu_data($id, $time=30){
        $id2=null;
        for ($i=3; $i < strlen($id); $i++) { 
            $id2 .= $id[$i];
        }
        $waktu = date_create(date('Y-m-d H:i:s',(int)$id2));
        $waktu2 = date_create(date('Y-m-d H:i:s'));
        $diff = date_diff($waktu, $waktu2);
        // $diff->format('%d%i');

        if ((int)$diff->format('%Y')>0) {
            return false;
        }elseif ((int)$diff->format('%m')>0) {
            return false;
        }elseif ((int)$diff->format('%d')>$time) {
            return false;
        }/*elseif ((int)$diff->format('%H')>$time) {
            return false;
        }elseif ((int)$diff->format('%i')>$time) {
            return false;
        }*/else {
            return true;
        }
    }   
}

if ( ! function_exists('konv_waktu')){
    
    function konv_waktu($id){
        $id2=null;
        for ($i=3; $i < strlen($id); $i++) { 
            $id2 .= $id[$i];
        }
        return date('Y-m-d',(int)$id2);
    }   
}

