<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Gift;
use App\DataFixtures\AgeFixtures;
use App\DataFixtures\CategoryFixtures;
use App\Repository\AgeRepository;
use App\Repository\CategoryRepository;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class GiftFixtures extends Fixture
{
    public function __construct(private SluggerInterface $slugger, private CategoryRepository $categoryRepository, private AgeRepository $ageRepository)
    {
    }
    public function load(ObjectManager $manager): void
    {

        $games = [
            "Peluches et Poupées" => [
                ["Nom" => "Peluche Licorne", "Description" => "Une adorable peluche douce et colorée en forme de licorne.", "Age" => 3],
                ["Nom" => "Poupée Barbie Dreamhouse", "Description" => "Une poupée Barbie accompagnée de sa maison de rêve pour des aventures imaginatives.", "Age" => 8],
                ["Nom" => "Ours en Peluche Géant", "Description" => "Un énorme ours en peluche câlin parfait pour les câlins et les jeux.", "Age" => 3],
                ["Nom" => "Poupée Baby Alive", "Description" => "Une poupée interactive qui mange, boit et fait pipi pour un jeu réaliste.", "Age" => 3],
                ["Nom" => "Peluche Pikachu", "Description" => "Une peluche du célèbre Pokémon Pikachu, idéale pour les fans de Pokémon.", "Age" => 3],
                ["Nom" => "Poupée Elsa de La Reine des Neiges", "Description" => "Une poupée représentant Elsa du film La Reine des Neiges, parfaite pour les fans du film.", "Age" => 3],
                ["Nom" => "Peluche Stitch", "Description" => "Une peluche du personnage de dessin animé Stitch, douce et câline.", "Age" => 3],
                ["Nom" => "Poupée L.O.L. Surprise", "Description" => "Une poupée mystérieuse contenant des surprises à découvrir.", "Age" => 8],
                ["Nom" => "Peluche Renard", "Description" => "Une peluche représentant un renard, idéale pour les amateurs d'animaux.", "Age" => 3],
                ["Nom" => "Poupée Monster High", "Description" => "Une poupée issue de la série Monster High, parfaite pour les fans de monstres et de mode.", "Age" => 8]
            ],
            "Jeux de Construction" => [
                ["Nom" => "LEGO Classic Boîte de Briques Créatives", "Description" => "Une boîte de briques LEGO classiques pour construire tout ce que l'imagination permet.", "Age" => 3],
                ["Nom" => "Meccano Tour Eiffel", "Description" => "Un ensemble de construction Meccano pour recréer la célèbre Tour Eiffel.", "Age" => 12],
                ["Nom" => "K'NEX Montagnes Russes", "Description" => "Un ensemble K'NEX pour construire des montagnes russes passionnantes.", "Age" => 8],
                ["Nom" => "LEGO Friends Le Centre Équestre de Heartlake City", "Description" => "Un ensemble LEGO Friends pour construire un centre équestre avec des chevaux et des amis.", "Age" => 8],
                ["Nom" => "Mega Bloks Camion de Pompiers", "Description" => "Un camion de pompiers à construire avec des blocs Mega Bloks pour des aventures de sauvetage.", "Age" => 3],
                ["Nom" => "Geomag Panneau de Construction Magnétique", "Description" => "Un ensemble Geomag pour créer des structures magnétiques fascinantes.", "Age" => 3],
                ["Nom" => "LEGO Technic Voiture de Course Télécommandée", "Description" => "Un ensemble LEGO Technic pour construire une voiture de course télécommandée.", "Age" => 8],
                ["Nom" => "KNEX Mario Kart Circuit de la Jungle", "Description" => "Un ensemble K'NEX pour recréer le circuit de la jungle de Mario Kart.", "Age" => 8],
                ["Nom" => "Magna-Tiles Set de Blocs Magnétiques", "Description" => "Un ensemble de blocs magnétiques pour créer des formes et des structures en 3D.", "Age" => 3],
                ["Nom" => "LEGO Star Wars Faucon Millenium", "Description" => "Un ensemble LEGO Star Wars pour construire le célèbre Faucon Millenium.", "Age" => 8]
            ],
            "Véhicules Radiocommandés" => [
                ["Nom" => "Voiture Radiocommandée Ferrari", "Description" => "Une voiture de course radiocommandée avec une vitesse impressionnante.", "Age" => 8],
                ["Nom" => "Drone DJI Phantom 4", "Description" => "Un drone haut de gamme avec une caméra 4K pour des prises de vue aériennes.", "Age" => 16],
                ["Nom" => "Hélicoptère Radiocommandé Syma S108G", "Description" => "Un hélicoptère facile à piloter pour les débutants, idéal pour les vols en intérieur.", "Age" => 8],
                ["Nom" => "Bateau Radiocommandé Proboat Blackjack 24", "Description" => "Un bateau rapide et agile pour des courses passionnantes sur l'eau.", "Age" => 12],
                ["Nom" => "Camion Monstre Radiocommandé Traxxas Stampede", "Description" => "Un camion monstre tout-terrain avec une grande puissance et une durabilité exceptionnelle.", "Age" => 12],
                ["Nom" => "Avion Radiocommandé HobbyZone Sport Cub S", "Description" => "Un avion facile à piloter pour les débutants avec une technologie de sécurité intégrée.", "Age" => 12],
                ["Nom" => "Voiture de Course Radiocommandée Traxxas Slash", "Description" => "Une voiture de course prête à l'emploi avec une suspension robuste pour les sauts et les virages serrés.", "Age" => 12],
                ["Nom" => "Quadcopter Radiocommandé Hubsan X4", "Description" => "Un quadcopter agile avec des fonctionnalités avancées comme le vol acrobatique.", "Age" => 12],
                ["Nom" => "Buggy Radiocommandé Team Associated RC10B6.2", "Description" => "Un buggy de compétition haute performance conçu pour la course sur piste.", "Age" => 16],
                ["Nom" => "Char d'Assaut Radiocommandé Heng Long M1A2 Abrams", "Description" => "Un char d'assaut radiocommandé avec des fonctions réalistes de son et de mouvement.", "Age" => 16]
            ],
            "Jeux de Société" => [
                ["Nom" => "Monopoly Classique", "Description" => "Un jeu de société classique où les joueurs achètent, vendent et échangent des propriétés pour devenir riches.", "Age" => 8],
                ["Nom" => "Dixit", "Description" => "Un jeu de société d'associations d'images et d'imagination où les joueurs doivent deviner quelles images correspondent à quelles phrases.", "Age" => 8],
                ["Nom" => "Catan", "Description" => "Un jeu de société de commerce et de stratégie où les joueurs tentent de coloniser une île en construisant des routes, des colonies et des villes.", "Age" => 10],
                ["Nom" => "Time's Up!", "Description" => "Un jeu de société de devinettes et de mime par équipe où les joueurs doivent faire deviner des personnalités célèbres.", "Age" => 12],
                ["Nom" => "Jenga", "Description" => "Un jeu de société d'adresse où les joueurs doivent retirer des blocs de bois d'une tour sans la faire tomber.", "Age" => 6],
                ["Nom" => "Taboo", "Description" => "Un jeu de société de mots interdits où les joueurs doivent faire deviner un mot sans utiliser certains mots-clés.", "Age" => 12],
                ["Nom" => "Risk", "Description" => "Un jeu de société de stratégie militaire où les joueurs tentent de conquérir le monde en déployant leurs armées et en conquérant des territoires.", "Age" => 10],
                ["Nom" => "Puissance 4", "Description" => "Un jeu de société de stratégie où les joueurs doivent aligner quatre jetons de leur couleur avant leur adversaire.", "Age" => 6],
                ["Nom" => "Cluedo", "Description" => "Un jeu de société de déduction où les joueurs doivent résoudre un meurtre en découvrant qui est le meurtrier, avec quelle arme et dans quelle pièce.", "Age" => 8],
                ["Nom" => "Les Aventuriers du Rail", "Description" => "Un jeu de société de construction de chemins de fer où les joueurs collectent des cartes de train pour relier des villes et marquer des points.", "Age" => 8]
            ],
            "Jeux éducatifs et Scientifiques" => [
                ["Nom" => "Kit de Circuit Électrique Snap Circuits Jr.", "Description" => "Un kit de construction électronique pour enfants avec des composants faciles à assembler pour créer des circuits électriques simples.", "Age" => 8],
                ["Nom" => "Télescope Astronomique Celestron PowerSeeker", "Description" => "Un télescope idéal pour les débutants pour observer les étoiles, la lune et les planètes.", "Age" => 10],
                ["Nom" => "Microscope National Geographic", "Description" => "Un microscope de haute qualité pour observer les cellules, les micro-organismes et d'autres objets microscopiques.", "Age" => 10],
                ["Nom" => "Robot Sphero SPRK+", "Description" => "Un robot programmable pour apprendre les bases de la programmation et de la robotique de manière ludique.", "Age" => 8],
                ["Nom" => "Kit de Chimie Thames & Kosmos", "Description" => "Un ensemble de laboratoire de chimie pour enfants avec des expériences sûres et amusantes à réaliser.", "Age" => 10],
                ["Nom" => "Kit de Robotique LEGO Mindstorms EV3", "Description" => "Un ensemble LEGO pour construire et programmer des robots qui peuvent marcher, parler et exécuter des missions.", "Age" => 10],
                ["Nom" => "Globe Terrestre Lumineux Interactif", "Description" => "Un globe terrestre interactif qui enseigne la géographie, les pays, les capitales et les faits intéressants sur le monde.", "Age" => 8],
                ["Nom" => "Kit de Construction de Volcan", "Description" => "Un kit scientifique pour construire un volcan et réaliser des éruptions volcaniques simulées.", "Age" => 10],
                ["Nom" => "Circuit de Marbre Gravitrax", "Description" => "Un ensemble de construction de circuits de billes avec des pièces modulaires pour créer des parcours de billes personnalisés.", "Age" => 8],
                ["Nom" => "Kit de Robot Solaire", "Description" => "Un ensemble pour construire des robots alimentés par l'énergie solaire pour apprendre les principes de l'énergie renouvelable.", "Age" => 8]
            ],
            "Figurines d'action" => [
                ["Nom" => "Figurine Spider-Man Marvel Legends", "Description" => "Une figurine articulée de Spider-Man avec des détails réalistes, parfaite pour les fans de super-héros.", "Age" => 5],
                ["Nom" => "Figurine Batman Arkham Knight", "Description" => "Une figurine de Batman inspirée du jeu vidéo Arkham Knight, idéale pour les collectionneurs.", "Age" => 12],
                ["Nom" => "Figurine Star Wars Black Series Darth Vader", "Description" => "Une figurine de collection de Darth Vader avec des accessoires et une conception fidèle au film.", "Age" => 14],
                ["Nom" => "Figurine Transformers Optimus Prime", "Description" => "Une figurine de Transformers qui se transforme de robot en camion et vice versa, pour des aventures épiques.", "Age" => 6],
                ["Nom" => "Figurine Iron Man Marvel Select", "Description" => "Une figurine détaillée d'Iron Man avec des poses interchangeables et des accessoires.", "Age" => 8],
                ["Nom" => "Figurine de Collection Dragon Ball Z Goku Super Saiyan", "Description" => "Une figurine de Goku en Super Saiyan, parfaite pour les fans de Dragon Ball Z.", "Age" => 10],
                ["Nom" => "Figurine DC Comics Designer Series Harley Quinn", "Description" => "Une figurine de Harley Quinn avec un design artistique unique, idéale pour les amateurs de DC Comics.", "Age" => 14],
                ["Nom" => "Figurine Marvel Legends Wolverine", "Description" => "Une figurine articulée de Wolverine avec des griffes rétractables, pour recréer des combats épiques.", "Age" => 12],
                ["Nom" => "Figurine Overwatch Figma Tracer", "Description" => "Une figurine articulée de Tracer du jeu vidéo Overwatch, avec des accessoires et des effets spéciaux.", "Age" => 14],
                ["Nom" => "Figurine Harry Potter Nendoroid", "Description" => "Une figurine de Harry Potter avec des accessoires magiques pour les fans de l'univers de Harry Potter.", "Age" => 10]
            ],
            "Instruments de Musique pour Enfants" => [
                ["Nom" => "Guitare Acoustique Enfant 3/4", "Description" => "Une guitare acoustique de taille réduite pour les enfants débutants à apprendre à jouer.", "Age" => 6],
                ["Nom" => "Clavier Électronique pour Enfants", "Description" => "Un clavier électronique avec des fonctions d'apprentissage pour les enfants à découvrir la musique.", "Age" => 5],
                ["Nom" => "Set de Batterie pour Enfants", "Description" => "Un set de batterie junior avec des tambours, des cymbales et des baguettes adaptées aux enfants.", "Age" => 6],
                ["Nom" => "Flûte à Bec en Plastique", "Description" => "Une flûte à bec en plastique facile à jouer pour les enfants à apprendre les bases de la musique.", "Age" => 5],
                ["Nom" => "Tambourin en Bois pour Enfants", "Description" => "Un tambourin coloré en bois avec des cymbalettes pour les enfants à explorer le rythme et la musique.", "Age" => 3],
                ["Nom" => "Violon pour Enfants", "Description" => "Un violon de taille réduite pour les enfants à commencer à apprendre à jouer du violon.", "Age" => 8],
                ["Nom" => "Xylophone pour Enfants", "Description" => "Un xylophone coloré avec des notes claires pour les enfants à découvrir les bases de la musique.", "Age" => 3],
                ["Nom" => "Harmonica pour Enfants", "Description" => "Un harmonica facile à jouer pour les enfants à apprendre les mélodies simples.", "Age" => 6],
                ["Nom" => "Maracas en Bois pour Enfants", "Description" => "Des maracas traditionnelles en bois pour les enfants à secouer et à créer des rythmes.", "Age" => 3],
                ["Nom" => "Tambour Djembé pour Enfants", "Description" => "Un tambour djembé miniature pour les enfants à explorer les rythmes africains.", "Age" => 5]
            ],
            "Jeux de Plein Air" => [
                ["Nom" => "Tente de Camping Coleman Sundome", "Description" => "Une tente de camping spacieuse et facile à monter pour des aventures en plein air.", "Age" => 8],
                ["Nom" => "Set de Badminton", "Description" => "Un set de badminton complet avec des raquettes, des volants et un filet pour des parties amusantes en plein air.", "Age" => 6],
                ["Nom" => "Ballon de Soccer Adidas Tango", "Description" => "Un ballon de soccer de qualité pour des matchs passionnants sur le terrain.", "Age" => 6],
                ["Nom" => "Ensemble de Jeu de Croquet", "Description" => "Un ensemble de jeu de croquet classique pour des après-midis divertissants dans le jardin.", "Age" => 6],
                ["Nom" => "Trottinette Razor A Kick Scooter", "Description" => "Une trottinette légère et robuste pour les déplacements urbains ou les promenades en plein air.", "Age" => 5],
                ["Nom" => "Frisbee Wham-O Ultimate Frisbee", "Description" => "Un frisbee de haute qualité pour des jeux de lancer et d'attraper dynamiques en plein air.", "Age" => 8],
                ["Nom" => "Set de Baseball Franklin Sports", "Description" => "Un set de baseball complet avec des gants, une batte et une balle pour des parties de baseball dans le jardin.", "Age" => 6],
                ["Nom" => "Kit de Construction de Cabane dans les Arbres", "Description" => "Un kit de construction pour construire une cabane dans les arbres pour les enfants à explorer et à s'amuser en plein air.", "Age" => 10],
                ["Nom" => "Ensemble de Jeu de Volleyball de Plage", "Description" => "Un ensemble de volleyball de plage avec un filet portable pour des matchs sur le sable.", "Age" => 8],
                ["Nom" => "Jeux d'Eau pour le Jardin", "Description" => "Un ensemble de jeux d'eau amusants pour les journées chaudes d'été, avec des toboggans, des piscines et des jets d'eau.", "Age" => 3]
            ],
            "Puzzle et Casse-tête" => [
                ["Nom" => "Puzzle Ravensburger Disney 1000 Pièces", "Description" => "Un puzzle de 1000 pièces mettant en vedette des personnages Disney emblématiques pour des heures de plaisir.", "Age" => 10],
                ["Nom" => "Casse-tête en Bois Tangram", "Description" => "Un casse-tête en bois classique avec des pièces géométriques à assembler pour former des formes différentes.", "Age" => 6],
                ["Nom" => "Puzzle 3D Tour Eiffel", "Description" => "Un puzzle en 3D de la Tour Eiffel pour construire une réplique réaliste de l'emblème de Paris.", "Age" => 12],
                ["Nom" => "Casse-tête Rubik's Cube", "Description" => "Le célèbre casse-tête Rubik's Cube pour défier l'esprit et améliorer les compétences en résolution de problèmes.", "Age" => 8],
                ["Nom" => "Puzzle Jan van Haasteren La Fête au Village", "Description" => "Un puzzle humoristique mettant en scène une fête animée dans un village, plein de détails amusants à découvrir.", "Age" => 12],
                ["Nom" => "Casse-tête Métal Hanayama", "Description" => "Des casse-tête en métal de qualité avec des niveaux de difficulté variables pour les amateurs de défis.", "Age" => 10],
                ["Nom" => "Puzzle Magnétique pour Enfants", "Description" => "Un puzzle magnétique avec des animaux colorés à assembler sur une planche magnétique.", "Age" => 3],
                ["Nom" => "Casse-tête 3D Sphère", "Description" => "Un casse-tête en forme de sphère avec des pièces à assembler pour former une boule.", "Age" => 8],
                ["Nom" => "Puzzle de Sol Géant", "Description" => "Un puzzle de sol géant avec des images colorées pour les enfants à assembler et à jouer.", "Age" => 5],
                ["Nom" => "Casse-tête en Mousse pour Enfants", "Description" => "Des casse-tête en mousse colorée avec des formes variées pour les jeunes enfants à manipuler et à assembler.", "Age" => 3]
            ],
            "Jeux Créatifs" => [
                ["Nom" => "Coffret de Peinture Acrylique", "Description" => "Un coffret complet de peinture acrylique avec des couleurs vives pour créer des œuvres d'art originales.", "Age" => 6],
                ["Nom" => "Kit de Fabrication de Bijoux", "Description" => "Un kit de fabrication de bijoux avec des perles colorées et des accessoires pour créer des bijoux uniques.", "Age" => 8],
                ["Nom" => "Boîte d'Artisanat DIY", "Description" => "Une boîte d'artisanat remplie de matériaux et d'outils pour créer une variété de projets artistiques et artisanaux.", "Age" => 6],
                ["Nom" => "Coffret de Fabrication de Bougies", "Description" => "Un coffret de fabrication de bougies avec de la cire, des mèches et des parfums pour créer des bougies personnalisées.", "Age" => 10],
                ["Nom" => "Ensemble de Création de Cartes", "Description" => "Un ensemble de création de cartes avec du papier coloré, des autocollants et des embellissements pour faire des cartes uniques.", "Age" => 6],
                ["Nom" => "Coffret de Fabrication de Slime", "Description" => "Un coffret de fabrication de slime avec des ingrédients et des instructions pour créer différentes textures de slime.", "Age" => 6],
                ["Nom" => "Set de Coloriage Manga", "Description" => "Un set de coloriage avec des marqueurs, des crayons et des feutres spéciaux pour dessiner des personnages manga.", "Age" => 8],
                ["Nom" => "Kit de Fabrication de Bracelets d'Amitié", "Description" => "Un kit de fabrication de bracelets d'amitié avec du fil coloré et des instructions pour créer des bracelets tressés.", "Age" => 6],
                ["Nom" => "Coffret de Sculpture en Argile", "Description" => "Un coffret de sculpture en argile avec des outils et des modèles pour créer des sculptures artistiques.", "Age" => 8],
                ["Nom" => "Ensemble de Fabrication de Mosaïque", "Description" => "Un ensemble de fabrication de mosaïque avec des tuiles colorées et un tableau pour créer des motifs décoratifs.", "Age" => 6]
            ]
        ];

        foreach ($games as $category => $gameList) {
            foreach($gameList as $game) {
                $gift = new Gift();
                $gift->setName($game['Nom']);
                $gift->setDescription($game['Description']);
                $gift->setAge($this->ageRepository->findOneBy(['age' => $game['Age']]));
                $gift->setCategory($this->categoryRepository->findOneBy(['name' => $category]));
                $gift->setSlug($this->slugger->slug($gift->getName())->lower());

                $manager->persist($gift);
            }
        }

        // $faker = Factory::create('fr_FR');

        // for ($i = 0; $i < 100; $i++) {
        //     $gift = (new Gift())
        //         ->setName($faker->text(50))
        //         ->setDescription($faker->text(200))
        //         ->setCategory($this->getReference('category_' . rand(0, 9)))
        //         ->setAge($this->getReference('age_' . rand(0, 4)));
        //     $gift->setSlug($this->slugger->slug($gift->getName())->lower());

        //     $manager->persist($gift);
        // }

        $manager->flush();
    }


    public function getDependencies(): array
    {
        return [
            CategoryFixtures::class,
            AgeFixtures::class
        ];
    }
}
