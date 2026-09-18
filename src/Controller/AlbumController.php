<?php

namespace App\Controller;

use App\Entity\Album;
use App\Repository\AlbumRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class AlbumController extends AbstractController
{
    #[Route('/album/{id}', name: 'app_album_id')]
    public function index($id, AlbumRepository $albumRepository): Response
    {
        $album = $albumRepository->find($id);
        if ($album === null) {
            $this->redirectToRoute('app_home');
        }

        return $this->render('album/index.html.twig', [
            'album' => $album,
        ]);
    }

    #[Route('/album-create', name: 'app_album_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        // // recupere l'entité qu'on veut supprimer par le repository
        // //

        // $tool = new Tool();
        // $tool->setLabel('notre super tool');
        // $tool->setDanger(8);
        // $tool->setCreatedAt(\DateTimeImmutable());
        //  dump($tool);
        $album = new Album();
        $form = $this->createForm(AddAlbumType::class, $album);
        // formulaire  ecoute ce u'il se passe
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //  $artist->setCreatedAt(\DateTimeImmutable());

            $entityManager->persist($album);
            dump($entityManager);
            $entityManager->flush();
        }

        return $this->render('album/add.html.twig', [
            'form' => $form->createView(),

        ]);
    }
}