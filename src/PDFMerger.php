<?php

namespace Peytwik\PDFMerger;

class PDFMerger
{

    protected $files = [];

    public function AddFile($source_pdf_file){
        $this->files[] = $source_pdf_file;
    }

    public function GenerateFile($dest_pdf_file){
        if( !file_exists($dest_pdf_file) || $dest_pdf_file == "" ){
            echo "Output destination not found.";
            exit();
        }

        if( count($this->files) <= 0 ){
            echo "No PDF files to be merged.";
            exit();
        }

        $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=" . $this->destination . " ";
        foreach ($this->files as $file) {
            if( file_exists($file) || $file !== "" ){
                $cmd .= $file." ";
            }
        }
        if( shell_exec($cmd) ){
            echo "PDF files successfully merged.";
            exit();
        }
        else{
            echo "Unable to merge PDF files.";
            exit();
        }
    }

}