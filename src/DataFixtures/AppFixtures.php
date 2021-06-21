<?php

namespace App\DataFixtures;

use App\Entity\Entity;
use App\Entity\Save;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        
        $entities = array();
        for ($i = 0; $i < 20; $i++) {
            $entity = new Entity();

            $entity->setName('entity '.$i);
            $entity->setTime(null);
            $entity->setOnApp($i);
            $entity->setOnServer($i);

            array_push($entities, $entity);

            $manager->persist($entity);
        }

        foreach($entities as $entity){
            $save = new Save();

            $save->setDate(new DateTime());
            for ($i = 0; $i < 20; $i++) {
                $entity = new Entity();
    
                $entity->setName('entity '.$i);
                $entity->setTime(null);
                $entity->setOnApp($i);
                $entity->setOnServer($i);
    
                array_push($entities, $entity);
    
                $manager->persist($entity);
                $save->setEntities($entity);
            }
                
            
            $save->setTYpe('Initiales');
            $save->setClient(null);
            $save->setTime(new DateTime());

            $manager->persist($save);
        }

        $manager->flush();
    }
}
