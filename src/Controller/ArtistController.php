<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\AddArtistType;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ArtistController extends AbstractController
{
    #[Route('/artist', name: 'app_artist')]
    public function index(ArtistRepository $artistRepository): Response
    {
        $artists = $artistRepository->findAll();
        return $this->render('artist/index.html.twig', [
            'artists' => $artists,
        ]);
    }

    //   Ajouter un artist (route : /artist-add)
    #[Route('/artist-create', name: 'app_artist_create')]
    public function create(EntityManagerInterface $entityManager, Request $request): Response
    {
        // // recupere l'entité qu'on veut supprimer par le repository
        // //

        // $tool = new Tool();
        // $tool->setLabel('notre super tool');
        // $tool->setDanger(8);
        // $tool->setCreatedAt(\DateTimeImmutable());
        //  dump($tool);
        $artist = new Artist();
        $form = $this->createForm(AddArtistType::class, $artist);
        // formulaire  ecoute ce u'il se passe
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            //  $artist->setCreatedAt(\DateTimeImmutable());

            $entityManager->persist($artist);
            dump($entityManager);
            $entityManager->flush();
        }

        return $this->render('artist/add.html.twig', [
            'form' => $form->createView(),

        ]);
    }
    //  modifier un artsit (route : /artist-edit/{id}) 
    #[Route('/artist-edit/{id}', name: 'app_artist_edit')]
    public function modify(string $id, EntityManagerInterface $entityManager, ArtistRepository $artistRepository, Request $request): Response
    {
        $artist = $artistRepository->findOneBy(['id' => $id]);

        $form = $this->createForm(AddArtistType::class, $artist);
        //       // formulaire  ecoute ce u'il se passe
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $entityManager->persist($artist);

            $entityManager->flush();



        }

        return $this->render('artist/artist-edit.html.twig', [
            'form' => $form

        ]);
    }
}
