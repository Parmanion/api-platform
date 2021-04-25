<?php

namespace App\DataFixtures;

use App\Factory\OfferFactory;
use App\Factory\OrganizationFactory;
use App\Factory\RatingFactory;
use App\Factory\ServiceFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        OrganizationFactory::createMany(5);

        UserFactory::new()->memberOfOrganization()->createMany(15);
        UserFactory::new()->create([
            'email' => 'admin@admin.com' ,
            'password' => 'admin',
            'roles' => ['ROLE_ADMIN'],
       ]);

        UserFactory::createMany(20);

        ServiceFactory::createMany(20, [
            'provider' => OrganizationFactory::random(),
        ]);

        OfferFactory::createMany(20, [
            'itemOffered' => ServiceFactory::random(),
            'offeredBy' => ServiceFactory::random()->getProvider(),
        ]);

        RatingFactory::createMany(50, [
            'author' => UserFactory::random(),
//            'subjectOf' => ServiceFactory::random(),
        ]);
    }
}
