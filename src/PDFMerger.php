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
            return "Output destination not found.";
        }

        if( count($this->files) <= 0 ){
            return "No PDF files to be merged.";
        }

        $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=" . $this->destination . " ";
        foreach ($this->files as $file) {
            if( file_exists($file) || $file !== "" ){
                $cmd .= $file." ";
            }
        }
        if( shell_exec($cmd) ){
            return "PDF files successfully merged.";
        }
        else{
            return "Unable to merge PDF files.";
        }
    }

}