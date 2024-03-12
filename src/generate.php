<?php
# This file is used to generate index.html in /public directory

$pdfs = [];
$files = scandir(__DIR__ . '/../docs');
foreach ($files as $file) {
    if (substr($file, -4) !== '.pdf') {
        continue;
    }
    $pdfs[] = [
        'url' => $file,
        'size' => round(filesize(__DIR__ . '/../docs/' . $file) / 1024, 1) . ' KB',
        'title' => ucfirst(str_replace(['.pdf', '-'], ['', ' '], $file)),
    ];
}

function generateReadme(array $pdfs)
{
    ob_start();
    ?>
# pdf-test-files

This is a set of PDF files for testing purposes.

[Demo site](https://13dagger.github.io/pdf-test-files/)

| File | Size |
|--|--|
<?php foreach ($pdfs as $pdf) { ?>
|[<?= $pdf['title'] ?>](./docs/<?=$pdf['url'] ?>) | <?= $pdf['size'] ?> |
<?php } ?>

## Contributing

The files generated with chromium "Print to PDF" feature and compressed using the ghostscript command:
```bash
 gs -q -dNOPAUSE -dBATCH -dSAFER -sDEVICE=pdfwrite -dPDFSETTINGS=/screen -dEmbedAllFonts=false -dSubsetFonts=false -dAutoRotatePages=/PageByPage -dColorImageDownsampleType=/Bicubic -dColorImageResolution=150 -dGrayImageDownsampleType=/Bicubic -dGrayImageResolution=150 -dMonoImageDownsampleType=/Bicubic -dMonoImageResolution=150 -sOutputFile=output.pdf input.pdf
 ```

After modifying the pdf files, one should run ./src/generate.php to update github pages and README.md
    <?php
    file_put_contents(__DIR__ . '/../README.md', ob_get_clean());
}

function generateIndex(array $pdfs)
{
    $title = 'PDF test files';

    ob_start();

    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= $title ?></title>
        <style>
            body {
                max-width: 500px;
            }
        </style>
    </head>
    <body>
    <h1><?= $title ?></h1>
    <p>
        Explore the webpage for PDF test files, designed for software debugging and testing purposes.<br/>
        The collection includes a variety of PDFs simulating common scenarios in PDF processing software.<br/>
        From single-page documents to multi-page reports, the files cover various formats and complexities.<br/>
        Browse and download files easily to thoroughly test and debug your software, ensuring reliability and
        performance.<br/>
        Discover the library today to enhance your testing efforts.
    </p>
    <ul>
        <?php foreach ($pdfs as $pdf) { ?>
            <li>
                <a href="./<?= $pdf['url'] ?>" title="<?= $pdf['title'] ?>" target="_blank">
                    <?= $pdf['title'] ?> (<?= $pdf['size'] ?>)
                </a>
            </li>
        <?php } ?>
    </ul>
    </body>
    </html>
    <?php
    file_put_contents(__DIR__ . '/../docs/index.html', ob_get_clean());
}

generateIndex($pdfs);
generateReadme($pdfs);
