<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\UserRepository;

class UserSingleRecordControll implements ControllerInterface
{
    private array $errors = [];
    private array $changedUser = [];
    private int $userId;
    private array $userDataSet = [];
    public function __construct(
        private readonly ViewInterface $view,
        private readonly UserRepository $repository
    ) {
    }

    public function renderView(): void
    {
        $this->userId = (int)$_GET['userId'];
        if (isset($_POST['submit'])) {
            $userDataFromForm = $_POST;

            $this->repository->editUserAttributeById($this->userId, 'userName', $userDataFromForm['Username']);
            $this->repository->editUserAttributeById($this->userId, 'firstName', $userDataFromForm['First_Name']);
            $this->repository->editUserAttributeById($this->userId, 'lastName', $userDataFromForm['Last_Name']);
            $this->repository->editUserAttributeById($this->userId, 'country', $userDataFromForm['Country']);
            $this->repository->editUserAttributeById($this->userId, 'postcode', $userDataFromForm['Postcode']);
            $this->repository->editUserAttributeById($this->userId, 'city', $userDataFromForm['City']);
            $this->repository->editUserAttributeById($this->userId, 'street', $userDataFromForm['Street']);
            $this->repository->editUserAttributeById($this->userId, 'streetNumber', $userDataFromForm['Streetnumber']);
            $this->repository->editUserAttributeById($this->userId, 'email', $userDataFromForm['E-Mail']);
            $this->repository->editUserAttributeById($this->userId, 'telefonNumber', $userDataFromForm['Telefonnumber']);
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