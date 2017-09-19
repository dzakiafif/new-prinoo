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
     * @var string
     */
    private $description;

    /**
     * @var string
     */
    private $profileBarang;

    /**
     * @var int
     */
    private $isTop;

    /**
     * @var int
     */
    private $isNew;


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

    /**
     * @param $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param $profileBarang
     * @return $this
     */
    public function setProfileBarang($profileBarang)
    {
        $this->profileBarang = $profileBarang;

        return $this;
    }

    /**
     * @return string
     */
    public function getProfileBarang()
    {
       return $this->profileBarang;
    }

    /**
     * @param $isTop
     * @return $this
     */
    public function setIsTop($isTop)
    {
        $this->isTop = $isTop;

        return $this;
    }

    /**
     * @return int
     */
    public function getIsTop()
    {
        return $this->isTop;
    }

    /**
     * @param $isNew
     * @return $this
     */
    public function setIsNew($isNew)
    {
        $this->isNew = $isNew;

        return $this;
    }

    /**
     * @return int
     */
    public function getIsNew()
    {
        return $this->isNew;
    }

    

    public function addItem($id)
    {

    }
}

