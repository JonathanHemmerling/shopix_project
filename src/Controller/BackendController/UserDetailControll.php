<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\UserRepository;

class UserDetailControll implements ControllerInterface
{
    public function __construct(private ViewInterface $view, private UserRepository $userRepository)
    {
    }

    public function renderView(): void
    {
        if (isset($_POST['submit'])) {
            $userDataFromForm = $_POST;
            $userName = $_GET['userName'];
            $userData = $this->userRepository->getCurrentUserData($userName);
            $userDataSet = [
                'userName' => $userDataFromForm['Username'],
                'firstName' => $userDataFromForm['First_Name'],
                'lastName' => $userDataFromForm['Last_Name'],
                'country' => $userDataFromForm['Country'],
                'postcode' => $userDataFromForm['Postcode'],
                'city' => $userDataFromForm['City'],
                'street' => $userDataFromForm['Street'],
                'streetNumber' => $userDataFromForm['Streetnumber'],
                'email' => $userDataFromForm['E-Mail'],
                'telefonNumber' => $userDataFromForm['Telefonnumber'],
            ];
            $userId = $userData->id;
            $this->userRepository->changeUserDataByUserId($userId, $userDataSet);
            unset($_POST);
        }
        $userName = $_GET['userName'];
        $singleUser = [];
        $userData = $this->userRepository->getCurrentUserData($userName);
        $singleUser['Username'] = $userData->userName;
        $singleUser['First Name'] = $userData->firstName;
        $singleUser['Last Name'] = $userData->lastName;
        $singleUser['Country'] = $userData->country;
        $singleUser['Postcode'] = $userData->postcode;
        $singleUser['City'] = $userData->city;
        $singleUser['Street'] = $userData->street;
        $singleUser['Streetnumber'] = $userData->streetNumber;
        $singleUser['E-Mail'] = $userData->email;
        $singleUser['Telefonnumber'] = $userData->telefonNumber;

        $this->view->addTemplateParameter('singleUser', $singleUser);

        $this->view->setTemplate('userDetail.tpl');
    }
}