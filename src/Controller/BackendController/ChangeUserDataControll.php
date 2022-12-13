<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\Redirect;
use App\Core\ViewInterface;
use App\Model\UserRepositoryInterface;
use App\Validation\UserDataValidation;

class ChangeUserDataControll  implements ControllerInterface
{
    private array $userDataSet = [];
    private array $errors = [];

    public function __construct(
        private ViewInterface $view,
        private UserRepositoryInterface $repository,
        private UserDataValidation $userDataValidation,
        private Redirect $redirect
    ) {
    }

    public function renderView(): void
    {
        $userName = $_SESSION['userName'];
        $userData = $this->repository->getCurrentUserData($userName);

        $this->userDataSet['Username'] = $userData->userName;
        $this->userDataSet['First Name'] = $userData->firstName;
        $this->userDataSet['Last Name'] = $userData->lastName;
        $this->userDataSet['Country'] = $userData->country;
        $this->userDataSet['Postcode'] = $userData->postcode;
        $this->userDataSet['City'] = $userData->city;
        $this->userDataSet['Street'] = $userData->street;
        $this->userDataSet['Streetnumber'] = $userData->streetNumber;
        $this->userDataSet['E-Mail'] = $userData->email;
        $this->userDataSet['Telefonnumber'] = $userData->telefonNumber;

        if (isset($_POST['submit'])) {
            $userDataFromForm = $_POST;
            $userDataFromDB = $this->userDataSet;

            if ($userDataFromDB['Username'] != $userDataFromForm['Username']) {
                $this->repository->changeUserAttributeByAttribiute(
                    $userDataFromForm['Username'],
                    'userName',
                    $userDataFromDB['Username'],
                    $userName
                );
            }
            if ($userDataFromDB['First Name'] != $userDataFromForm['First_Name']) {
                $this->repository->changeUserAttributeByAttribiute(
                    $userDataFromForm['First_Name'],
                    'firstName',
                    $userDataFromDB['First Name'],
                    $userName
                );
            }
            if ($userDataFromDB['Last Name'] != $userDataFromForm['Last_Name']) {
                $this->repository->changeUserAttributeByAttribiute(
                    $userDataFromForm['Last_Name'],
                    'lastName',
                    $userDataFromDB['LastName'],
                    $userName
                );
            }
            if ($userDataFromDB['Country'] != $userDataFromForm['Country']) {
                $this->repository->changeUserAttributeByAttribiute(
                    $userDataFromForm['Country'],
                    'country',
                    $userDataFromDB['Country'],
                    $userName
                );
            }
            if ($userDataFromDB['Postcode'] != $userDataFromForm['Postcode']) {
                $this->repository->changeUserAttributeByAttribiute(
                    $userDataFromForm['Postcode'],
                    'postcode',
                    $userDataFromDB['Postcode'],
                    $userName
                );
            }
            if ($userDataFromDB['City'] != $userDataFromForm['City']) {
                $this->repository->changeUserAttributeByAttribiute(
                    $userDataFromForm['City'],
                    'city',
                    $userDataFromDB['City'],
                    $userName
                );
            }
            if ($userDataFromDB['Street'] != $userDataFromForm['Street']) {
                $this->repository->changeUserAttributeByAttribiute(
                    $userDataFromForm['Street'],
                    'street',
                    $userDataFromDB['Street'],
                    $userName
                );
            }
            if ($userDataFromDB['Streetnumber'] != $userDataFromForm['Streetnumber']) {
                $this->repository->changeUserAttributeByAttribiute(
                    $userDataFromForm['Streetnumber'],
                    'Streetnumber',
                    $userDataFromDB['Streetnumber'],
                    $userName
                );
            }
            if ($userDataFromDB['E-Mail'] != $userDataFromForm['E-Mail']) {
                $this->repository->changeUserAttributeByAttribiute(
                    $userDataFromForm['E-Mail'],
                    'email',
                    $userDataFromDB['E-Mail'],
                    $userName
                );
            }
            if ($userDataFromDB['Telefonnumber'] != $userDataFromForm['Telefonnumber']) {
                $this->repository->changeUserAttributeByAttribiute(
                    $userDataFromForm['Telefonnumber'],
                    'telefonnumber',
                    $userDataFromDB['Telefonnumber'],
                    $userName
                );
            }
        }

        $userExists = $this->userDataValidation->userNameExist($userName);
        if ($userExists != true) {
            $this->redirect->to('index.php');
        }

        $userData = $this->repository->getCurrentUserData($userName);

        $this->userDataSet['Username'] = $userData->userName;
        $this->userDataSet['First Name'] = $userData->firstName;
        $this->userDataSet['Last Name'] = $userData->lastName;
        $this->userDataSet['Country'] = $userData->country;
        $this->userDataSet['Postcode'] = $userData->postcode;
        $this->userDataSet['City'] = $userData->city;
        $this->userDataSet['Street'] = $userData->street;
        $this->userDataSet['Streetnumber'] = $userData->streetNumber;
        $this->userDataSet['E-Mail'] = $userData->email;
        $this->userDataSet['Telefonnumber'] = $userData->telefonNumber;
        $this->view->addTemplateParameter('errors', $this->errors);
        $this->view->addTemplateParameter('items', $this->userDataSet);
        $this->view->setTemplate('changeUserData.tpl');
    }
}