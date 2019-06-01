<?php

namespace Staff\Models;

use Phalcon\Validation;
use Phalcon\Validation\Validator\Email as EmailValidator;
use Phalcon\Mvc\Model;

class Users extends Model
{
    const ROLE_USER_ADMIN = 1;
    const ROLE_USER_GUEST = 0;

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $name;

    /**
     *
     * @var string
     */
    public $email;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var integer
     */
    public $role;

    /**
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation()
    {
        $validator = new Validation();

        $validator->add(
            'email',
            new EmailValidator(
                [
                    'model'   => $this,
                    'message' => 'Please enter a correct email address',
                ]
            )
        );

        return $this->validate($validator);
    }

    public function registerAdmin($data)
    {
         $this->save([
            'name' => $data['name'],
            'email' => $data['email'],
            'password'  => $data['password'],
            'role' => self::ROLE_USER_ADMIN
        ]);

        return $this;

    }
    public function registerGuest($data)
    {
        $this->save([
            'name' => $data['name'],
            'email' => $data['email'],
            'password'  => $data['password'],
            'role' => self::ROLE_USER_GUEST
        ]);
        return $this;
    }

    static public function registerUser($data)
    {
       // $role = null;

         if(self::TableHasUsers()){

             $save = self::save([
                 'name' => $data['name'],
                 'email' => $data['email'],
                 'password'  => $data['password'],
                 'role' => self::ROLE_USER_ADMIN
             ]);


         }else{
             $save = self::save([
                 'name' => $data['name'],
                 'email' => $data['email'],
                 'password'  => $data['password'],
                 'role' => self::ROLE_USER_GUEST
             ]);
         }

        return $save;
    }

    static public function TableHasUsers()
    {
        $users = self::find();

        if(count($users) == 0){
            return true;
        }else{
            return false;
        }
    }


    public function checkArticles()
    {


    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("phalcon");
        $this->setSource("users");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'users';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users[]|Users|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Users|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    public function getRoles()
    {
        return [

            self::ROLE_USER_ADMIN => "Администратор",
            self::ROLE_USER_GUEST => "Гость"

        ];
    }


}

