<?php

namespace AppBundle\Repository;

/**
 * ArticleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ArticleRepository extends \Doctrine\ORM\EntityRepository
{

  public function findAllByLocale($locale) {
    $qb = $this->createQueryBuilder('article');
    $qb->select('article')
       ->where('article.lang = :locale')
       ->orderBy('article.updated', 'DESC')
       ->setParameter('locale', $locale);
    return $qb->getQuery()->execute();
  }

}
