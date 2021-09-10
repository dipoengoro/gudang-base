<?php

namespace Dipoengoro\GudangBase\View;

use Dipoengoro\GudangBase\Service\BarangService;
use Dipoengoro\GudangBase\Util\Input;

class GudangView
{
    private BarangService $barangService;

    function __construct(BarangService $barangService)
    {
        $this->barangService = $barangService;
    }

    function showBarang(): void
    {
        while (true) {
            $this->barangService->showBarang();

            Input::titleBanner("Menu");
            Input::banner("1. Tambah Barang");
            Input::banner("2. Edit Barang");
            Input::banner("3. Hapus Barang");
            Input::banner("x. Keluar");

            $pilihan = Input::inputMenu("Pilih");
            if ($pilihan == "1") {
                $this->addBarang();
            } elseif ($pilihan == "2") {
                $this->updateBarang();
            } elseif ($pilihan == "3") {
                $this->removeBarang();
            } else if ($pilihan == "x") {
                break;
            } else {
                Input::banner("Pilihan tidak dimengerti");
            }
        }
        Input::banner("Sampai jumpa lagi");
    }

    function addBarang(): void
    {
        Input::titleBanner("Tambah Barang");
        $idBarang = Input::inputData("Kode Barang");
        $namaBarang = Input::inputData("Nama Barang");
        $hargaSatuan = Input::inputData("Harga (Rupiah)");
        $satuanBarang = Input::inputData("Satuan Barang");
        $sisaBarang = Input::inputData("Sisa barang");

        Input::titleBanner("Konfirmasi");
        Input::banner("Kode Barang: $idBarang");
        Input::banner("Nama Barang: $namaBarang");
        Input::banner("Harga (Rupiah): $hargaSatuan");
        Input::banner("Satuan Barang: $satuanBarang");
        Input::banner("Sisa Barang: $sisaBarang");

        while (true) {
            $pilihan = Input::inputMenu("Jika sesuai ketik 'y', jika ingin batalkan ketik 'x'");
            if ($pilihan == "x") {
                Input::banner("Membatalkan penambahan barang");
                break;
            } else if ($pilihan == "y") {
                $this->barangService->addBarang(
                    $idBarang,
                    $namaBarang,
                    $hargaSatuan,
                    $satuanBarang,
                    $sisaBarang
                );
                break;
            }
        }
    }

    function removeBarang(): void
    {
        Input::titleBanner("Hapus Barang");
        $idBarang = Input::inputData("Kode Barang");

        Input::titleBanner("Konfirmasi");
        $this->barangService->findBarang($idBarang);
        while (true) {
            $pilihan = Input::inputMenu("Jika sesuai ketik 'y', jika ingin batalkan ketik 'x'");
            if ($pilihan == "x") {
                Input::banner("Membatalkan penghapusan barang");
                break;
            } else if ($pilihan == "y") {
                $this->barangService->removeBarang($idBarang);
                break;
            }
        }
    }

    function updateBarang(): void
    {
        Input::titleBanner("Edit Barang");
        $idBarang = Input::inputData("Kode Barang");
        $barang = $this->barangService->findBarang($idBarang);
        Input::banner("Sekarang");
        Input::barang($barang);
        Input::banner("Edit");
        $idBaru = Input::inputData("Kode Barang");
        $namaBaru = Input::inputData("Nama Barang");
        $hargaBaru = Input::inputData("Harga (Rupiah)");
        $satuanBaru = Input::inputData("Satuan Barang");
        $sisaBaru = Input::inputData("Sisa barang");

        Input::titleBanner("Konfirmasi");
        Input::banner("Sekarang");
        Input::barang($barang);
        Input::banner("Baru");

        if ($idBaru != "") {
            $barang->setIdBarang($idBaru);
        }
        if ($namaBaru != "") {
            $barang->setNamaBarang($namaBaru);
        }
        if ($hargaBaru != "") {
            $barang->setHargaSatuan((int) $hargaBaru);
        }
        if ($satuanBaru != "") {
            $barang->setSatuanBarang($satuanBaru);
        }
        if ($sisaBaru != "") {
            $barang->setSisaBarang((float) $sisaBaru);
        }
        Input::barang($barang);

        while (true) {
            $pilihan = Input::inputMenu("Jika sesuai ketik 'y', jika ingin batalkan ketik 'x'");
            if ($pilihan == "x") {
                Input::banner("Membatalkan update barang");
                break;
            } else if ($pilihan == "y") {
                $this->barangService->updateBarang(
                    idBarang: $idBarang,
                    idBaru: $idBaru,
                    namaBaru: $barang->getNamaBarang(),
                    hargaBaru: $barang->getHargaSatuan(),
                    satuanBaru: $barang->getSatuanBarang(),
                    sisaBaru: $barang->getSisaBarang()
                );
                break;
            }
        }
    }
}
