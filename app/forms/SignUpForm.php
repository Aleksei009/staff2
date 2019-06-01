<?php

namespace Staff\Forms;

use Phalcon\Forms\Form;

use Phalcon\Forms\Element\Text;
use Phalcon\Forms\Element\Hidden;
use Phalcon\Forms\Element\Password;
use Phalcon\Forms\Element\Submit;
use Phalcon\Forms\Element\Check;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\Identical;
use Phalcon\Validation\Validator\StringLength;
use Phalcon\Validation\Validator\Confirmation;

class SignUpForm extends Form
{
    public function initialize($entity = null, $options = null)
    {
        $name = new Text('name',[
            'placeholder' => 'name',
            'class' => 'form-control'
        ]);
        $name->setLabel('Name');
        $name->addValidators([
            new PresenceOf([
                'message' => 'The name is required'
            ])
        ]);
        $this->add($name);

        // Email
        $email = new Text('email',
            [
                'placeholder' => 'email',
                'class' => 'form-control'
            ]
            );
        $email->setLabel('E-Mail');
        $email->addValidators([
            new PresenceOf([
                'message' => 'The e-mail is required'
            ]),
            new Email([
                'message' => 'The e-mail is not valid'
            ])
        ]);
        $this->add($email);

        // Password
        $password = new Text('password',
            [
                'placeholder' => 'password',
                'class' => 'form-control'
            ]
            );
       // $password->setLabel('Password');

        $password->addValidators([
            new PresenceOf([
                'message' => 'The password is required',

            ]),
            new StringLength([
                'min' => 8,
                'messageMinimum' => 'Password is too short. Minimum 8 characters'
            ])
        ]);
        $this->add($password);

        // Remember
        $terms = new Check('terms', [
            'value' => 'yes',
        ]);
        $terms->setLabel('Accept terms and conditions');
        $terms->addValidator(new Identical([
            'value' => 'yes',
            'message' => 'Terms and conditions must be accepted'
        ]));
        $this->add($terms);
        // CSRF
        $csrf = new Hidden('csrf');
        $csrf->addValidator(new Identical([
            'value' => $this->security->getSessionToken(),
            'message' => 'CSRF validation failed'
        ]));
        $csrf->clear();

        $this->add($csrf);
        // Sign Up
        $this->add(new Submit('Sign Up', [
            'class' => 'btn btn-success'
        ]));
    }

    /**
     * Prints messages for a specific element
     */
    public function messages($name)
    {
        if ($this->hasMessagesFor($name)) {
            foreach ($this->getMessagesFor($name) as $message) {
                $this->flash->error($message);
            }
        }
    }

}