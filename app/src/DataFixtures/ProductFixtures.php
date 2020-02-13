<?php

namespace App\DataFixtures;

use App\Entity\Product;
use App\Util\BrandType;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class ProductFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $macbook = new Product();
        $macbook->setName('MacBook Pro');
        $macbook->setBrand(BrandType::APPLE);
        $macbook->setPrice(2799.99);
        $manager->persist($macbook);

        $lenovo = new Product();
        $lenovo->setName('Lenovo Thinkpad X1');
        $lenovo->setBrand(BrandType::LENOVO);
        $lenovo->setPrice(2330.99);
        $manager->persist($lenovo);

        $dell = new Product();
        $dell->setName('XPS 13 9380');
        $dell->setBrand(BrandType::DELL);
        $dell->setPrice(2899.99);
        $manager->persist($dell);

        $other = new Product();
        $other->setName('K-BOOK360');
        $other->setBrand('KYC');
        $other->setPrice(999.99);
        $manager->persist($other);

        $manager->flush();
    }
}
