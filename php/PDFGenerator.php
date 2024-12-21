<?php
require_once '../TCPDF-main/tcpdf.php';

class PDFGenerator
{
    private $pdf;

    public function __construct()
    {
        $this->pdf = new TCPDF();

        $this->pdf->SetCreator(PDF_CREATOR);
        $this->pdf->SetAuthor('CRUD Application');
        $this->pdf->SetTitle('Laporan Produk');
        $this->pdf->SetSubject('Daftar Produk');
        $this->pdf->SetKeywords('Produk, PDF, Laporan');
    }

    public function addTitle($title)
    {
        $this->pdf->AddPage();

        $this->pdf->SetFont('helvetica', 'B', 16);
        $this->pdf->Cell(0, 10, $title, 0, 1, 'C');
        $this->pdf->Ln(5);
    }

    public function addTable($headers, $data)
    {
        $this->pdf->SetFont('helvetica', '', 12);

        foreach ($headers as $header) {
            $this->pdf->Cell(45, 7, $header, 1, 0, 'C');
        }
        $this->pdf->Ln();

        foreach ($data as $row) {
            foreach ($row as $cell) {
                $this->pdf->Cell(45, 7, $cell, 1, 0, 'C');
            }
            $this->pdf->Ln();
        }
    }

    public function outputPDF($filename = 'laporan.pdf')
    {
        // Keluarkan file PDF
        $this->pdf->Output($filename, 'I'); // 'I' untuk browser, 'D' untuk unduh langsung
    }
}
