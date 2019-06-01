<?php

namespace Staff\Services;

use Staff\Services\MainService;

use Staff\Models\Users;

class UserService extends MainService
{

    public function registerUser($data)
    {
        $users = Users::find();
        $user = new Users();

        //$data['password'] = $this->security->hash( $data['password']);

        if(count($users) >= 1){
            $user = $user->registerGuest($data);
        }else{
            $user = $user->registerAdmin($data);
        }

        return $user;

       /* if (!$user) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "users",
                'action' => 'new'
            ]);
            $this->response->redirect('');
            return;
        }else{
            $this->flashSession->success('successful');
            $this->response->redirect('');
        }*/
    }


}