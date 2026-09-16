<?php

namespace App\Controller;

use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class HomeController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(AlbumRepository $albumRepository): Response
    {
        
        $epType = $albumRepository->findBy(['type'=>'EP']);
        $albumType = $albumRepository->findBy(['type'=>'Album']);
        $singleType = $albumRepository->findBy(['type'=>'Single']);

        //enttity User | null
     $user =$this->getUser();
    dump($user);

        return $this->render('home/index.html.twig', [
            // 'controller_name' => 'HomeController',
            'epType'=> $epType,
            'albumType'=> $albumType,
            'singleType'=> $singleType,

        ]);
    }
}
