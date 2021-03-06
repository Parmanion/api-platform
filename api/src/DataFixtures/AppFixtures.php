<?php

namespace App\DataFixtures;

use App\Entity\Service;
use App\Factory\OfferFactory;
use App\Factory\OrganizationFactory;
use App\Factory\RatingFactory;
use App\Factory\ServiceFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Persistence\ObjectManager;

use function Zenstruck\Foundry\faker;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {

        // Create 5 PDG with their organization
        UserFactory::createMany(5, [
            'memberOf' => OrganizationFactory::new(),
            'roles' => ['ROLE_ORGANIZATION_ADMIN']
        ]);

        // Create 15 employees for this organizations
        UserFactory::new()->createMany(15, function() {
            return [
                'memberOf' => OrganizationFactory::random(),
                'roles' => ['ROLE_ORGANIZATION_MANAGER']
            ];
        });

        // Create an admin
        UserFactory::new()->create([
            'email' => 'admin@admin.com' ,
            'password' => 'admin',
            'roles' => ['ROLE_ADMIN'],
        ]);

        // Create 20 users
        UserFactory::createMany(20);

        ServiceFactory::createMany(20, function() {
            return [
                'provider' => OrganizationFactory::random(),
                'ratings' => RatingFactory::new(function() {
                    return [
                        'author' => UserFactory::random(['memberOf' => null]),
                    ];
                })->many(0, 10),
            ];
        });

        OfferFactory::createMany(20, function() {
            $service = ServiceFactory::random();
            return [
                'itemOffered' => $service,
                'offeredBy' => $service->getProvider(),
            ];
        });


    }
}
