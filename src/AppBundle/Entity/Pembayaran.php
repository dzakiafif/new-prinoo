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
     * @var string
     */
    private $namaPembayar;

    /**
     * @var string
     */
    private $emailPembayar;

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
     * Set namaPembayar
     *
     * @param string $namaPembayar
     * @return Pembayaran
     */
    public function setNamaPembayar($namaPembayar)
    {
        $this->namaPembayar = $namaPembayar;

        return $this;
    }

    /**
     * Get namaPembayar
     *
     * @return string 
     */
    public function getNamaPembayar()
    {
        return $this->namaPembayar;
    }

    /**
     * Set emailPembayar
     *
     * @param string $emailPembayar
     * @return Pembayaran
     */
    public function setEmailPembayar($emailPembayar)
    {
        $this->emailPembayar = $emailPembayar;

        return $this;
    }

    /**
     * Get emailPembayar
     *
     * @return string 
     */
    public function getEmailPembayar()
    {
        return $this->emailPembayar;
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
