<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pemesanan
 */
class Pemesanan
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
    private $totalPemesan;

    /**
     * @var string
     */
    private $totalHarga;

    /**
     * @var int
     */
    private $isProses;


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
     * @param $barang
     * @return $this
     */
    public function setBarang(Barang $barang)
    {
        $this->barang = $barang;

        return $this;
    }

    public function getBarang()
    {
        return $this->barang;
    }

    /**
     * Set totalPemesan
     *
     * @param string $totalPemesan
     * @return Pemesanan
     */
    public function setTotalPemesan($totalPemesan)
    {
        $this->totalPemesan = $totalPemesan;

        return $this;
    }

    /**
     * Get totalPemesan
     *
     * @return string 
     */
    public function getTotalPemesan()
    {
        return $this->totalPemesan;
    }

    /**
     * Set totalHarga
     *
     * @param string $totalHarga
     * @return Pemesanan
     */
    public function setTotalHarga($totalHarga)
    {
        $this->totalHarga = $totalHarga;

        return $this;
    }

    /**
     * Get totalHarga
     *
     * @return string 
     */
    public function getTotalHarga()
    {
        return $this->totalHarga;
    }

    public function getIsProses()
    {
        return $this->isProses;
    }

    public function setIsProses($isProses)
    {
        $this->isProses = $isProses;

        return $this;
    }
}
