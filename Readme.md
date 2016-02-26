# AWS S3 PHP DEMO
Demo of uploading and downloading files from AWS S3 using PHP. Before using please `AWS_ACCESS_KEY_ID` and      `AWS_SECRET_ACCESS_KEY` environment variables, setup bucket name, region and local folders. Application uses `composer` so you should run `composer install` to download necessary php dependencies. Than run

```bash
> php upload.php
```

or 

```bash
> php download.php
```

For more information see [AWS PHP SDK guides](http://docs.aws.amazon.com/aws-sdk-php/v3/guide/getting-started/basic-usage.html)