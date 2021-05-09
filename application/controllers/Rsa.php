<?php
defined('BASEPATH') or exit('No direct script access allowed');
require APPPATH.'controllers/My_math.php';
/* Данные для RSA */
define(p,397);
define(q,523);

define(msg,'CRUISE');


class Rsa extends My_math
{
	/**
	 * Вывод страницы с протоколом Шамира
	 *
	 */
	public function viewEncrypt($request = "")
	{
		$data['info'] = $request;
		$this->load->view('templates/header', $data);
		$this->load->view('templates/sidebar');
		$this->load->view('chiper/rsa/rsa');
		$this->load->view('templates/footer');

	}

	/**
	 * Главная функция RSA
	 */
	public function encrypt()
	{

		$logs = 'Исходные данные:'.PHP_EOL;
		$logs .= 'p: '.p.PHP_EOL;
		$logs .= 'q: '.q.PHP_EOL;
		$logs .= 'Сообщение: '.msg.PHP_EOL;
		$logs .= 'Сообщение хочет получить абонент B от абонента А'.PHP_EOL;
		$logs .= PHP_EOL."\t У абонента B: \t".PHP_EOL;

		$keys = $this -> generateKeys();
		$logs .= PHP_EOL."\t I этап. Генерация ключей. \t".PHP_EOL;
		foreach ($keys as $key => $value){
			$logs .= $key.': '.$value.PHP_EOL;
		}
		$logs .= "Aбонент В передает открытый ключ (e,n) = ({$keys['e']},{$keys['n']}) абоненту А".PHP_EOL;

		$logs .= PHP_EOL."\t У абонента A: \t".PHP_EOL;
		$ASCII_msg = $this->convertToASCII(str_split(msg));
		$logs .= PHP_EOL."\t II этап. Преобразование открытого текста в числовой эквивалент. \t".PHP_EOL;
		for($i = 0; $i < count($ASCII_msg);$i++){
			$logs .= msg[$i].'- '.$ASCII_msg[$i].PHP_EOL;
		}

		$logs .= PHP_EOL."\t III этап. Шифрование. \t".PHP_EOL;
		$countC = 0;
		foreach ($ASCII_msg as $value){
			$C[] = $this->binaryExpAlgorithm($value, $keys['e'], $keys['n']);
			$logs .= $value.'- '.$C[$countC].PHP_EOL;
			$countC++;
		}

		$logs .= PHP_EOL."\t IV этап. Преобразование шифртекста в 16-ое представление.\t".PHP_EOL;
		$countC = 0;
		foreach ($C as $value){
			$C_hex[] = dechex($value);
			$logs .= $value.'- '.$C_hex[$countC].PHP_EOL;
			$countC++;
		}

		$logs .= PHP_EOL.'>>Отпралвяем С абоненту B'.PHP_EOL;
		$logs .= PHP_EOL."\t У абонента B: \t".PHP_EOL;
		$logs .= PHP_EOL."\t V этап. Преобразование шифртекста в 10-ое представление.\t".PHP_EOL;
		$countC = 0;
		foreach ($C_hex as $value){
			$C_dec[] = hexdec($value);
			$logs .= $value.'- '.$C_dec[$countC].PHP_EOL;
			$countC++;
		}

		$logs .= PHP_EOL."\t VI этап. Расшифровка сообщения.\t".PHP_EOL;
		$countC = 0;
		foreach ($C_dec as $value){
			$output_msg[] = $this->binaryExpAlgorithm($value, $keys['d'], $keys['n']);
			$logs .= $value.'- '.$C_dec[$countC].PHP_EOL;
			$countC++;
		}

		$logs .= PHP_EOL."\t VII этап. Восстановление символьного представления.\t".PHP_EOL;
		$output_msg = $this->convertToUTF8($output_msg);
		$logs .= implode($output_msg);
		$this->viewEncrypt($logs);
	}

	/**
	 * Генерация ключей
	 *
	 * @return array
	 */
	public function generateKeys(){
		$n = p * q;
		$f_n = (p - 1) * (q - 1);
		do{
			$e = rand(2, $f_n - 1);
			if(gmp_prob_prime($e) == 2 && gmp_gcd($e, $f_n) == 1){
				break;
			}
		}while(true);
		for($i = 0; $i < $n; $i++){
			if(($i * $e) % ($f_n) == 1){
				$available_d[] = $i;
			}
		}
		$d = $available_d[rand(0, count($available_d) - 1)];
		return array(
			'n' => $n,
			'f(n)' => $f_n,
			'e' => $e,
			'd' => $d
		);
	}
}
