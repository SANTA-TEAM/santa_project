<?php

namespace App\DataFixtures;

use App\Entity\Reindeers;
use Faker\Factory;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ReindeersFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('fr_FR');

        $namesReindeers = [
            'Tornade' => "Sa rapidité défie les vents les plus féroces, portant le traîneau à travers les nuages avec une agilité incomparable.",
            'Danseur' => "Élégant et léger, il virevolte dans les cieux nocturnes, ajoutant une touche de grâce à chaque mouvement.",
            'Fringant' => " Son enthousiasme débordant et son énergie inépuisable font de lui un moteur essentiel pour le voyage magique du Père Noël.",
            'Furie' => "Sa force colossale fend les tempêtes les plus impitoyables, propulsant le traîneau avec une énergie indomptable.",
            'Comète' => " Son éclat lumineux guide le chemin à travers l'obscurité, éclairant la voie pour que les cadeaux arrivent à bon port.",
            'Cupidon' => "Doux et affectueux, il apporte une touche de tendresse et d'amour à chaque étape du périple de Noël.",
            'Tonnerre' => "Son rugissement résonne dans le ciel, annonçant l'arrivée imminente de la magie de Noël.",
            'Eclair' => "Sa vitesse fulgurante illumine la nuit, laissant derrière lui une traînée étincelante dans le sillage du traîneau.",
            'Rudolph' => "Son nez rouge luit de manière éclatante, guidant les autres rennes à travers l'obscurité de la nuit hivernale."
        ];

        foreach ($namesReindeers as $name => $story) {
            $reindeer = new Reindeers();
            $reindeer->setName($name);
            $reindeer->setStory($story);
            $manager->persist($reindeer);
        }

        $manager->flush();
    }
}
