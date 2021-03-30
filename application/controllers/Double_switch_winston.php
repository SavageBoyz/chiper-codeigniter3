<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Double_switch_winston extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->library('form_validation');
		$this->load->helper(array('form', 'url'));
	}

	/**
	 * Фукция для вывода страницы шифровки. Шифр двойной перстановки Уинстона
	 *
	 */
	public function viewEncrypt($request = "")
	{
		$this->load->view('templates/header', $request);
		$this->load->view('templates/sidebar');
		$this->load->view('chiper/double_switch_winston/double_switch_winston_e');
		$this->load->view('templates/footer');
	}

	/**
	 * Фукция для кодировки. Шифр двойной перстановки Уинстона
	 *
	 */
	public function encrypt()
	{
		$msg = $this->input->post('msg');
		$rowCount = 7;
		$columnCount = 5;
		$firstTable = array_fill(0, $rowCount, array());
		$secondTable = array_fill(0, $rowCount, array());

		if ($this->form_validation->run('double_switch_winston') == FALSE) {
			$this->viewEncrypt();
		} else {
			/* Работа с сообщением */
			$msgLength = mb_strlen($msg);

			if ($msgLength % 2 == 1) {
				$msg .= '_';
			}

			$msg = str_replace(" ", "_", $msg);
			$msg = mb_strtoupper($msg);
			$msg = mb_str_split($msg, 2);


			for ($i = 0; $i < count($msg); $i++) {
				$msg[$i] = mb_str_split($msg[$i], 1);
			}
			/*************************/

			/* Работа с 1 таблицей */
			$alphabetCount = 0;

			for ($i = 0; $i < $rowCount; $i++) {
				for ($j = 0; $j < $columnCount; $j++) {
					array_push($firstTable[$i], SHORT_ALPHABET[$alphabetCount]);
					$alphabetCount++;
				}
			}

			for ($i = 0; $i < count(SHORT_ALPHABET); $i++) {
				$rowRandomF = rand(0, 6);
				$rowRandomS = rand(0, 6);

				$columnRandomF = rand(0, 4);
				$columnRandomS = rand(0, 4);

				[$firstTable[$rowRandomF][$columnRandomF], $firstTable[$rowRandomS][$columnRandomS]] = [$firstTable[$rowRandomS][$columnRandomS], $firstTable[$rowRandomF][$columnRandomF]];
			}
			/**********************/

			/* Работа со 2 таблицей */
			$alphabetCount = 0;

			for ($i = 0; $i < $rowCount; $i++) {
				for ($j = 0; $j < $columnCount; $j++) {
					array_push($secondTable[$i], SHORT_ALPHABET[$alphabetCount]);
					$alphabetCount++;
				}
			}

			for ($i = 0; $i < count(SHORT_ALPHABET); $i++) {
				$rowRandomF = rand(0, 6);
				$rowRandomS = rand(0, 6);

				$columnRandomF = rand(0, 4);
				$columnRandomS = rand(0, 4);

				[$secondTable[$rowRandomF][$columnRandomF], $secondTable[$rowRandomS][$columnRandomS]] = [$secondTable[$rowRandomS][$columnRandomS], $secondTable[$rowRandomF][$columnRandomF]];
			}
			/************************/

			$str = '';
			for ($i = 0; $i < count($msg); $i++) {
				for ($j = 0; $j < $rowCount; $j++) {
					$temp = array_search($msg[$i][0], $firstTable[$j]);
					if (is_numeric($temp)) {
						$keyFirst[0] = $j;
						$keyFirst[1] = $temp;
						break;
					}
				}

				for ($q = 0; $q < $rowCount; $q++) {
					$temp = array_search($msg[$i][1], $secondTable[$q]);
					if (is_numeric($temp)) {
						$keySecond[0] = $q;
						$keySecond[1] = $temp;
						break;
					}
				}

				if ($keyFirst[0] == $keySecond[0]) {
					$str .= $secondTable[$keyFirst[0]][$keyFirst[1]];
					$str .= $firstTable[$keySecond[0]][$keySecond[1]];
					continue;
				}
				$str .= $secondTable[$keyFirst[0]][$keySecond[1]];
				$str .= $firstTable[$keySecond[0]][$keyFirst[1]];
			}

			$data = [
				'msg' => $str,
				'table_1' => $firstTable,
				'table_2' => $secondTable
			];
			$this->viewEncrypt($data);
		}
	}
}
