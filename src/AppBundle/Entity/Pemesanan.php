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
    private $namaPemesan;

    /**
     * @var string
     */
    private $emailPemesan;

    /**
     * @var string
     */
    private $alamatPemesan;

    /**
     * @var string
     */
    private $noHp;

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
     * Set namaPemesan
     *
     * @param string $namaPemesan
     * @return Pemesanan
     */
    public function setNamaPemesan($namaPemesan)
    {
        $this->namaPemesan = $namaPemesan;

        return $this;
    }

    /**
     * Get namaPemesan
     *
     * @return string 
     */
    public function getNamaPemesan()
    {
        return $this->namaPemesan;
    }

    /**
     * Set emailPemesan
     *
     * @param string $emailPemesan
     * @return Pemesanan
     */
    public function setEmailPemesan($emailPemesan)
    {
        $this->emailPemesan = $emailPemesan;

        return $this;
    }

    /**
     * Get emailPemesan
     *
     * @return string 
     */
    public function getEmailPemesan()
    {
        return $this->emailPemesan;
    }

    /**
     * Set alamatPemesan
     *
     * @param string $alamatPemesan
     * @return Pemesanan
     */
    public function setAlamatPemesan($alamatPemesan)
    {
        $this->alamatPemesan = $alamatPemesan;

        return $this;
    }

    /**
     * Get alamatPemesan
     *
     * @return string 
     */
    public function getAlamatPemesan()
    {
        return $this->alamatPemesan;
    }

    /**
     * Set noHp
     *
     * @param string $noHp
     * @return Pemesanan
     */
    public function setNoHp($noHp)
    {
        $this->noHp = $noHp;

        return $this;
    }

    /**
     * Get noHp
     *
     * @return string 
     */
    public function getNoHp()
    {
        return $this->noHp;
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
