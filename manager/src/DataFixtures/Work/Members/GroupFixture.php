<?php

declare(strict_types=1);

namespace App\DataFixtures\Work\Members;

use App\Model\Work\Entity\Members\Group\Group;
use App\Model\Work\Entity\Members\Group\Id;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Exception;

class GroupFixture extends Fixture
{
    /**
     * @param ObjectManager $manager
     * @throws Exception
     */
    public function load(ObjectManager $manager): void
    {
        $group = new Group(
            Id::next(), 'Our Staff'
        );

        $manager->persist($group);

        $group = new Group(
            Id::next(), 'Customers'
        );

        $manager->persist($group);

        $manager->flush();
    }
}