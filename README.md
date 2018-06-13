# PDFMerger
PHP Library to merge PDF files

### Using Composer
```
{
    "require": {
        "peytwik/pdf-merger": "dev-master"
    }
}
```

### Example Usage
```php

//include autoloading
include "vendor/autoload.php";

//initiate class
$merger = new \Peytwik\PDFMerger\PDFMerger;

//add directory where the files are located
$dir = $_SERVER['DOCUMENT_ROOT'] . "/";

//add the pdf files
$merger->AddFile($dir . 'pdf-sample.pdf');
$merger->AddFile($dir . 'sample.pdf');

//generate the file
$output = $merger->GenerateFile($dir . 'merged.pdf');

```