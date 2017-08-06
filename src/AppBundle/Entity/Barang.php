<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Barang
 */
class Barang
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $namaBarang;

    /**
     * @var string
     */
    private $hargaBarang;
    /**
     * @var int
     */
    private $jenisBarang;


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
     * Set namaBarang
     *
     * @param string $namaBarang
     * @return Barang
     */
    public function setNamaBarang($namaBarang)
    {
        $this->namaBarang = $namaBarang;

        return $this;
    }

    /**
     * Get namaBarang
     *
     * @return string
     */
    public function getNamaBarang()
    {
        return $this->namaBarang;
    }

    /**
     * Set hargaBarang
     *
     * @param string $hargaBarang
     * @return Barang
     */
    public function setHargaBarang($hargaBarang)
    {
        $this->hargaBarang = $hargaBarang;

        return $this;
    }

    /**
     * Get hargaBarang
     *
     * @return string
     */
    public function getHargaBarang()
    {
        return $this->hargaBarang;
    }

    /**
     * @param $jenisBarang
     * @return $this
     */
    public function setJenisBarang($jenisBarang)
    {
        $this->jenisBarang = $jenisBarang;

        return $this;
    }

    /**
     * @return int
     */
    public function getJenisBarang()
    {
        return $this->jenisBarang;
    }
}
