##B2N Coin Faucet Installation##

This faucet runs on a linux environment with PHP and MYSQL, and it was tested on Ubuntu 15.04 with PHP 5.6.4 and MariaDB 5.5.

Faucet is set to work on the same server as B2N wallet and B2N daemon.

First of all you need to create a new database and create this table on it for the faucet to save all requests:
```
CREATE TABLE `payouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `payout_amount` float NOT NULL,
  `payout_address` varchar(100) NOT NULL,
  `payment_id` varchar(75) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

ALTER TABLE `payouts`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `payouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
```

After you create database you need to edit config.php with all your custom parameters and also database information.


Now for faucet to communicate with B2N wallet you need to run simplewallet as this:

```bash
./simplewallet --wallet-file=walletName --pass=password --rpc-bind-port=18070 --rpc-bind-ip=127.0.0.1
```

Note: Run this command after you already created a wallet with simplewallet commands.

* wallet.bin needs to be the wallet file name that you enter when you created your wallet.
* password needs to be the password to open your wallet
* rpc-bind-port and rpc-bind-ip can be changed if so, you need to edit index.php and request.php (Please don't edit, as you may end opening the wallet rpc to the public)


And B2N daemon as this:

```bash
./bitcoin2networkd --enable-cors=*  --enable_blockexplorer --rpc-bind-ip=0.0.0.0
```

To keep bytecoind and simplewallet on background you can use screen command.

Advertisements can be edited on the index.php they are between this lines for an easy location:

           <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->
           <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->


After all this steps you should be ready to go ;)
