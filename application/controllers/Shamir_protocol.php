<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Shamir_protocol extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
	}

	/**
	 * Вывод страницы с протоколом Шамира
	 *
	 */
	public function viewEncrypt($request = "")
	{
		$data['info'] = $request;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('chiper/shamir_protocol/shamir_protocol');
		$this->load->view('templates/footer');
	}

	/**
	 * Главная функция протокола Шамира
	 */
	public function encrypt()
	{
		$logs = 'Исходные данные:'.PHP_EOL;
		$logs .= 'p: '.p.PHP_EOL;
		$logs .= 'Сообщение: '.msg.PHP_EOL;

		/* I stage */
		$logs .= PHP_EOL."\t I этап. Генерация ключей \t".PHP_EOL;

		$key_A = $this->generateKey('a');
		$key_B = $this->generateKey('b');

		$logs .= PHP_EOL.'Ключи абонента А:'.PHP_EOL;

		foreach ($key_A as $key => $value){
			$logs .= $key.': '.$value.PHP_EOL;
		}

		$logs .= PHP_EOL.'Ключи абонента B:'.PHP_EOL;

		foreach ($key_B as $key => $value){
			$logs .= $key.': '.$value.PHP_EOL;
		}

		/* II stage */
		$logs .= PHP_EOL."\t II этап. Кодировка сообщения в ASCII код \t".PHP_EOL;

		$ASCII_msg = $this->convertToASCII(str_split(msg));
		$logs .= PHP_EOL.'Закодированное сообщение: '.PHP_EOL;

		foreach ($ASCII_msg as $key => $value){
			$logs .= $key.': '.$value.PHP_EOL;
		}

		/* III stage */
		$logs .= PHP_EOL."\t III этап. Трехпроходной алгоритм Шамира \t".PHP_EOL;

		$C_1 = $this->getC($ASCII_msg, $key_A['e_a']);
		$logs .= PHP_EOL.'Получим С_1:'.PHP_EOL;

		foreach ($ASCII_msg as $key => $value){
			$logs .= $key.': '.$value.'^'.$key_A['e_a'].'mod('.p.')'.'= '.$C_1[$key].PHP_EOL;
		}
		$logs .= PHP_EOL.'>>Отпралвяем С_1 абоненту B'.PHP_EOL;

		$C_2 = $this->getC($C_1, $key_B['e_b']);
		$logs .= PHP_EOL.'Получим С_2:'.PHP_EOL;

		foreach ($C_1 as $key => $value){
			$logs .= $key.': '.$value.'^'.$key_B['e_b'].'mod('.p.')'.'= '.$C_2[$key].PHP_EOL;
		}
		$logs .= PHP_EOL.'>>Отпралвяем С_2 абоненту A'.PHP_EOL;

		$C_3 = $this->getC($C_2, $key_A['d_a']);
		$logs .= PHP_EOL.'Получим С_3:'.PHP_EOL;

		foreach ($C_2 as $key => $value){
			$logs .= $key.': '.$value.'^'.$key_A['d_a'].'mod('.p.')'.'= '.$C_3[$key].PHP_EOL;
		}
		$logs .= PHP_EOL.'>>Отпралвяем С_3 абоненту B'.PHP_EOL;

		$logs .= PHP_EOL."\t IV этап. Конечное сообщение".PHP_EOL;

		$msg_ASCII = $this->getC($C_3, $key_B['d_b']);
		$output_msg = implode($this->convertToUTF8($msg_ASCII));

		$logs .= PHP_EOL.'Получим сообщения в виде ASCII:'.PHP_EOL;
		foreach ($C_3 as $key => $value){
			$logs .= $key.': '.$value.'^'.$key_B['d_b'].'mod('.p.')'.'= '.$msg_ASCII[$key].PHP_EOL;
		}
		$logs .= PHP_EOL.'Переведем символы из ASCII в UTF-8 и получим сообщение: '.$output_msg.PHP_EOL;

		$this->viewEncrypt($logs);
	}

	/**
	 * @param $array - массив символов
	 * @param $key - ключ
	 * @param string $postfix - алиас для переменной
	 * @return array
	 */
	public function getC($array, $key){
		for($i = 0; $i < count($array); $i++){
			$C[] = $this->binaryExpAlgorithm($array[$i],$key,p);
		}
		return $C;
	}

	/**
	 * Генерация ключей
	 *
	 * @param string $postfix - алиас для переменной
	 * @return array
	 */
	public function generateKey($postfix = '')
	{
		do {
			${'e_' . $postfix} = rand(2, p - 1);
			if (gmp_gcd(${'e_' . $postfix}, p - 1) == 1) {
				break;
			}
		} while (true);

		${'d_' . $postfix} = $this->extendedEuclideanAlgorithm(${'e_' . $postfix}, (p - 1));

		return array(
			'e_' . $postfix => ${'e_' . $postfix},
			'd_' . $postfix => ${'d_' . $postfix}
		);
	}

	/**
	 * Кодировка символов массива в ASCII
	 *
	 * @param array $array - массив данных
	 * @return array
	 */
	public function convertToASCII($array)
	{
		foreach ($array as &$item) {
			$item = ord($item);
		}
		return $array;
	}

	/**
	 * Кодировка символов массива в UTF-8
	 *
	 * @param array $array - массив данных
	 * @return array
	 */
	public function convertToUTF8($array)
	{
		foreach ($array as &$item) {
			$item = chr($item);
		}
		return $array;
	}

	/**
	 * Расширенный алгоритм Евклида
	 *
	 * @param integer $A - основание степени
	 * @param integer $B - модуль
	 * @param integer $power - показатель степени
	 *
	 */
	public function extendedEuclideanAlgorithm($A, $B, $power = -1)
	{
		$r__1 = $A;
		$x__1 = 1;
		$y__1 = 0;

		$r_0 = $B;
		$x_0 = 0;
		$y_0 = 1;

		$this->session->set_userdata('r_0', $r_0);
		for ($i = 1; $i < 100; $i++) {
			if ($i > 1) {
				${'d_' . $i} = intval($_SESSION['r_' . ($i - 2)] / $_SESSION['r_' . ($i - 1)]);
				${'r_' . $i} = intval($_SESSION['r_' . ($i - 2)] - ${'d_' . $i} * $_SESSION['r_' . ($i - 1)]);
				${'x_' . $i} = intval($_SESSION['x_' . ($i - 2)] - ${'d_' . $i} * $_SESSION['x_' . ($i - 1)]);
				${'y_' . $i} = intval($_SESSION['y_' . ($i - 2)] - ${'d_' . $i} * $_SESSION['y_' . ($i - 1)]);
			} else {
				${'d_' . $i} = intval($r__1 / $r_0);
				${'r_' . $i} = intval($r__1 - ${'d_' . $i} * $r_0);
				${'x_' . $i} = intval($x__1 - ${'d_' . $i} * $x_0);
				${'y_' . $i} = intval($y__1 - ${'d_' . $i} * $y_0);
			}

			$this->session->set_userdata('r_' . $i, ${'r_' . $i});
			$this->session->set_userdata('x_' . $i, ${'x_' . $i});
			$this->session->set_userdata('y_' . $i, ${'y_' . $i});

			if (${'r_' . $i} == 1) {
				$output = ${'x_' . $i} < 0 ? $B + ${'x_' . $i} : ${'x_' . $i};

				for ($j = 0; $j <= $i; $j++)
					unset(
						$_SESSION['r_' . $j],
						$_SESSION['x_' . $j],
						$_SESSION['y_' . $j]
					);
				return $output;
			}
		}
		return -1;
	}

	/**
	 * Двоичный алгоритм возведения в степень
	 *
	 * @param integer $base_degree - основание степени
	 * @param integer $power - показатель степени
	 * @param integer $module - модуль
	 *
	 */
	public function binaryExpAlgorithm($base_degree, $power, $module)
	{
		$output = 1;
		while ($power != 0) {
			if ($power % 2 == 1) {
				$output = $output * $base_degree % $module;
			}

			$power = intval($power / 2);
			$base_degree = $base_degree * $base_degree % $module;
		}
		return $output;
	}
}
