<?php
/**
 * Created by PhpStorm.
 * User: bartek
 * Date: 12.05.17
 * Time: 22:30
 */


namespace AppBundle\Controller;

use AppBundle\Exception\UserExistException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations\Get;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends FOSRestController
{

    public function getUsersAction()
    {
        $data = [
            ['id' => 1, 'email' => 'bartek24245@gmail.com'],
            ['id' => 2, 'email' => 'bartek24245@gmail.com'],
            ['id' => 3, 'email' => 'bartek24245@gmail.com'],
            ['id' => 4, 'email' => 'bartek24245@gmail.com'],
            ['id' => 5, 'email' => 'bartek24245@gmail.com']
        ];

        $view = $this->view($data, 200);
        return $this->handleView($view);

    }


    public function getUserAction($id)
    {
        $data = ['id' => $id, 'email' => 'bartek24245@gmail.com'];

        $view = $this->view($data, 200);
        return $this->handleView($view);

    }

    public function postUserAction(Request $request)
    {
        $data = [];
        try {
            $data = ['id' => 2, 'test' => 2, 'email' => $request->get('email'), 'name' => $request->get('name')];

            if ($request->get('email') == 'bartek24245@gmail.com') {
                throw new UserExistException('Uzytkownik o emailu ' . $request->get('email') . ' już istnieje');
            }

        } catch (\Exception $e) {
            $data['error_message'] = $e->getMessage();
            $data['error_trace'] = $e->getTraceAsString();
        }


        $view = $this->view($data, 201);
        return $this->handleView($view);
    }

    public function putUserAction($id)
    {
        $data = ['id' => $id];

        $view = $this->view($data, 201);
        return $this->handleView($view);
    }

}