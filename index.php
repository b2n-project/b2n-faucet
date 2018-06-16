<?php
ini_set('max_execution_time', 20);
require_once 'classes/jsonRPCClient.php';
require_once 'classes/recaptcha.php';
require_once 'config.php';

?><!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title><?php echo $faucetTitle; ?></title>
	<meta property="og:locale" content="en_US" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="B2N COIN FAUCET" />
	<meta property="og:description" content="B2N is a secure and anonymous digital currency."/>
	<meta property="og:url" content="https://faucet.bitcoin2.network/" />
	<meta property="og:site_name" content="B2N COIN FAUCET" />
	<meta property="og:image" content="images/b2ncoin.png" />
	<meta property="og:image:secure_url" content="images/b2ncoin.png" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="630" />

	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="images/favicon.ico">
	<link rel="icon" type="image/icon" href="images/favicon.ico" >

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">

	<script>var isAdBlockActive=true;</script>
	<script src="js/advertisement.js"></script>
	<script>
	if (isAdBlockActive) { 
		window.location = "./adblocker.php"
	}
</script>
</head>

<body>

  <div class="container">

    <div id="login-form">

	  
	  <h3><a href="./"><img src="<?php echo $logo; ?>" height="256"></a><br /><br /> <?php echo $faucetSubtitle; ?></h3>
	  
	  
      <fieldset>

        <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->
        <iframe data-aa='846609' src='//ad.a-ads.com/846609?size=468x60' scrolling='no' style='width:468px; height:60px; border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe>
        <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->

        <br />

		

          <?php                  

        $b2ncoin = new jsonRPCClient('http://127.0.0.1:19635/json_rpc');

        $balance = $b2ncoin->getbalance();
        $availableBalance = $balance['available_balance'];
        $lockedBalance = $balance['locked_amount'];
        $coinunits = 100000000; // 8 digits after atomic
        $totalB2N =  ($availableBalance+$lockedBalance)/$coinunits;
        
        $recaptcha = new Recaptcha($keys);
        //Available Balance
        $faucetBalance = number_format(round($availableBalance/$coinunits,8),8,'.', '');
        ?>

        <form action="request.php" method="POST">

          <?php if(isset($_GET['msg'])){
            $message = $_GET['msg']; 

            if($message == "captcha"){?>
            <div  id="alert" class="alert alert-error radius">
            Invalid Captcha, enter the correct one.            </div>
            <?php }else if($message == "wallet"){ ?>

            <div id="alert" class="alert alert-error radius">
              Please enter the correct B2N address.
            </div>
            <?php }else if($message == "success"){ ?>

            <div class="alert alert-success radius">
              You won <?php echo $_GET['amount']; ?> B2N.<br/><br/>
              You will get <?php echo $_GET['amount']-0.01; ?> B2N. (Network fee 0.01)<br/>
              <a target="_blank" href="http://explorer.bitcoin2.network/?hash=<?php echo $_GET['txid']; ?>#blockchain_transaction">Check in Blockexplorer</a>
            </div>
            <?php }else if($message == "paymentID"){ ?>

            <div id="alert" class="alert alert-error radius">
              Check your Payment ID. <br>It should consist of 64 characters without special characters.
            </div>
            <?php }else if($message == "notYet"){ ?>

            <div id="alert" class="alert alert-warning radius">
              B2N coins are issued once every 4 hours. Come on later.
            </div>
            <?php } ?>

            <?php } ?>
            <div class="alert alert-info radius">
              Balance: <?php echo $faucetBalance ?> B2N.<br>
              <?php

              $link = mysqli_connect($hostDB, $userDB, $passwordDB, $database);

              $query = "SELECT SUM(payout_amount) FROM `payouts`;";

              $result = mysqli_query($link, $query);
              $dato = mysqli_fetch_array($result);

              $query2 = "SELECT COUNT(*) FROM `payouts`;";

              $result2 = mysqli_query($link, $query2);
              $dato2 = mysqli_fetch_array($result2);



              mysqli_close($link);
              ?>

              Gifted: <?php echo $dato[0]/$coinunits; ?> B2N. and <?php echo $dato2[0];?> payout(s).
            </div>

            <?php if($faucetBalance<1.0){ ?>
            <div class="alert alert-warning radius">
             The pool is empty or the balance is less than the gain. <br> Come on later, &ndash; maybe someone will sacrifice us a few B2N Coin.
           </div>

           <?php } elseif (!$link) {
		   
		  // $link = mysqli_connect($hostDB, $userDB, $passwordDB, $database);

			 
					die('Error' . mysql_error());
				}  else {  ?>

           <input type="text" name="wallet" required placeholder="B2N Address">

           <input type="text" name="paymentid" placeholder="Payment ID (Optional)" >
           <br/>
           <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->
           <iframe data-aa='846609' src='//ad.a-ads.com/846609?size=120x60' scrolling='no' style='width:120px; height:60px; border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe>		   
           <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->
           <br/>
           <?php 
           echo $recaptcha->render();     
           ?>

           <center><input type="submit" value="Get free B2N coins"></center>
           <br>
           <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->
          <iframe data-aa='846609' src='//ad.a-ads.com/846609?size=120x60' scrolling='no' style='width:120px; height:60px; border:0px; padding:0;overflow:hidden' allowtransparency='true'></iframe>
           <!-- ADS ADS ADS ADS ADS ADS ADS ADS ADS -->
           <?php } ?>
           <br>
		     <?php /*
           <div class="table-responsive">
            <table class="table table-bordered table-condensed">
              <thead>
                <tr>
                  <th><h6><b>Cleared Sites</b><br> <small>Sites that have their wallets allowed to request more than 1 time but only with a different payment id.</small></h6></th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($clearedAddresses as $key => $item) {
                  echo "<tr>
                  <th>".$key."</th>
                  </tr>";

                }?>
              </tbody>
            </table>
          </div>
*/?>

          <div class="table-responsive">
            <h6><b>Last 5 additions</b></h6>
            <table class="table table-bordered table-condensed">
              <thead>
                <tr>
                  <th>Date</th>
                  <th>Amount</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                $deposits = ($b2ncoin->get_transfers());

                $transfers = array_reverse(($deposits["transfers"]),true);
                $contador = 0;
                foreach($transfers as $deposit){
                  if($deposit["output"] == ""){
                    if($contador < 6){
                      $time = $deposit["time"];
                      echo "<tr>";
                      echo "<th>".gmdate("Y-m-d H:i:s", $time)."</th>";
                      echo "<th>".round($deposit["amount"]/$coinunits,8)."</th>";
                      echo "</tr>";
                      $contador++;
                    }
                  }


                }
                ?>
              </tbody>
            </table>
          </div>
          <p style="font-size:10px;">Donate some B2N Coin to support this crane. <br>Address: <?php echo $faucetAddress; ?></p></center>
          <footer class="clearfix">
          </footer>
        </form>

      </fieldset>

    </div> <!-- end login-form -->

  </div>


  <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
  <?php if(isset($_GET['msg'])) { ?>
  <script>
  setTimeout( function(){ 
    $( "#alert" ).fadeOut(3000, function() {
    });
  }  , 10000 );
  </script>
  <?php } ?>


</body>
</html>