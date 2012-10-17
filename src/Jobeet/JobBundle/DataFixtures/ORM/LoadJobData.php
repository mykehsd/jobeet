<?php

namespace Jobeet\JobBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Jobeet\JobBundle\Entity\Job;

class LoadJobData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;

    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $default_expires_at = new \DateTime();
        $default_expires_at->add (new \DateInterval('P' . $this->container->get('jobeet_job.job_manager')->getDefaultActiveDays() . 'D'));


        $job_sensio_labs = new Job();
        $job_sensio_labs->setCategory( $manager->merge($this->getReference('category-programming')));
        $job_sensio_labs
            ->setType('full-time')
            ->setCompany('Sensio Labs')
            ->setLogo('sensio-labs.gif')
            ->setUrl('http://www.sensiolabs.com/')
            ->setPosition('Web Developer')
            ->setLocation('Paris, France')
            ->setDescription('You\'ve already developed websites with symfony and you want to work with Open-Source technologies. You have a minimum of 3 years experience in web development with PHP or Java and you wish to participate to development of Web 2.0 sites using the best frameworks available.')
            ->setHowToApply('Send your resume to fabien.potencier [at] sensio.com')
            ->setIsPublic(true)
            ->setIsActivated(true)
            ->setToken('job_sensio_labs')
            ->setEmail('job@example.com')
            ->setExpiresAt ($default_expires_at);

        $manager->persist($job_sensio_labs);
        $this->addReference('job_sensio_labs', $job_sensio_labs);

        $job_extreme_sensio = new Job();
        $job_extreme_sensio->setCategory( $manager->merge($this->getReference('category-design')));
        $job_extreme_sensio
            ->setType('part-time')
            ->setCompany('Extreme Sensio')
            ->setLogo('extreme-sensio.gif')
            ->setUrl('http://www.extreme-sensio.com/')
            ->setPosition('Web Designer')
            ->setLocation('Paris, France')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolorin reprehenderit in')
            ->setHowToApply('Send your resume to fabien.potencier [at] sensio.com')
            ->setIsPublic(true)
            ->setIsActivated(true)
            ->setToken('job_extreme_sensio')
            ->setEmail('job@example.com')
            ->setExpiresAt ($default_expires_at);

        $manager->persist($job_extreme_sensio);
        $this->addReference('job_extreme_sensio', $job_extreme_sensio);

        $job_expired = new Job();
        $job_expired->setCategory($manager->merge($this->getReference('category-programming')));
        $job_expired
            ->setType('full-time')
            ->setCompany('Sensio Labs')
            ->setLogo('sensio-labs.gif')
            ->setUrl('http://www.sensiolabs.com/')
            ->setPosition('Web Designer')
            ->setLocation('Paris, France')
            ->setDescription('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolorin reprehenderit in')
            ->setHowToApply('Send your resume to fabien.potencier [at] sensio.com')
            ->setIsPublic(true)
            ->setIsActivated(true)
            ->setToken('job_expired')
            ->setEmail('job@example.com')
            ->setExpiresAt( new \DateTime('2012-09-10'));

        $manager->persist($job_expired);
        $this->addReference('job_expired', $job_expired);

        for ($i = 100; $i<=130; $i++)
        {
            $company = new Job();
            $company->setCategory( $manager->merge($this->getReference('category-programming')));
            $company
                ->setType('full-time')
                ->setCompany('Company ' . $i)
                ->setLogo('sensio-labs.gif')
                ->setUrl('http://www.sensiolabs.com/')
                ->setPosition('Web Developer')
                ->setLocation('Paris, France')
                ->setDescription('You\'ve already developed websites with symfony and you want to work with Open-Source technologies. You have a minimum of 3 years experience in web development with PHP or Java and you wish to participate to development of Web 2.0 sites using the best frameworks available.')
                ->setHowToApply('Send your resume to fabien.potencier [at] sensio' . $i . '.com')
                ->setIsPublic(true)
                ->setIsActivated(true)
                ->setToken('company_' . $i)
                ->setEmail('job@example.com')
                ->setExpiresAt ($default_expires_at);

            $manager->persist($company);
            $this->addReference('company_'. $i, $company);
        }
        
        // Save all new entities to the database
        $manager->flush();
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
    public function getOrder()
    {
        return 200; // the order in which fixtures will be loaded
    }    
}
