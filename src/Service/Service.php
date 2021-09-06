<?php

namespace Dipoengoro\GudangBase\Service;

use Dipoengoro\GudangBase\Repository\BarangRepository;

interface BarangService
{
    function showBarang(): void;
    function addBarang(): bool;
    function removeBarang(): bool;
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
        echo "Daftar Barang" . PHP_EOL;
        $barangs = $this->barangRepository->findAll();
        foreach ($barangs as $barang) {
            echo $barang->getIdBarang() . " | " . $barang->getNamaBarang() . " | " .
                $barang->getHargaSatuan() . " | " . $barang->getSatuanBarang() . " | " .
                $barang->getSisaBarang() . PHP_EOL;
        }
    }

    function addBarang(): bool
    {
        return false;
    }

    function removeBarang(): bool
    {
        return false;
    }
}
