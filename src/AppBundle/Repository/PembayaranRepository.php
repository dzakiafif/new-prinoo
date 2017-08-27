<?php

namespace AppBundle\Repository;

use AppBundle\Contracts\Repository\PembayaranInterface;
use AppBundle\Entity\Pembayaran;
use Doctrine\ORM\EntityRepository;

/**
 * PembayaranRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PembayaranRepository extends EntityRepository implements PembayaranInterface
{
    /**
     * @param $id
     * @return Pembayaran
     */
    public function findById($id)
    {
        return $this->find($id);
    }

    /**
     * @param $user
     * @return Pembayaran
     */
    public function findByUser($user)
    {
        return $this->findOneBy(['user'=>$user]);
    }
}