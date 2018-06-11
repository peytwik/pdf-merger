<?php

namespace Peytwik\PDFMerger;

class PDFMerger
{

    protected $files = [];
    protected $destination = "";

    public function __construct($dest_pdf_file){
        $this->destination = $dest_pdf_file;
    }

    public function AddFile($source_pdf_file){
        $this->files[] = $source_pdf_file;
    }

    public function GenerateFile(){
        if( !file_exists($this->destination) || $this->destination == "" ){
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