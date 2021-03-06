<?php

namespace AppBundle\Repository;

/**
 * Character Repository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CharacterRepository extends \Doctrine\ORM\EntityRepository {

    /**
     *
     * @return integer
     *
     */
    public function countOnlineCharacters() {
        $return = $this->getEntityManager()
            ->createQuery('SELECT count(character.online) FROM AppBundle:Character character WHERE character.online = 1');

        return $return->getSingleScalarResult();
    }

}
