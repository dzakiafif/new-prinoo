<?php
/**
 * Created by PhpStorm.
 * User: dzaki
 * Date: 09/08/17
 * Time: 2:17
 */

namespace AppBundle\Contracts\Repository;


use AppBundle\Entity\Pembayaran;

interface PembayaranInterface
{
    /**
     * @param $id
     * @return Pembayaran
     */
    public function findById($id);

    /**
     * @param $user
     * @return Pembayaran
     */
    public function findByUser($user);
}