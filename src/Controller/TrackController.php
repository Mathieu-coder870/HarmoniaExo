<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Favorite;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Track;
use App\Entity\Album;
use App\Form\AddTrackType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class TrackController extends AbstractController
{
    #[Route('/track-create/{id}', name: 'app_track_create')]
    public function create(Album $album, EntityManagerInterface $entityManager, Request $request): Response
    {
        $track = new Track();
        $form = $this->createForm(AddTrackType::class, $track);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $track->setAlbum($album);
            $track->setCreatedAt(new \DateTimeImmutable);

            $entityManager->persist($track);

            $entityManager->flush();
        }



        return $this->render('track/addTrack.html.twig', [
            'form' => $form->createView(),
            'album' => $album,
        ]);
    }

    #[Route('/handle-favorite/{track_id}', name: 'app_favorite_create')]
    public function createFavorite(string $track_id, EntityManagerInterface $entityManager, Request $request): Response
    {
        //  
        //   $track-> //recupeer la track par son id 
        $track->getTrack($track_id);
        // 2 : recupérer le user connecté
        $user = $this->getUser();
        // 3 : créer une nouvelle entité favorite
        $favorite = new Favorite();
        //4 : favorite set la track
        $favorite->setTrack($track);
        // 5 : favorite set le user connecté
        $favorite->setUser($user);
        // 6 : persist le favorite
        $favorite->persist();
        // 7 : flush
        $favorite->flush();
        // redirection de l'utilisateur vers la page que tu veux 
        return $this->redirectToRoute('app_home');

    }





}
