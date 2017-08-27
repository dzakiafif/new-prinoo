<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pembayaran
 */
class Pembayaran
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $user;

    /**
     * @var int
     */
    private $barang;

    /**
     * @var string
     */
    private $pembayaranBerkas;

    /**
     * @var int
     */
    private $isConfirm;


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param User $user
     * @return $this
     */
    public function setUser(User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param Barang $barang
     * @return $this
     */
    public function setBarang(Barang $barang)
    {
        $this->barang = $barang;

        return $this;
    }

    /**
     * @return int
     */
    public function getBarang()
    {
        return $this->barang;
    }

    /**
     * Set pembayaranBerkas
     *
     * @param string $pembayaranBerkas
     * @return Pembayaran
     */
    public function setPembayaranBerkas($pembayaranBerkas)
    {
        $this->pembayaranBerkas = $pembayaranBerkas;

        return $this;
    }

    /**
     * Get pembayaranBerkas
     *
     * @return string 
     */
    public function getPembayaranBerkas()
    {
        return $this->pembayaranBerkas;
    }


    /**
     * @param $isConfirm
     * @return $this
     */
    public function setIsConfirm($isConfirm)
    {
        $this->isConfirm = $isConfirm;

        return $this;
    }

    public function getIsConfirm()
    {
        return $this->isConfirm;
    }
}
