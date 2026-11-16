<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    
    public function getDependencies(): array{
        return [
            CategoryFixtures::class,
        ];
    }
    public function load(ObjectManager $manager): void
    {
 
        $category1 = $this->getReference('category1', Category::class);
        $category2 = $this->getReference('category2', Category::class);
        $category3 = $this->getReference('category3', Category::class);

        $product1 = new Product();
        $product1->setName('Product 1');
        $product1->setDescription('Description for Product 1');
        $product1->setSize(10.99);
        $product1->addCategory($category1);
        $product1->addCategory($category2);

        $manager->persist($product1);

        $product2 = new Product();
        $product2->setName('Product 2');
        $product2->setDescription('Description for Product 2');
        $product2->setSize(19.99);
        $product2->setIsAvailable(false);
        $product2->addCategory($category1);

        $manager->persist($product2);

        $product3 = new Product();
        $product3->setName('Product 3');
        $product3->setDescription('Description for Product 3');
        $product3->setSize(29.99);
        $product3->addCategory($category2);
        $product3->addCategory($category3);

        $manager->persist($product3);

        $manager->flush();
    }
}
