<?php

$faucetTitle = "B2N COIN FAUCET";
$faucetSubtitle = "Every 4 hours you can get free B2N";
$logo = "images/b2ncoin.png";

//Faucet address for donations
$faucetAddress = "btc2fgWmynZdcRzztsNrYCXzadV9QYkNdcFxcVWud9XfHpcfGMk5SbKbjzMLkRRKDQCB8fDpRNgfyhnTxmjN2M4w8szZxiL3B3S";

//Reward time in hours
$rewardEvery = "4";
//Max reward and min reward as decimals Ex: Min = 10.0 & Max = 20.0
$minReward = "2"; //Remember that the minimum for an eobot deposit is 1 B2N as reward.
$maxReward = "4"; 
//Transaction fee is set to 0.01 B2N for every request.

//Database connection
$userDB = "DATABASEUSER";
$database = "DATABASE";
$passwordDB = "PASSWORD";
$hostDB = "127.0.0.1";


//Recaptcha Keys. You can get yours here: https://www.google.com/recaptcha/
$keys = array(
	'site_key' => '',
	'secret_key' => ''
);

//Addresses that can request more than one time but with a different payment ID.
$clearedAddresses = array(
	/*"Eobot" => "22694R3K1JvGf1m98pBsbaXCA3ULQz4xdQiYHgnNAdsVDqZDjiTH9CMj6QHhKD232wPeYtfypNzp5TX5L3NcGGSmJ8pWnPJ",
	"Poloniex" => "25cZNQYVAi3issDCoa6fWA2Aogd4FgPhYdpX3p8KLfhKC6sN8s6Q9WpcW4778TPwcUS5jEM25JrQvjD3XjsvXuNHSWhYUsu",
	"HitBTC" => "24zavX3Bi2PiKGWLKh4bPGTiMsn4iHf3Y6JnKCF6V1PeBpDpuwiAMZ8di7ok6B5SQT6UXUtQgusruCoXbqUZm8VJAfq2xKK"*/
);?>