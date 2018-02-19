<?php

	$title = "Ma commande";

	if(!Auth::isLogged()){
		$_SESSION['error'] = "Vous devez vous connecter pour passer une commande !";
		session_write_close();
		header('location: /signin?redirect='.urlencode(PATH));
	}

	if(!isset($params[1]) OR $params[1] == ''){
		$_SESSION['error'] = "Vous devez cliquez sur une commande pour acceder a cette page!";
		session_write_close();
		header("location: https://www.heavyserver.com/");
	}

    $prep_stmt = "SELECT u_actif FROM hs_users WHERE u_id = ? LIMIT 1";
    $stmt = $pdo->prepare($prep_stmt);
    $stmt->execute(array($_SESSION['Auth']['id']));
    $checkActive = $stmt->fetch(PDO::FETCH_OBJ);
	if($checkActive AND !$checkActive->u_actif){
		$_SESSION['msglink'] = "Vous devez activer votre adresse mail avant de passer commande ! Cliquez pour renvoyer le mail de confirmation.";
		$_SESSION['link'] = "/resend_mail";
		session_write_close();
		header('location: /');
	}

	$query = 'SELECT o_id, o_type, o_prix, o_disque, os_bp, os_streaming, ov_cpu, ov_cpu_hz, ov_ram, OFFRE_TYPE from V_offres where o_libelle = ? LIMIT 1';
	if ($stmt = $pdo->prepare($query)) 
	{
        if ($stmt->execute(array($params[1])))
		{
			$row = $stmt->fetch(PDO::FETCH_BOTH);

			if ($row) 
			{
				$libelle = $params[1];
				$serviceid = $row[0];
				$type = $row[1];
				$prix = $row[2];
				$disk = $row[3];

				if ( gigaDisponible() - $disk < 0 ) {
					$error = "Cette offre n\'est plus disponible !";
				}

				$bp = $row[4];
				$isStreaming = $row[5];

				$cpuname = $row[6];
				$cpuhz = $row[7];
				$cpu = $cpuname.' '.$cpuhz;
				$ram = $row[8];

				$offre_type = $row[9];

				if(isset($_POST['reduc']))
				{
					$nomCoupon = $_POST['reduc'];
					$tabCoupon = couponExiste($nomCoupon);
					if($tabCoupon){
						$numCoupon = $tabCoupon['coup_id'];
						if($tabCoupon['coup_type'] == 1)
							$newPrix = round($prix - $prix*$tabCoupon['coup_percent']/100,2);
						else if($tabCoupon['coup_type'] == 2)
							$newPrix = round($prix - $tabCoupon['coup_fixe'],2);
		                $_SESSION['succes'] = "Le coupon a été appliqué au total !";
		                session_write_close();
					}
				}

			} else {
				$error = "Cette offre n\'existe pas";
			}
		} else {
			$error = "Erreur récupération des informations liés a l\'offre";				
		}
	} else {
		$error = "Erreur récupération des informations liés a l\'offre";	
	}

	if(isset($error) AND !empty($error)){
		$_SESSION['error'] = $error;
		session_write_close();
		header("location: https://www.heavyserver.com/");
	}
?>

<!-- page heading -->
<div id="breadcrumb_wrapper">
	<div class="wrap">
		
		<h3>Votre commande</h3>

		<div class="clear"></div>
	</div>
</div>		

<div class="content">
	<div class="wrap">	
		<div class="table-responsive" style="color:black;">
			<table class="table">
				<tbody>
					<?php if($offre_type == 'Seedbox') include 'vues/order_seedbox.php' ?>
					<tr>
						<td>Nom de l'offre :</td>
						<td><strong><?php echo $libelle ?></strong></td>
						<td></td>
					</tr>
					<?php if($cpuname AND $cpuhz) { ?>
					<tr>
						<td>CPU :</td>
						<td><strong><?php echo $cpu ?></strong></td>
						<td></td>
					</tr>
					<?php } 
					if($ram) { ?>
					<tr>
						<td>RAM :</td>
						<td><strong><?php echo $ram ?> Go</strong></td>
						<td></td>
					</tr>
					<?php } 
					if($disk) { ?>
					<tr>
						<td>Espace disque :</td>
						<td><strong><?php echo $disk ?>Go</strong></td>
						<td></td>
					</tr>
					<?php } 
					if($bp) { ?>
					<tr>
						<td>Connexion :</td>
						<td><strong><?php echo $bp ?>Mbps</strong></td>
						<td></td>
					</tr>
					<tr>
						<td>Bande passante :</td>
						<td><strong>Illimité</strong></td>
						<td></td>
					</tr>
					<?php } 
					if($isStreaming != null) { ?>
					<tr>
						<td>Streaming :</td>
						<td><strong><?php echo $streaming = ($isStreaming == 0) ? "<span class='label label-danger'>Non</span>" : "<span class='label label-success'>bientôt disponible</span>" ?></strong></td>
						<td></td>
					</tr>
					<?php } 
					if($type == 3) { ?>
					<tr>
						<td><abbr title="Application android permettant de gerer ses torrents">Transdroid : </abbr></td>
						<td><strong><span class='label label-success'>Oui</span></strong></td>
						<td></td>
					</tr>
					<tr>
						<td>Limitation torrents :</td>
						<td><strong><span class='label label-success'>Non</span></strong></td>
						<td></td>
					</tr>

					<?php } ?>
				</tbody>
			</table>
			<span style="text-align:right;"><strong>Abonnement : 1 mois</strong></span><br>
			<span style="text-align:right;"><strong>Total TTC : <?php echo $prix ?>€</strong></span><br>
			<?php echo (isset($newPrix)) ? "<span style='text-align:right;color:green'><strong>Total TTC après réduction : ".$newPrix."€</strong></span><br>" : "" ?>
			<form action="" method="post">
				Coupon de réduction ? 
				<br><input type="text" name="reduc" style="padding: 0px">
				<input type="submit" name="" value="Actualiser">
			</form>
			<br>
			En finalisant votre commande, vous avez pris connaissance au préalable des <a href="/cgv">Conditions Générales de Ventes</a>
			<br>
			<form action="https://www.paypal.com/fr/cgi-bin/webscr" method="post">
				<?php if(isset($nomCoupon)) { ?>
	                <input type="hidden" name="custom" value="<?php echo $_SESSION['Auth']['id'].'//'.$serviceid.'//'.$numCoupon ?>">
	            <?php } else { ?>
	                <input type="hidden" name="custom" value="<?php echo $_SESSION['Auth']['id'].'//'.$serviceid ?>">
	            <?php } ?>
                <input type="hidden" name="business" value="heavyservers@gmail.com">
				<input type="hidden" name="item_name" value="<?php echo $libelle ?>">
				<input type="hidden" name="cmd" value="_xclick">
				<input type="hidden" name="currency_code" value="EUR">
				<input type="hidden" name="amount" value="<?php echo (isset($newPrix)) ? $newPrix : $prix ?>">
				<input type="image" src="/images/PayButton.png" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">
			</form>
		</div>
	</div>
</div>