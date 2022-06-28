<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }


    public function findByFilter($filters, $idParent,  $count = false, $currentPage = 1, $nbResult = 6)
    {

        //FILTER find subcategory relative to parent category
        $query = $this->createQueryBuilder('p');
        // création d'un builder
        $query->Join('p.category', 'category')
              ->where('category.parent = :idParent')
                ->setParameter('idParent', $idParent);

        //SUBCATEGORY

        if (isset($filters["sous-categories"])) {
            $query->andWhere('p.category = :id')
                ->setParameter('id', $filters["sous-categories"]);

        }

        //BRAND

        if (!empty($filters["brand"])) {
             $query->andWhere('p.brand = :idBrand')->setParameter('idBrand', $filters["brand"]);
         }

        //RATE

        if (!empty($filters["rate"])) {
            $query->andWhere('p.rate IN (:array)')->setParameter('array', $filters["rate"]);

        }


        //PRICE MIN

       if (isset($filters["priceMin"])) {
            $query->andWhere('p.price> :priceMin')->setParameter('priceMin', $filters["priceMin"]);
        }

        //PRICE MAX

       if (isset($filters["priceMax"])) {
            $query->andWhere('p.price < :priceMax')->setParameter('priceMax', $filters["priceMax"]);
        }

        //PAGINATION
        if ($count) {
            $query->select('COUNT(p)');
            return $query->getQuery()->getSingleScalarResult();
        } else {
            $query->select('p');
            $query->setMaxResults($nbResult)->setFirstResult(($currentPage * $nbResult) - $nbResult);
        }

        return $query->getQuery()->getResult();
    }


    public function findBySubCategory($idParent, $idSubCateg, $currentPage = 1, $nbResult = 6, )
    {
        $qb = $this->createQueryBuilder('p')
            ->Join('p.category', 'category')
            ->where('category.parent = :idParent')
            ->setParameter('idParent', $idParent);
        if ($idSubCateg != null) {
            $qb->andWhere('p.category = :idSubCateg')
                ->setParameter('idSubCateg', $idSubCateg);
        }


        $qb->setMaxResults($nbResult)
            ->setFirstResult(($currentPage * $nbResult) - $nbResult);

        return $qb->getQuery()->getResult();
    }

    /**
     * Method to count all the results by sub category
     * @return mixed
     */
    public function findBySubCategoryResult($idParent)
    {

        return $this->createQueryBuilder('p')
            ->select('COUNT(p)')
            ->Join('p.category', 'category')
            ->andWhere('p.category = :idParent')
            ->setParameter('idParent', $idParent)
            ->orWhere('category.parent = :idParent')
            ->setParameter('idParent', $idParent)
            ->getQuery()
            ->getSingleScalarResult();

    }


    /**
     * Method to find by product offer
     * @return float|int|mixed|string
     */
    public function findByOffer()
    {
        return $this->createQueryBuilder('p')
            ->Where('p.offer = true')
            ->setMaxResults(6)
            ->getQuery()
            ->getResult();
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    /* public function add(Product $entity, bool $flush = true): void
     {
         $this->_em->persist($entity);
         if ($flush) {
             $this->_em->flush();
         }
     }*/

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    /*public function remove(Product $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }*/

    /*************************************************************************/

    public function findbyidBrand($idBrand)
    {
        return $this->createQueryBuilder('p')
            ->Join('p.brand', 'brand')
            ->andWhere('p.brand = :idBrand')
            ->setParameter('idBrand', $idBrand)
            ->getQuery()
            ->getResult();
    }

    // /**
    //  * @return Product[] Returns an array of Product objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
