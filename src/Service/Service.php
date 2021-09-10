<?php

namespace Dipoengoro\GudangBase\Service;

use Dipoengoro\GudangBase\Entity\Barang;
use Dipoengoro\GudangBase\Repository\BarangRepository;
use Dipoengoro\GudangBase\Util\Input;

interface BarangService
{
    function showBarang(): void;
    function addBarang(
        string $idBarang,
        string $namaBarang,
        int $hargaSatuan,
        string $satuanBarang,
        float $sisaBarang
    ): void;
    function removeBarang(string $idBarang): void;
    function findBarang(string $idBarang): Barang;
    function updateBarang(
        string $idBarang,
        string $idBaru,
        string $namaBaru,
        string $hargaBaru,
        string $satuanBaru,
        string $sisaBaru
    ): void;
}

class BarangServiceImpl implements BarangService
{
    private BarangRepository $barangRepository;

    public function __construct(BarangRepository $barangRepository)
    {
        $this->barangRepository = $barangRepository;
    }

    function showBarang(): void
    {
        Input::titleBanner("Daftar Barang");
        $barangs = $this->barangRepository->findAll();
        foreach ($barangs as $barang) {
            Input::banner($barang->getIdBarang() . " | " . $barang->getNamaBarang() . " | " .
                $barang->getHargaSatuan() . " | " . $barang->getSatuanBarang() . " | " .
                $barang->getSisaBarang());
        }
    }

    function addBarang(
        string $idBarang,
        string $namaBarang,
        int $hargaSatuan,
        string $satuanBarang,
        float $sisaBarang
    ): void {
        $barang = new Barang(
            $idBarang,
            $namaBarang,
            $hargaSatuan,
            $satuanBarang,
            $sisaBarang
        );
        $this->barangRepository->add($barang);
        Input::banner("Berhasil menambahkan $namaBarang");
    }

    function removeBarang(string $idBarang): void
    {
        if ($this->barangRepository->check($idBarang)) {
            $this->barangRepository->remove($idBarang);
            Input::banner("Sukses menghapus barang dengan Kode Barang: $idBarang");
        } else {
            Input::banner("Kode barang tidak ditemukan");
        }
    }

    function findBarang(string $idBarang): Barang
    {
        $barang = null;
        if ($this->barangRepository->check($idBarang)) {
            $barang = $this->barangRepository->find($idBarang);
            return $barang;
        } else {
            Input::banner("Kode barang tidak ditemukan");
            return $barang;
        }
    }

    function updateBarang(
        string $idBarang,
        string $idBaru,
        string $namaBaru,
        string $hargaBaru,
        string $satuanBaru,
        string $sisaBaru
    ): void {
        if ($this->barangRepository->check($idBarang)) {
            if ($idBaru != "") {
                $this->barangRepository->updateId($idBarang, $idBaru);
                $this->barangRepository->updateNama($idBaru, $namaBaru);
                $this->barangRepository->updateHarga($idBaru, $hargaBaru);
                $this->barangRepository->updateSatuan($idBaru, $satuanBaru);
                $this->barangRepository->updateSisa($idBaru, $sisaBaru);
            }
            $this->barangRepository->updateNama($idBarang, $namaBaru);
            $this->barangRepository->updateHarga($idBarang, $hargaBaru);
            $this->barangRepository->updateSatuan($idBarang, $satuanBaru);
            $this->barangRepository->updateSisa($idBarang, $sisaBaru);
        } else {
            Input::banner("Kode barang tidak ditemukan");
        }
    }
}
