<?php

require __DIR__ . '/vendor/autoload.php';

$creds = 'credentials.json';
$sheedId = '1SrwjTAL8qonb_4zRkn8msYNllID107R6fcKwVN1BljY';
$range = 'Sheet1';

$client = new Google_Client();
$client->setAuthConfigFile($creds);
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Sheets::SPREADSHEETS);

$body = new Google_Service_Sheets_ValueRange([
	'values' => [
		array_values($_GET)
	]
]);

$params = [
	'valueInputOption' => 'USER_ENTERED'
];

$service = new Google_Service_Sheets($client);
$result = $service->spreadsheets_values->append($sheedId, $range, $body, $params);

echo sprintf("%d cells appended.", $result->getUpdates()->getUpdatedCells());
