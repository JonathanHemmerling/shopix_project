<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\UserRepositoryInterface;

class UserSingleRecordControll implements ControllerInterface
{
    private array $errors = [];
    private array $changedUser = [];

    public function __construct(
        private readonly ViewInterface $view,
        private readonly UserRepositoryInterface $repository
    ) {
    }

    public function renderView(): void
    {
        if (isset($_POST['submit'])) {
            $userDataFromForm = $_POST;
            $userId = (int)$_GET['userId'];
            $this->repository->editUserAttributeById($userId, 'userName', $userDataFromForm['Username']);
            $this->repository->editUserAttributeById($userId, 'firstName', $userDataFromForm['First_Name']);
            $this->repository->editUserAttributeById($userId, 'lastName', $userDataFromForm['Last_Name']);
            $this->repository->editUserAttributeById($userId, 'country', $userDataFromForm['Country']);
            $this->repository->editUserAttributeById($userId, 'postcode', $userDataFromForm['Postcode']);
            $this->repository->editUserAttributeById($userId, 'city', $userDataFromForm['City']);
            $this->repository->editUserAttributeById($userId, 'street', $userDataFromForm['Street']);
            $this->repository->editUserAttributeById($userId, 'streetNumber', $userDataFromForm['Streetnumber']);
            $this->repository->editUserAttributeById($userId, 'email', $userDataFromForm['E-Mail']);
            $this->repository->editUserAttributeById($userId, 'telefonNumber', $userDataFromForm['Telefonnumber']);
        }

        $userData = $this->repository->getCurrentUserDataById($_SESSION['userId']);

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
        $this->view->addTemplateParameter('changedUser', $this->changedUser);
        $this->view->addTemplateParameter('errors', $this->errors);
        $this->view->addTemplateParameter('items', $this->userDataSet);
        $this->view->setTemplate('userSingleRecord.tpl');
    }
}