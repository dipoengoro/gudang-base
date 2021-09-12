<?php

namespace Dipoengoro\GudangBase\View;

use Dipoengoro\GudangBase\Service\BarangService;
use Dipoengoro\GudangBase\Util\Input;
use Dipoengoro\GudangBase\Util\Validation;
use Exception;

class GudangView
{
    private BarangService $barangService;
    private Validation $validation;

    function __construct(BarangService $barangService, Validation $validation)
    {
        $this->barangService = $barangService;
        $this->validation = $validation;
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
        $success = true;

        Input::titleBanner("Tambah Barang");
        $idBarang = strtoupper(Input::inputData("Kode Barang"));
        $namaBarang = Input::inputData("Nama Barang");
        $hargaSatuan = Input::inputData("Harga (Rupiah)");
        $satuanBarang = Input::inputData("Satuan Barang");
        $sisaBarang = Input::inputData("Sisa barang");

        try {
            $this->validation->validateHarga($hargaSatuan);
            $this->validation->validateSisa($sisaBarang);
        } catch (Exception $e) {
            Input::banner($e->getMessage());
            $success = false;
        }

        if ($success) {
            Input::titleBanner("Konfirmasi");
            Input::banner("Kode Barang: $idBarang");
            Input::banner("Nama Barang: $namaBarang");
            Input::banner("Harga (Rupiah): $hargaSatuan");
            Input::banner("Satuan Barang: $satuanBarang");
            Input::banner("Sisa Barang: $sisaBarang");
        }

        while ($success) {
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
        $success = true;
        Input::titleBanner("Hapus Barang");
        $idBarang = Input::inputData("Kode Barang");

        if ($this->barangService->checkBarang($idBarang)) {
            Input::titleBanner("Konfirmasi");
            $this->barangService->findBarang($idBarang);
        } else {
            Input::banner("Kode barang tidak ditemukan");
            $success = false;
        }
        while ($success) {
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
        $success = true;
        Input::titleBanner("Edit Barang");
        $idBarang = Input::inputData("Kode Barang");
        if ($this->barangService->checkBarang($idBarang)) {
            $barang = $this->barangService->findBarang($idBarang);
            Input::banner("Sekarang");
            Input::barang($barang);
            Input::banner("Edit");
            $idBaru = Input::inputData("Kode Barang");
            $namaBaru = Input::inputData("Nama Barang");
            $hargaBaru = Input::inputData("Harga (Rupiah)");
            $satuanBaru = Input::inputData("Satuan Barang");
            $sisaBaru = Input::inputData("Sisa barang");

            try {
                $this->validation->validateHarga($hargaBaru);
                $this->validation->validateSisa($sisaBaru);
            } catch (Exception $e) {
                Input::banner($e->getMessage());
                $success = false;
            }

            if ($success) {
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
            }
        } else {
            Input::banner("Kode barang tidak ditemukan");
            $success = false;
        }

        while ($success) {
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
