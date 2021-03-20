<?php 

class MY_Form_validation extends CI_Form_validation {

        /* 
        * 
        * Custom rules for check length msg 
        *
        */
        public function msg_check($msg)
        {   
                if (mb_strlen($msg) > (mb_strlen($_SESSION['keyFirst']) * mb_strlen($_SESSION['keySecond'])))
                {
                        return FALSE;
                }
                else
                {
                        return TRUE;
                }
        }
        
}