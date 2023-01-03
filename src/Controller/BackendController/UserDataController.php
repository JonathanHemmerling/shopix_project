<?php

declare(strict_types=1);

namespace App\Controller\BackendController;

use App\Entity\UserData;
use Doctrine\Persistence\ManagerRegistry;
use \Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UserDataController extends AbstractController{

    public function createNewUser(ManagerRegistry $doctrine):Response
    {
                $entityManager = $doctrine->getManager();
                $user = new UserData();
                $userId = $user->getId();
                $entityManager->persist($user);
                $entityManager->flush();
                return new Response('ID = '. $userId);
    }

}