<?php

namespace Jobeet\JobBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Jobeet\JobBundle\Entity\Category;

class LoadCategoryData extends AbstractFixture implements OrderedFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        // Our array of categories to create
        $categories = array('Design', 'Programming', 'Manager', 'Administrator');

        foreach ($categories as $category_name)
        {
            $category = new Category();
            $category->setName($category_name);
            $manager->persist($category);

            // Create a reference so that we can use this category to link to other entities
            $this->addReference('category-' . strtolower($category_name), $category);

        }

        // Save all new entities to the database
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 100; // the order in which fixtures will be loaded
    }    
}