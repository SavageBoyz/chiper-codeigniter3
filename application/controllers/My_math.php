<?php
defined('BASEPATH') or exit('No direct script access allowed');


class My_math extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('url');
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
	 * Нахождение момуля( работает с отрицательными значениями)
	 * @param $a
	 * @param $b
	 * @return string|null
	 */
	function mod($a, $b)
	{
		$r = bcmod($a, $b);
		return $r < 0 ? $r + $b : $r;
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

	/**
	 * Кодировка символов массива в ASCII
	 *
	 * @param array $array - массив данных
	 * @return array
	 */
	public function convertToASCII( $array)
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
	 * @param array $array - массив символов
	 * @param $key - ключ
	 * @param $module - модуль
	 *
	 *
	 * @return array
	 */
	public function getC($array, $key, $module){
		for($i = 0; $i < count($array); $i++){
			$C[] = $this->binaryExpAlgorithm($array[$i], $key, $module);
		}
		return $C;
	}
}
