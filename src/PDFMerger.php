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
            return ("Invalid output destination.");
            exit();
        }

        if( count($this->files) <= 0 ){
            return ("No PDF files to be merged.");
            exit();
        }

        $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=" . $dest_pdf_file . " ";
        foreach ($this->files as $file) {
            if( file_exists($file) || $file !== "" ){
                $cmd .= $file." ";
            }
        }
        
        $results = shell_exec($cmd);
        return ("PDF files successfully merged.");
        exit();

    }

}