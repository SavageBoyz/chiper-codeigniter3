<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'controllers/My_math.php';
define(msg,'TSP');

class Elgamal extends My_math
{
	/**
	 * Вывод страницы Эль-Гамаля
	 *
	 */
	public function viewEncrypt($request = "")
	{
		$data['info'] = $request;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('chiper/elgamal/elgamal');
		$this->load->view('templates/footer');

	}
	/**
	 * Главная функция шифровки Эль-Гамаля
	 */
	public function encrypt()
	{
		$logs = 'Исходные данные:'.PHP_EOL;
		$logs .= 'Сообщение: '.msg.PHP_EOL;
		$keys = $this->generateKeys();
		$logs .= 'p: '.$keys['p'].PHP_EOL;
		$logs .= PHP_EOL."\t У абонента A: \t".PHP_EOL;
		$logs .= PHP_EOL."\t I этап. Генерация ключей. \t".PHP_EOL;

		foreach ($keys as $key => $value){
			$logs .= $key.': '.$value.PHP_EOL;
		}

		$logs .= "Абонент A передает открытый ключ (y,g,p) = ({$keys['y']},{$keys['g']},{$keys['p']}) абоненту B".PHP_EOL;

		$logs .= PHP_EOL."\t II этап. Преобразование сообщения в числовой эквивалент. \t".PHP_EOL;
		$ASCII_msg = $this->convertToASCII(str_split(msg));

		for($i = 0; $i < count($ASCII_msg);$i++) {
			$logs .= msg[$i].'- '.$ASCII_msg[$i].PHP_EOL;
		}

		$logs .= PHP_EOL."\t III этап. Генерация ЭЦП. \t".PHP_EOL;

		for($i = 0; $i < count($ASCII_msg);$i++) {
			$electronicSignature[] = $this->generateElectronicSignature($keys['p'], $keys['g'], $ASCII_msg[$i], $keys['x']);
			$logs .= $ASCII_msg[$i].'- ('.$electronicSignature[$i]['firstPart'].', '.$electronicSignature[$i]['secondPart'].')'.PHP_EOL;
		}
		/* Проверка ЭЦП и открытой подписи */
		$logs .= PHP_EOL."\t У абонента B: \t".PHP_EOL;
		$logs .= PHP_EOL."\t IV этап. Проверка цифровой подписи. \t".PHP_EOL;
		$logs .= 'Сравниваем первую часть ЭЦП со второй:'.PHP_EOL;
		foreach ($electronicSignature as $item){
			$firstPartCheck = $this->binaryExpAlgorithm($keys['y'],$item['firstPart'],$keys['p']);
			$secondPartCheck = $this->binaryExpAlgorithm($item['firstPart'], $item['secondPart'],$keys['p']);
			$firstCheck = ($firstPartCheck * $secondPartCheck) % $keys['p'];

			$secondCheck = $this->binaryExpAlgorithm($keys['g'], $item['code'], $keys['p']);
			if($firstCheck != $secondCheck){
				$logs.= "Первая часть ({$firstCheck}) не равна второй части({$secondCheck})".PHP_EOL;
			}else{
				$logs.= "Первая часть ({$firstCheck}) равна второй части({$secondCheck})".PHP_EOL;
			}
		}
		$this->viewEncrypt($logs);
	}

	/**
	 * Генерация ЭЦП
	 *
	 * @param $p -
	 * @param $g - открытый ключ
	 * @param $ascii_code - код символа
	 * @param $x - закрытый ключ
	 *
	 * @return array - 2 части ЭЦП
	 */
	public function generateElectronicSignature($p, $g, $ascii_code, $x)
	{
		do{
			$k = rand(2,$p - 1);
			if(gmp_gcd($k,$p - 1) == 1){
				break;
			}
		}while(true);

		$firstPart = $this->binaryExpAlgorithm($g, $k, $p);

		$firstTemp = $this->mod($ascii_code - $x * $firstPart,$p - 1);
		$secondTemp = $this->extendedEuclideanAlgorithm($k,$p - 1);
		$secondPart = bcmod(($firstTemp * $secondTemp),$p - 1);
		return array(
			'code' =>$ascii_code,
			'firstPart' => intval($firstPart),
			'secondPart' => intval ($secondPart)
		);
	}

	/**
	 * Генерация ключей
	 *
	 * @return array ключи
	 */
	public function generateKeys(): array
	{
		do{
			$p = rand(255,100000);
			if(gmp_prob_prime($p) == 2){
				break;
			}
		}while(true);
		$g = rand(1,$p - 1);
		$x = rand(1,$p - 1);
		return array(
			'p' => $p,
			'g' => $g,
			'x' => $x,
			'y' => $this->binaryExpAlgorithm($g, $x, $p)
		);
	}
}
