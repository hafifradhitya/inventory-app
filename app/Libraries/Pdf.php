<?php namespace App\Libraries;

require_once APPPATH.'ThirdParty/dompdf/autoload.php';

class Pdf
{
    public function generate($html, $filename='', $paper = '', $orientation = '', $stream=true)
    {
        $options = new \Dompdf\Options();
        $options->set('isRemoteEnabled', true);
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new \Dompdf\Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper($paper, $orientation);
        $dompdf->render();

        if ($stream)
        {
            $dompdf->stream($filename.'.pdf', ['Attachment' => 0]);
        }
        else
        {
            return $dompdf->output();
        }
    }
}