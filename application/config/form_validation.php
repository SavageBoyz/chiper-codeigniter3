<?php
/*
*
* Validation
*
*/

$config = array(
	'double_chiper' => array(
		array(
			'field' => 'msg',
			'label' => 'Message',
			'rules' => 'required|trim|min_length[2]|max_length[50]|msg_check|regex_match[/[А-Яа-яЁё]/u]',
			'errors' => array(
				'required' => 'Введите сообщение',
				'min_length' => 'Сообщение слишком короткое',
				'max_length' => 'Сообщение слишком длинное',
				'msg_check' => 'Длина сообщения не может быть меньше длины произведения ключей',
				'regex_match' => 'Сообщение может состоять только из букв'
			),
		),
		array(
			'field' => 'keyFirst',
			'label' => 'First key',
			'rules' => 'required|trim|min_length[2]|max_length[50]|regex_match[/[А-Яа-яЁё]/u]',
			'errors' => array(
				'required' => 'Введите значение ключа № 1',
				'min_length' => 'Ключ № 1 слишком короткий',
				'max_length' => 'Ключ № 1 слишком длинный',
				'regex_match' => 'Ключ № 1 может состоять только из букв'
			),
		),
		array(
			'field' => 'keySecond',
			'label' => 'Second key',
			'rules' => 'required|trim|min_length[2]|max_length[50]|regex_match[/[А-Яа-яЁё]/u]',
			'errors' => array(
				'required' => 'Введите значение ключа № 2',
				'min_length' => 'Ключ № 2 слишком короткий!',
				'max_length' => 'Ключ № 2 слишком длинный!',
				'regex_match' => 'Ключ № 2 может состоять только из букв!'
			),
		)
	),
	'caesar_with_keyword' => array(
		array(
			'field' => 'msg',
			'label' => 'Message',
			'rules' => 'required|trim|min_length[2]|max_length[50]|regex_match[/[А-Яа-яЁё]/u]',
			'errors' => array(
				'required' => 'Введите сообщение',
				'min_length' => 'Сообщение слишком короткое',
				'max_length' => 'Сообщение слишком длинное',
				'msg_check' => 'Длина сообщения не может быть меньше длины произведения ключей',
				'regex_match' => 'Сообщение может состоять только из букв'
			),
		),
		array(
			'field' => 'keyFirst',
			'label' => 'First key',
			'rules' => 'required|trim|min_length[2]|max_length[25]|regex_match[/[А-Яа-яЁё]/u]',
			'errors' => array(
				'required' => 'Введите значение ключа № 1',
				'min_length' => 'Ключ № 1 слишком короткий',
				'max_length' => 'Ключ № 1 слишком длинный',
				'regex_match' => 'Ключ № 1 может состоять только из букв'
			),
		),
		array(
			'field' => 'num',
			'label' => 'Number',
			'rules' => 'required|trim|greater_than_equal_to[0]|less_than_equal_to[25]',
			'errors' => array(
				'required' => 'Введите значение в поле "Число"',
				'greater_than_equal_to' => 'Число не должно быть меньше 0',
				'less_than_equal_to' => 'Число не должно быть больше 25'
			),
		)
	),
	'caesar_affine' => array(
		array(
			'field' => 'msg',
			'label' => 'Message',
			'rules' => 'required|trim|min_length[2]|max_length[50]|regex_match[/[А-Яа-яЁё]/u]',
			'errors' => array(
				'required' => 'Введите сообщение',
				'min_length' => 'Сообщение слишком короткое',
				'max_length' => 'Сообщение слишком длинное',
				'msg_check' => 'Длина сообщения не может быть меньше длины произведения ключей',
				'regex_match' => 'Сообщение может состоять только из букв'
			),
		),
		array(
			'field' => 'numFirst',
			'label' => 'First number',
			'rules' => 'required|trim|greater_than_equal_to[2]|less_than_equal_to[33]|nod_check',
			'errors' => array(
				'required' => 'Введите значение в поле "Число №1"',
				'greater_than_equal_to' => 'Число не должно быть меньше 0',
				'less_than_equal_to' => 'Число не должно быть больше 25',
				'nod_check' => 'Введите взаимно простое число с 33'
			),

		),
		array(
			'field' => 'numSecond',
			'label' => 'Second number',
			'rules' => 'required|trim|greater_than_equal_to[0]|less_than_equal_to[33]',
			'errors' => array(
				'required' => 'Введите значение в поле "Число №1"',
				'greater_than_equal_to' => 'Число не должно быть меньше 0',
				'less_than_equal_to' => 'Число не должно быть больше 25',
			),
		),
	),
	'double_switch_winston' => array(
		array(
			'field' => 'msg',
			'label' => 'Message',
			'rules' => 'required|trim|min_length[2]|max_length[50]|regex_match[/[А-Яа-яЁё]/u]',
			'errors' => array(
				'required' => 'Введите сообщение',
				'min_length' => 'Сообщение слишком короткое',
				'max_length' => 'Сообщение слишком длинное',
				'regex_match' => 'Сообщение может состоять только из букв'
			),
		),
	),
	'double_switch_winston_d' => array(
		array(
			'field' => 'msg',
			'label' => 'Message',
			'rules' => 'required|trim|min_length[2]|max_length[50]',
			'errors' => array(
				'required' => 'Введите сообщение',
				'min_length' => 'Сообщение слишком короткое',
				'max_length' => 'Сообщение слишком длинное',
			),
		),
	),
);
