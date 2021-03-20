<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Double_switch extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));

        $this->load->library('form_validation');
    }

    public function viewEncrypt($request = "")
    {
        $data['info'] = $request;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('chiper/double_switch/double_switch_e');
        $this->load->view('templates/footer');
    }

    public function viewDecode($request = "")
    {
        $data['info'] = $request;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('chiper/double_switch/double_switch_d');
        $this->load->view('templates/footer');
    }

    public function encrypt()
    {
        unset(
            $_SESSION['keyFirst'],
            $_SESSION['keySecond']
        );

        $keyFirst = $this->input->post('keyFirst');
        $keySecond = $this->input->post('keySecond');
        $msg = $this->input->post('msg');

        /* Работа с сессией */
        $this->session->set_userdata('keyFirst', $keyFirst);
        $this->session->set_userdata('keySecond', $keySecond);
        /*******************/

        $this->form_validation->set_error_delimiters('> ', '');

        if ($this->form_validation->run('double_chiper') == FALSE) {
            $this->viewEncrypt();
        } else {
            $msg = str_replace(" ", "_", $msg);

            $keyFirst = mb_strtoupper($keyFirst);
            $keySecond = mb_strtoupper($keySecond);
            $msg = mb_strtoupper($msg);

            $keyFirst = mb_str_split($keyFirst);
            $keySecond = mb_str_split($keySecond);
            $msg = mb_str_split($msg);

            /*Замена букв на цифры ключ 1*/
            for ($i = 0; $i < count($keyFirst); $i++)
                if (!is_numeric($keyFirst[$i])) {
                    $keyFirst[$i] = array_search($keyFirst[$i], ALPHABET);
                }

            $temp = array_fill(1, count($keyFirst), '*');

            $sortFK = $keyFirst;
            sort($sortFK);

            for ($i = 0; $i < count($keyFirst); $i++) {
                $temp[$i + 1]  = $sortFK[$i];
            }

            for ($i = 0; $i < count($keyFirst); $i++) {
                $keyFirst[$i] = array_search($keyFirst[$i], $temp);
            }
            /***********************/

            /*Замена букв на цифры ключ 2*/
            for ($i = 0; $i < count($keySecond); $i++)
                if (!is_numeric($keySecond[$i])) {
                    $keySecond[$i] = array_search($keySecond[$i], ALPHABET);
                }

            $temp = array_fill(1, count($keySecond), '*');

            $sortSK = $keySecond;
            sort($sortSK);

            for ($i = 0; $i < count($keySecond); $i++) {
                $temp[$i + 1]  = $sortSK[$i];
            }

            for ($i = 0; $i < count($keySecond); $i++) {
                $keySecond[$i] = array_search($keySecond[$i], $temp);
            }
            /***********************/

            /* Привязка значений к  1 ключу и сортировка*/
            $encryptMsgByFK = array_fill_keys($keyFirst, array_fill(0, count($keySecond), '*'));

            for ($j = 0, $i = 0; $j < count($keyFirst); $j++, $i++) {
                $temp = $i;
                for ($q = 0; $q < count($keySecond); $q++) {
                    $encryptMsgByFK[$keyFirst[$j]][$q] = $msg[$temp] ? $msg[$temp] : "*";
                    $temp += count($keyFirst);
                }
            }

            ksort($encryptMsgByFK);
            /****************************/

            /*Привязка значений ко 2 ключу и сортировка*/
            $encryptMsgBySK = array_fill_keys($keySecond, array_fill(0, count($keyFirst), '*'));

            for ($i = 0, $q = 0; $i < count($keySecond); $i++, $q++) {
                for ($j = 0, $k = 1; $j < count($keyFirst); $j++, $k++) {
                    $encryptMsgBySK[$keySecond[$i]][$j] = $encryptMsgByFK[$k][$q] ? $encryptMsgByFK[$k][$q] : '*';
                }
            }

            ksort($encryptMsgBySK);
            /****************************/
            $data = '';
            for ($i = 0; $i < count($keyFirst); $i++) {
                for ($j = 1; $j < count($keySecond) + 1; $j++) {
                    $data .= $encryptMsgBySK[$j][$i];
                }
            }
            $this->viewEncrypt($data);
        }
    }

    public function decode()
    {
        unset(
            $_SESSION['keyFirst'],
            $_SESSION['keySecond']
        );

        $keyFirst = $this->input->post('keyFirst');
        $keySecond = $this->input->post('keySecond');
        $msg = $this->input->post('msg');

        /* Работа с сессией */
        $this->session->set_userdata('keyFirst', $keyFirst);
        $this->session->set_userdata('keySecond', $keySecond);
        /*******************/

        $this->form_validation->set_error_delimiters('> ', '');

        if ($this->form_validation->run('double_chiper') == FALSE) {
            $this->viewDecode();
        } else {
            $msg = str_replace(" ", "_", $msg);

            $keyFirst = mb_strtoupper($keyFirst);
            $keySecond = mb_strtoupper($keySecond);
            $msg = mb_strtoupper($msg);
    
            $keyFirst = mb_str_split($keyFirst);
            $keySecond = mb_str_split($keySecond);
            $msg = mb_str_split($msg);
    
                /*Замена букв на цифры ключ 1*/
            for ($i = 0; $i < count($keyFirst); $i++)
            {
                $keyFirst[$i] = array_search($keyFirst[$i], ALPHABET);
            }
    
            $temp = array_fill(1, count($keyFirst), '*');
    
            $sortFK = $keyFirst;
            sort($sortFK);
    
            for ($i = 0; $i < count($keyFirst); $i++) {
                $temp[$i + 1]  = $sortFK[$i];
            }
    
            for ($i = 0; $i < count($keyFirst); $i++) {
                $keyFirst[$i] = array_search($keyFirst[$i], $temp);
            }
            /***********************/
                
            /*Замена букв на цифры ключ 2*/
            for ($i = 0; $i < count($keySecond); $i++)
            { 
                $keySecond[$i] = array_search($keySecond[$i], ALPHABET);
            }
    
            $temp = array_fill(1, count($keySecond), '*');
    
            $sortSK = $keySecond;
            sort($sortSK);
    
            for ($i = 0; $i < count($keySecond); $i++) {
                $temp[$i + 1]  = $sortSK[$i];
            }
    
            for ($i = 0; $i < count($keySecond); $i++) {
                $keySecond[$i] = array_search($keySecond[$i], $temp);
            }
            /***********************/

            for($i = 1; $i <= count($keySecond);$i++){
                $keySK[] = $i;
            }    

            for($i = 1; $i <= count($keyFirst);$i++){
                $keyFK[] = $i;
            }    

            $decodeMsgBySK = array_fill_keys($keySK,array_fill(0, count($keyFirst), '*'));
            /*Привязка значений ко 2 ключу и сортировка*/
            $msgCount = 0;
            for($i = 0; $i < count($keyFirst); $i++){
                for($j = 1; $j <= count($keySecond); $j++){
                    $decodeMsgBySK[$j][$i] = $msg[$msgCount];
                    $msgCount++;
                }
            }
            $temp = $decodeMsgBySK;
            for($i = 0; $i < count($keySecond); $i++){
                $decodeMsgBySK[$i+1] = $temp[$keySecond[$i]];
                
            }
            /*******************************************/

            /*Привязка значений ко 2 ключу и сортировка*/
            $decodeMsgByFK = array_fill_keys($keyFK,array_fill(0, count($keySecond), '*'));

            for($i = 0; $i < count($keyFirst); $i++){
                for($j = 1; $j <= count($keySecond); $j++){
                    $decodeMsgByFK[$i+1][$j-1] = $decodeMsgBySK[$j][$i];
                }

            }

            $temp = $decodeMsgByFK;

            for($i = 0; $i < count($keyFirst); $i++){
            $decodeMsgByFK[$i+1] = $temp[$keyFirst[$i]];
            }
            /*******************************************/

            $data = '';
            for ($i = 0; $i < count($keySecond); $i++) {
                for ($j = 1; $j <= count($keyFirst); $j++) {
                    $data .= $decodeMsgByFK[$j][$i];
                }
            }
            $this->viewDecode($data);
        }
    }
}
