# pdf-test-files

This is a set of PDF files for testing purposes.

[Demo site](https://13dagger.github.io/pdf-test-files/)

| File | Size |
|--|--|
|[Multiple pages](./docs/multiple-pages.pdf) | 9.2 KB |
|[Small](./docs/small.pdf) | 3.8 KB |
|[With images and landscape](./docs/with-images-and-landscape.pdf) | 55.8 KB |
|[With images](./docs/with-images.pdf) | 54.6 KB |

## Contributing

The files generated with chromium "Print to PDF" feature and compressed using the ghostscript command:
```bash
 gs -q -dNOPAUSE -dBATCH -dSAFER -sDEVICE=pdfwrite -dPDFSETTINGS=/screen -dEmbedAllFonts=false -dSubsetFonts=false -dAutoRotatePages=/PageByPage -dColorImageDownsampleType=/Bicubic -dColorImageResolution=150 -dGrayImageDownsampleType=/Bicubic -dGrayImageResolution=150 -dMonoImageDownsampleType=/Bicubic -dMonoImageResolution=150 -sOutputFile=output.pdf input.pdf
 ```

After modifying the pdf files, one should run ./src/generate.php to update github pages and README.md
    