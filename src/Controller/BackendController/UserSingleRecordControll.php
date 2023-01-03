<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Controller\ControllerInterface;
use App\Core\ViewInterface;
use App\Model\UserRepository;

class UserSingleRecordControll implements ControllerInterface
{
    private array $errors = [];
    private array $userDataSet = [];
    public function __construct(
        private readonly ViewInterface $view,
        private readonly UserRepository $userRepository
    ) {
    }

    public function renderView(): void
    {
        $userId = (int)$_GET['userId'];
        if (isset($_POST['submit'])) {
            $userDataSubmitted = $_POST;

            $this->userRepository->editUserAttributeById($userId, 'userName', $userDataSubmitted['Username']);
            $this->userRepository->editUserAttributeById($userId, 'firstName', $userDataSubmitted['First_Name']);
            $this->userRepository->editUserAttributeById($userId, 'lastName', $userDataSubmitted['Last_Name']);
            $this->userRepository->editUserAttributeById($userId, 'country', $userDataSubmitted['Country']);
            $this->userRepository->editUserAttributeById($userId, 'postcode', $userDataSubmitted['Postcode']);
            $this->userRepository->editUserAttributeById($userId, 'city', $userDataSubmitted['City']);
            $this->userRepository->editUserAttributeById($userId, 'street', $userDataSubmitted['Street']);
            $this->userRepository->editUserAttributeById($userId, 'streetNumber', $userDataSubmitted['Streetnumber']);
            $this->userRepository->editUserAttributeById($userId, 'email', $userDataSubmitted['E-Mail']);
            $this->userRepository->editUserAttributeById($userId, 'telefonNumber', $userDataSubmitted['Telefonnumber']);
        }

        $userDataFromRepository = $this->userRepository->getCurrentUserDataById($_SESSION['userId']);
        $this->userDataSet['Username'] = $userDataFromRepository->userName;
        $this->userDataSet['First Name'] = $userDataFromRepository->firstName;
        $this->userDataSet['Last Name'] = $userDataFromRepository->lastName;
        $this->userDataSet['Country'] = $userDataFromRepository->country;
        $this->userDataSet['Postcode'] = $userDataFromRepository->postcode;
        $this->userDataSet['City'] = $userDataFromRepository->city;
        $this->userDataSet['Street'] = $userDataFromRepository->street;
        $this->userDataSet['Streetnumber'] = $userDataFromRepository->streetNumber;
        $this->userDataSet['E-Mail'] = $userDataFromRepository->email;
        $this->userDataSet['Telefonnumber'] = $userDataFromRepository->telefonNumber;
        $this->view->addTemplateParameter('errors', $this->errors);
        $this->view->addTemplateParameter('userDataSet', $this->userDataSet);
        $this->view->setTemplate('userSingleRecord.tpl');
    }
}