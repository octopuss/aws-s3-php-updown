<?php

require('../vendor/autoload.php');

$client = new Aws\S3\S3Client(array(
    'version' => 'latest',
    'credentials' => array(
        'key' => getenv('AWS_ACCESS_KEY_ID'),
        'secret' => getenv('AWS_SECRET_ACCESS_KEY')
    ),
    'region' => 'eu-central-1'
));

$bucket = 'chimerahk-files';
$target = '/Users/Ivan/Work/Sites/chimerahk-cz/temp';

$iterator = $client->getIterator('ListObjects', array(
    'Bucket' => $bucket
));

foreach ($iterator as $object) {
    if(substr($object['Key'],-1,1)!=='/') {
        $client->getObject(array(
            'Bucket' => $bucket,
            'Key' => $object['Key'],
            'SaveAs' => $target . DIRECTORY_SEPARATOR . $object['Key']
        ));
    }
}


