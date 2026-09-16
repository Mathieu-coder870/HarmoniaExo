<?php

namespace App\DataFixtures;

use App\Factory\AlbumFactory;
use App\Factory\ArtistFactory;
use App\Factory\FavoriteFactory;
use App\Factory\GenreFactory;
use App\Factory\HistoricalFactory;
use App\Factory\PlaylistFactory;
use App\Factory\TrackFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        // $types =["Rock","Soul","Jazz","Rapp","Classic","Techno"];
        $types = ['rock','reggae','classique', 'jazz', 'pop', 'hip-hop', 'electro', 'blues', 'metal', 'funk', 'soul', 'country', 'folk', 'punk', 'disco', 'rnb', 'rap', 'house', 'techno', 'ambient', 'salsa', 'bossa nova', 'ska', 'gospel', 'grime', 'dubstep', 'afrobeats', 'drill', 'synthwave'];
        foreach ($types as $value) {
            GenreFactory::createOne([
                'label' => $value
            ]);
        }

        UserFactory::createMany(500);
        ArtistFactory::createMany(100);
        AlbumFactory::createMany(50);
        TrackFactory::createMany(800);
        PlaylistFactory::createMany(242);
        FavoriteFactory::createMany(158);
        HistoricalFactory::createMany(850);


        

        $manager->flush();
    }
}
