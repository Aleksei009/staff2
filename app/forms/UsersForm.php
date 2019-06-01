<?php

namespace Staff\Forms;

use Phalcon\Forms\Form;
use Phalcon\Forms\Element\Text;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;

class UsersForm extends Form
{
    public function initialize()
    {

        $name = new Text('name', [
            'placeholder' => 'Name',
            'class' => 'form-control'
        ]);
        $name->addValidators([
            new PresenceOf([
                'message' => 'The name is required'
            ])
        ]);
        $this->add($name);

        $email = new Text('email', [
            'placeholder' => 'Email',
            'class' => 'form-control'
        ]);
        $email->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required'
            ]),
            new Email([
                'message' => 'The e-mail is not valid'
            ])
        ]);
        $this->add($email);
    }
}