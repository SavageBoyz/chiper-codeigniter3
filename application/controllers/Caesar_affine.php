<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Caesar_affine extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
	}

	/**
	 * Фукция для вывода страницы шифровки. Шифр Цезаря с Афинной перестановкой
	 *
	 */
	public function viewEncrypt($request = "")
	{
		$data['info'] = $request;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('chiper/caesar_affine/caesar_affine_e');
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
		$this->load->view('chiper/caesar_affine/caesar_affine_d');
		$this->load->view('templates/footer');
	}

	/**
	 * Фукция для кодировки. Шифр Цезаря с Афинной перестановкой
	 *
	 */
	public function encrypt()
	{
		$this->form_validation->set_error_delimiters('> ', '');

		if ($this->form_validation->run('caesar_affine') == FALSE) {
			$this->viewEncrypt();
		} else {
			$msg = $this->input->post('msg');
			$numFirst = $this->input->post('numFirst');
			$numSecond = $this->input->post('numSecond');

			$msg = str_replace(" ", "_", $msg);
			$msg = mb_strtoupper($msg);
			$msg = mb_str_split($msg);

			for ($i = 0; $i < count(ALPHABET); $i++) {
				$encryptAlphabet[ALPHABET[$i]] = ALPHABET[($numFirst * $i + $numSecond) % count(ALPHABET)];
			}

			$data = '';
			for ($i = 0; $i < count($msg); $i++) {
				if ($msg[$i] == '_') {
					$data .= '_';
				}
				$data .= $encryptAlphabet[$msg[$i]];
			}
			$this->viewEncrypt($data);
		}
	}

	/**
	 * Фукция для дешифровки. Шифр Цезаря с Афинной перестановкой
	 *
	 */
	public function decode()
	{
		$this->form_validation->set_error_delimiters('> ', '');

		if ($this->form_validation->run('caesar_affine') == FALSE) {
			$this->viewDecode();
		} else {
			$msg = $this->input->post('msg');
			$numFirst = $this->input->post('numFirst');
			$numSecond = $this->input->post('numSecond');

			$msg = str_replace(" ", "_", $msg);
			$msg = mb_strtoupper($msg);
			$msg = mb_str_split($msg);

			for ($i = 0; $i < count(ALPHABET); $i++) {
				$encryptAlphabet[ALPHABET[$i]] = ALPHABET[($numFirst * $i + $numSecond) % count(ALPHABET)];
			}

			$data = '';
			for ($i = 0; $i < count($msg); $i++) {
				if ($msg[$i] == '_') {
					$data .= '_';
				}
				$data .= array_search($msg[$i],$encryptAlphabet);
			}
			$this->viewDecode($data);
		}
	}
}

