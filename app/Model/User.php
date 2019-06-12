<?php
//app/Model/User.php

App::uses('AppModel', 'Model');
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

class User extends AppModel {
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A username is required'
            ),
            'required' => array(
                'rule' => 'isUnique',
                'message' => 'The username is already in use'
            )

        ),
        'email' => array(
            'required' => array(
                'rule' => array('email', true),
                'message' => 'Please enter valid email address'
            ),
            'required' => array(
                'rule' => 'isUnique',
                'message' => 'The email is already in use'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => 'notBlank',
                'message' => 'A password is required'
            )
        )
    );

    public function beforeSave($options = array()) {
        if (isset($this->data[$this->alias]['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data[$this->alias]['password'] = $passwordHasher->hash(
                $this->data[$this->alias]['password']
            );
        }
        return true;
    }

}
?>

