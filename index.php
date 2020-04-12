<?php

require __DIR__ . '/vendor/autoload.php';

$creds = 'credentials.json';
$sheedId = '1SrwjTAL8qonb_4zRkn8msYNllID107R6fcKwVN1BljY';
$range = 'Sheet1';

$client = new Google_Client();
$client->setAuthConfigFile($creds);
$client->useApplicationDefaultCredentials();
$client->addScope(Google_Service_Sheets::SPREADSHEETS);

$service = new Google_Service_Sheets($client);

$body = new Google_Service_Sheets_ValueRange([
	'values' => [
		['test@example.com', 42, true],
		['foo@bar.net', 'hello', false]
	]
]);

$params = [
	'valueInputOption' => 'USER_ENTERED'
];

$result = $service->spreadsheets_values->append($sheedId, $range, $body, $params);
printf("%d cells appended.", $result->getUpdates()->getUpdatedCells());
