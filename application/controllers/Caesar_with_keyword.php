<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Caesar_with_keyword extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('form_validation');
        $this->load->helper(array('form', 'url'));
    }

    /**
     * Фукция для вывода страницы шифровки. Шифр Цезаря с ключевым словом
     * 
     */
    public function viewEncrypt($request = "")
    {
        $data['info'] = $request;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('chiper/caesar_with_keyword/caesar_with_keyword_e');
        $this->load->view('templates/footer');
    }

    /**
     * Фукция для вывода страницы дешифровки. Шифр Цезаря с ключевым словом
     * 
     */
    public function viewDecode($request = "")
    {
        $data['info'] = $request;
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('chiper/caesar_with_keyword/caesar_with_keyword_d');
        $this->load->view('templates/footer');
    }

    /**
     * Фукция для кодировки. Шифр Цезаря с ключевым словом
     * 
     */
    public function encrypt()
    {
        /* Валидация */
        $this->form_validation->set_error_delimiters('> ', '');

        if ($this->form_validation->run('caesar_with_keyword') == FALSE) {
            $this->viewEncrypt();
        } else {

            /* Работа с введенными в форму данными */
            $keyFirst = $this->input->post('keyFirst');
            $num = $this->input->post('num');
            $msg = $this->input->post('msg');

            $msg = str_replace(" ", "_", $msg);
            $keyFirst = str_replace(" ", "", $keyFirst);

            $keyFirst = mb_strtoupper($keyFirst);
            $msg = mb_strtoupper($msg);

            $keyFirst = mb_str_split($keyFirst);
            $msg = mb_str_split($msg);

            $keyFirst = array_unique($keyFirst);

            $temp = array_diff(ALPHABET, $keyFirst);
            $temp = array_values($temp);

            $keyFirst = array_values($keyFirst);
            /***************************************/

            /* Формирование побочного алфавита */
            for ($i = (count($temp) - $num); $i < count($temp); $i++) {
                $sideCodingA[] = $temp[$i];
            }

            for ($i = 0; $i < count($keyFirst); $i++) {
                $sideCodingA[] = $keyFirst[$i];
            }

            for ($i = 0; $i < count($temp) - $num; $i++) {
                $sideCodingA[] = $temp[$i];
            }
            /********************************/

            /* Создание таблицы для работы */
            for ($i = 0; $i < count(ALPHABET); $i++) {
                $mainCodingA[] = array(ALPHABET[$i] => $sideCodingA[$i]);
            }
            /****************************/

            /* Вывод сообщения */
            $str = "";
            foreach ($msg as $value) {
                for ($i = 0; $i < count($mainCodingA); $i++) {
                    if ($value == ALPHABET[$i]) {
                        $str .= $mainCodingA[$i][ALPHABET[$i]];
                        break;
                    } else if ($value == "_") {
                        $str .= "_";
                        break;
                    }
                }
            }
            $this->viewEncrypt($str);
            /*******************/
        }
    }

    /**
     * Фукция для дешифровки. Шифр Цезаря с ключевым словом
     * 
     */
    public function decode()
    {
        $this->form_validation->set_error_delimiters('> ', '');

        if ($this->form_validation->run('caesar_with_keyword') == FALSE) {
            $this->viewDecode();
        } else {
            /* Работа с введенными в форму данными */
            $keyFirst = $this->input->post('keyFirst');
            $num = $this->input->post('num');
            $msg = $this->input->post('msg');

            $msg = str_replace(" ", "_", $msg);
            $keyFirst = str_replace(" ", "", $keyFirst);

            $keyFirst = mb_strtoupper($keyFirst);
            $msg = mb_strtoupper($msg);

            $keyFirst = mb_str_split($keyFirst);
            $msg = mb_str_split($msg);

            $keyFirst = array_unique($keyFirst);

            $temp = array_diff(ALPHABET, $keyFirst);
            $temp = array_values($temp);

            $keyFirst = array_values($keyFirst);
            /***************************************/

            /* Формирование побочного алфавита */
            for ($i = (count($temp) - $num); $i < count($temp); $i++) {
                $sideCodingA[] = $temp[$i];
            }

            for ($i = 0; $i < count($keyFirst); $i++) {
                $sideCodingA[] = $keyFirst[$i];
            }

            for ($i = 0; $i < count($temp) - $num; $i++) {
                $sideCodingA[] = $temp[$i];
            }
            /********************************/

            /* Создание таблицы для работы */
            for ($i = 0; $i < count(ALPHABET); $i++) {
                $mainCodingA[] = array(ALPHABET[$i] => $sideCodingA[$i]);
            }
            /****************************/

            /* Вывод сообщения */
            $str = "";
            foreach ($msg as $value) {
                for ($i = 0; $i < count($mainCodingA); $i++) {
                    if ($value == $mainCodingA[$i][ALPHABET[$i]]) {
                        $str .= ALPHABET[$i];
                        break;
                    } else if ($value == "_") {
                        $str .= "_";
                        break;
                    }
                }
            }
            $this->viewDecode($str);
            /*******************/
        }
    }
}
