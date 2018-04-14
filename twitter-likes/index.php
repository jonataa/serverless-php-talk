<?php

require __DIR__.'/vendor/autoload.php';

use Kreait\Firebase\Factory;
use Kreait\Firebase\ServiceAccount;

function main(Array $args = [])
{
    $like = array_merge([], $args);

    // This assumes that you have placed the Firebase credentials in the same directory
    // as this PHP file.
    $serviceAccount = ServiceAccount::fromJsonFile(
        __DIR__.'/darkmira-7ebb1-firebase-adminsdk-2gv1b-31430e1542.json');

    $firebase = (new Factory)
        ->withServiceAccount($serviceAccount)
        // The following line is optional if the project id in your credentials file
        // is identical to the subdomain of your Firebase project. If you need it,
        // make sure to replace the URL with the URL of your project.
        ->withDatabaseUri('https://darkmira-7ebb1.firebaseio.com')
        ->create();

    $database = $firebase->getDatabase();

    $newLike = $database
        ->getReference('darkmira/likes')
        ->push($like);

    return ['msg' => 'Like added!', 'key' => $newLike->getKey(), 'like' => $like];
}