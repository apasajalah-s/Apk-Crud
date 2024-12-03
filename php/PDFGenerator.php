<?php
require_once '../tcpdf/tcpdf.php';

class PDFGeerator {
    private $pdf;

    public function __construct() {
        //Inisialisasi objek TCPDF
        $this->pdf = new TCPDF();

        //set properto PDF
        $this->pdf->setCreator(PDF_CREATOR);
        $this->pdf->setAuthor('CRUD Application');
        $this->pdf->setTitle('Laporan Produk');
        $this->pdf->setSubject('Daftar Produk');
        $this->pdf->setKeywords('Produk, PDF, Laporan');
    }

    public function addTitle($title) {
        // Tambahkan halaman
        $this->pdf->AddPage();

        //Set font untuk judul
        $this->pdf->SetFont('helvetica', 'B', 16);
        $this->pdf->Cell(0, 10, $title, 0, 1, 'C');
        $this->pdf->Ln(5);
    }

    public function addTable($headers, $data) {
        // Set font untuk table
        foreach ($headers as $header) {
            $this->pdf->Cell(45, 7, $header, 1, 0, 'C');
        }
        $this->pdf->Ln();

        // Tambahkan data tabel
        foreach ($data as $row) {
            foreach ($row as $cell) {
                $this->pdf->Cell(45, 7, $cell, 1, 0, 'C');
            }
            $this->pdf->Ln();
        }
    }

    public function outputPDF($filename = 'Laporan.pdf') {
        // Keluarkan file PDF
        $this->pdf->Output($filename, 'I'); // 'I' untuk browser, 'D' untuk download langsung
    }
}
?>