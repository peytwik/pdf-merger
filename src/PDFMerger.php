<?php

namespace Peytwik;

class PDFMerger
{

    protected $files = [];

    public function AddFile($source_pdf_file){
        $this->files[] = $source_pdf_file;
    }

    public function GenerateFile($dest_pdf_file = ""){
        if( !file_exists($dest_pdf_file) || $dest_pdf_file == "" ){
            $this->OutputMessage("Output destination not found.");
        }

        if( count($this->files) <= 0 ){
            $this->OutputMessage("No PDF files to be merged.");
        }

        $cmd = "gs -q -dNOPAUSE -dBATCH -sDEVICE=pdfwrite -sOutputFile=" . $this->destination . " ";
        foreach ($this->files as $file) {
            if( file_exists($file) || $file !== "" ){
                $cmd .= $file." ";
            }
        }
        if( shell_exec($cmd) ){
            $this->OutputMessage("PDF files successfully merged.");
        }
        else{
            $this->OutputMessage("Unable to merge PDF files.");
        }
    }


    protected function OutputMessage($message){
        echo $message;
        exit();
    }

}