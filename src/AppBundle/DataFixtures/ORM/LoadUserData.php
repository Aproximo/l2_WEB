<?php

namespace AppBundle\DataFixtures\ORM;

use AppBundle\Entity\User;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;

class LoadUserData implements FixtureInterface, ContainerAwareInterface
{
    /*
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
    $user = new User();
    $passwordPlain = 'manager';

    $encoder = $this->container->get('security.password_encoder');
    $passwordEncoded = $encoder->encodePassword($user, $passwordPlain);

    $user->setEmail('manager@admin.ad');
    $user->setPassword($passwordEncoded);
    $user->setRoles(['ROLE_SOMETHING']);

    $manager->persist($user);
    $manager->flush();
    }
}