<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\Film;
use App\Entity\Genre;
use App\Entity\Saison;
use App\Entity\Serie;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Faker;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $faker = Faker\Factory::create('fr_FR');

        //genre
        $g =[
            1=>[
                'name'=>'Drame'
            ],
            2=>[
                'name'=>'fantastic'
            ],
            3=>[
                'name'=>'Horreur'
            ],
            4=>[
                'name'=>'science-fiction'
            ],
            5=>[
                'name'=>'Aventure'
            ],
            6=>[
                'name'=>'Policière'
            ],
            7=>[
                'name'=>'Comédie'
            ]
            ];

        $genres = [];
        foreach ($g as $key => $value) {
            $genre = new Genre();
            $genre->setName($value['name']);
            $genres[]= $genre;
            $manager->persist($genre);
        }

        //film

        $f=[
            1=>[
                'title'=>'Black Adam',
                'anneeDeSortie'=>'2022',
                'durée'=>'2h00min',
                'prix'=> 200.00,
                'image'=>'adam.jpg'
            ],
            2=>[
                'title'=>'doctor strange',
                'anneeDeSortie'=>'2016',
                'durée'=>'1h40min',
                'prix'=> 100.99,
                'image'=>'doctorstrange.jpg'
            ],
            3=>[
                'title'=>'creed',
                'anneeDeSortie'=>'2012',
                'durée'=>'1h30min',
                'prix'=> 300.90,
                'image'=>'creed.jpg'
            ],
            4=>[
                'title'=>'creedII',
                'anneeDeSortie'=>'2018',
                'durée'=>'2h00min',
                'prix'=> 240.00,
                'image'=>'creedII.jpg'
            ],
            5=>[
                'title'=>'creedIII',
                'anneeDeSortie'=>'2023',
                'durée'=>'2h00min',
                'prix'=> 200.00,
                'image'=>'creedIII.jpg'
            ],
            6=>[
                'title'=>'john wick',
                'anneeDeSortie'=>'2014',
                'durée'=>'2h00min',
                'prix'=> 190.00,
                'image'=>'john.jpg'
            ],
            7=>[
                'title'=>'john wick2',
                'anneeDeSortie'=>'2016',
                'durée'=>'2h00min',
                'prix'=> 240.00,
                'image'=>'johnwick2.jpg'
            ],
            8=>[
                'title'=>'john wick3',
                'anneeDeSortie'=>'2020',
                'durée'=>'2h00min',
                'prix'=> 210.00,
                'image'=>'johnwick3.jpg'
            ],
            9=>[
                'title'=>'john wick4',
                'anneeDeSortie'=>'2023',
                'durée'=>'2h00min',
                'prix'=> 310.00,
                'image'=>'johnwick4.jpg'
            ],
            10=>[
                'title'=>'spider man',
                'anneeDeSortie'=>'2021',
                'durée'=>'2h00min',
                'prix'=> 300.00,
                'image'=>'spiderman.jpg'
            ],
            11=>[
                'title'=>'shazam',
                'anneeDeSortie'=>'2019',
                'durée'=>'2h00min',
                'prix'=> 110.00,
                'image'=>'shazam.jpg'
            ],
            12=>[
                'title'=>'Batman',
                'anneeDeSortie'=>'2020',
                'durée'=>'2h00min',
                'prix'=> 250.00,
                'image'=>'batman.jpg'
            ],
            13=>[
                'title'=>'man of steel',
                'anneeDeSortie'=>'2020',
                'durée'=>'2h00min',
                'prix'=> 400.00,
                'image'=>'manofsteel.jpg'
            ]
        ];
        foreach ($f as $key => $value) {
            $film = new Film();
            $film->setTitle($value['title'])
                ->setAnneeDeSortie($value['anneeDeSortie'])
                ->setDuration($value['durée'])
                ->setPrice($value['prix'])
                ->setfilmImageName($value['image']);

                for ($p=0; $p <mt_rand(1, 7) ; $p++) { 
                    $film->addGenre($genres[mt_rand(0, count($genres)-1)]);
                }
    
                $manager->persist($film);
        }

        

        //serie
        $se=[
            1=>[
                'title'=>'Prison break',
                'description'=>"L'histoire se déroule en Amérique où un jeune frère fait évader son frère de prison pour ne pas être executer à cause d'un crime qu'il n'a pas commis",
                'authors'=>'Michael scofield, Lincoln beurose, fernando sucre, sarah tancredy',
                'anneeDeSortie'=>'2004',
                'price_by_saison'=>100.99,
                'image'=>'prisonbreak.jpg'
            ],
            2=>[
                'title'=>'Nikita',
                'description'=>"L'histoire se déroule en Amérique où un jeune frère fait évader son frère de prison pour ne pas être executer à cause d'un crime qu'il n'a pas commis",
                'authors'=>'Nikita',
                'anneeDeSortie'=>'2010',
                'price_by_saison'=>99.99,
                'image'=>'nikita.jpg'
            ],
            3=>[
                'title'=>'Night Agent',
                'description'=>"Une conspiration se fonde dans le haut commandement des USA et un agent de téléphone et une fille passioné d'informatique se trouve mélée à cette histoire lorsque sa tante et son oncle furent assassiné dans leur maison",
                'authors'=>'joseph bagoin, clara saint marie',
                'anneeDeSortie'=>'2022',
                'price_by_saison'=>110.99,
                'image'=>'nightagent.jpg'
            ],
            4=>[
                'title'=>'Games of thrones',
                'description'=>"la guerre des septs couronnes fait rage entre les starks , les lanisters, les targaryens et dayenarys targaryen suivies de ses dragons et son armée d'immaculée",
                'authors'=>'j\'ai oublié',
                'anneeDeSortie'=>'2011',
                'price_by_saison'=>198.99,
                'image'=>'gamesofthrone.jpg'
            ],
            5=>[
                'title'=>'House of the dragon',
                'description'=>"c'est l'histoire des targaryens , une famille qui chevauche des dragons 200 avant l'histoire du games of thrones ",
                'authors'=>'oublié',
                'anneeDeSortie'=>'2022',
                'price_by_saison'=>210.99,
                'image'=>'houseofthedragon.jpg'
            ],
            6=>[
                'title'=>'Queen of south',
                'description'=>"L'histoire est celle d'une femme qui a commencée en bas de l'echelle du trafic de drogue et qui est parvenu être à la tête d'un cartel de drogue",
                'authors'=>'theresa mendoza',
                'anneeDeSortie'=>'2018',
                'price_by_saison'=>100.99,
                'image'=>'queenofsouth.jpg'
            ],
            7=>[
                'title'=>'Viking',
                'description'=>"L'histoire est celle d'un viking appelée Ragnar lotbrook qui a conqui plusieurs terres au delà de la mer et qui fut redouté par ses ennemis pour son courage et sa bravoure",
                'authors'=>'ragnar',
                'anneeDeSortie'=>'2019',
                'price_by_saison'=>170.99,
                'image'=>'viking.jpg'
            ],
            8=>[
                'title'=>'Valhala',
                'description'=>"L'histoire se déroule en Amérique où un jeune frère fait évader son frère de prison pour ne pas être executer à cause d'un crime qu'il n'a pas commis",
                'authors'=>'Michael scofield, Lincoln beurose, fernando sucre, sarah tancredy',
                'anneeDeSortie'=>'2017',
                'price_by_saison'=>100.99,
                'image'=>'valhala.jpg'
            ],
            9=>[
                'title'=>'Originals',
                'description'=>"c'est l'histoire de la famille original des vampires qui considère comme la famille ce qu'il y a de plus précieux au monde et qui détruit tous sur leur passage pour protéger leur famille",
                'authors'=>'Klause Michaelson, Elaija Michaelson, Rebecca Michaelson, Hailey ',
                'anneeDeSortie'=>'2012',
                'price_by_saison'=>199.99,
                'image'=>'originals.jpg'
            ],
            10=>[
                'title'=>'Vampire Diaries',
                'description'=>"l'histoire de mystic falls qui est une ville où tout les créatures surnaturel se croisent vampires, chasseurs, sorciers, loup-garou",
                'authors'=>'stephan salvatore, demon salvatore, helena halinoko',
                'anneeDeSortie'=>'2015',
                'price_by_saison'=>100.99,
                'image'=>'vampirediaries.jpg'
            ]
            ];

            $series = [];
            foreach ($se as $key => $value) {
                $serie = new Serie();
                $serie->setTitle($value['title'])
                    ->setDescription($value['description'])
                    ->setAuthors($value['authors'])
                    ->setAnneeDeSortie($value['anneeDeSortie'])
                    ->setPriceBySeason($value['price_by_saison'])
                    ->setserieImageName($value['image']);

                for ($k=0; $k <mt_rand(1, 7) ; $k++) { 
                    $serie->addGenre($genres[mt_rand(0, count($genres)-1)]);
                }
                $series[]= $serie;
                $manager->persist($serie);
            }

            //saison

        //admin
        $admin = new User();
        $admin->setFullname('hasindramanitra')
            ->setLastname('Brianno')
            ->setAdress('fianrantsoa LOT AB')
            ->setRoles(['ROLE_USER', 'ROLE_ADMIN'])
            ->setEmail('Brianno.manitra@gmail.com')
            ->setPlainPassword('BRIANNO9991');

        $manager->persist($admin);
        

        $manager->flush();
    }
}
