<?php

namespace Peytwik\PDFMerger;

class PDFMerger
{

    protected $files = [];

    public function AddFile($source_pdf_file){
        $this->files[] = $source_pdf_file;
    }

    public function GenerateFile($dest_pdf_file = ""){
        if( $dest_pdf_file == "" ){
            $this->OutputMessage("Invalid output destination.");
        }

        if( count($this->files) <= 0 ){
            $this->OutputMessage("No PDF files to be merged.");
        }

        $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=" . $dest_pdf_file . " ";
        foreach ($this->files as $file) {
            if( file_exists($file) || $file !== "" ){
                $cmd .= $file." ";
            }
        }
        
        $results = shell_exec($cmd);
        $this->OutputMessage("PDF files successfully merged.");

    }


    protected function OutputMessage($message){
        echo $message;
        exit();
    }

}