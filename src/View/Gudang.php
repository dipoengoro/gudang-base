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

            echo PHP_EOL . "Menu" . PHP_EOL;
            echo "1. Tambah Barang" . PHP_EOL;
            echo "2. Edit Barang" . PHP_EOL;
            echo "3. Hapus Barang" . PHP_EOL;
            echo "x. Keluar" . PHP_EOL;

            $pilihan = Input::input("Pilih: ");
            if ($pilihan == "1") {
                echo "Memilih 1" . PHP_EOL;
            } elseif ($pilihan == "2") {
                echo "Memilih 2" . PHP_EOL;
            } elseif ($pilihan == "3") {
                echo "Memilih 3" . PHP_EOL;
            } else if ($pilihan == "x") {
                break;
            } else {
                echo "Pilihan tidak dimengerti" . PHP_EOL;
            }
        }
        echo "Sampai jumpa lagi" . PHP_EOL;
    }
}