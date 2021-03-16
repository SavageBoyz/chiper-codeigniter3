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
            'rules' => 'required|trim|min_length[2]|max_length[50]',
            'errors' => array(
                'required' => 'Введите сообщение',
                'min_length' => 'Сообщение слишком короткое',
                'max_length' => 'Сообщение слишком длинное',
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
);

// $this->form_validation->set_rules($config);