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
$path = '/Users/Ivan/Work/Sites/chimerahk-cz/files';

function getDirContents($dir, &$results = array()) {
    $files = scandir($dir);

    foreach ($files as $key => $value) {
        $path = realpath($dir . DIRECTORY_SEPARATOR . $value);
        if (!is_dir($path)) {
            $results[] = $path;
        } else if ($value != "." && $value != "..") {
            getDirContents($path, $results);
            $results[] = $path;
        }
    }
    return $results;
}


foreach (getDirContents($path) as $filePath) {
    $key = str_replace($path . DIRECTORY_SEPARATOR, "", $filePath);

    if (strpos($key, '.') !== false && strpos($key, '.DS_Store') == false) {
        echo "Processing " . $key . "\n";
        $result = $client->putObject(array(
            'Bucket' => $bucket,
            'Key' => $key,
            'SourceFile' => $path
        ));
        $client->waitUntil('ObjectExists', array(
            'Bucket' => $bucket,
            'Key' => $key
        ));
    }
}
