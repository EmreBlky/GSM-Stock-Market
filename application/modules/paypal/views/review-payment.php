<?php

echo '<pre>';
print_r($results);

?>

<h2>Confirm your informations</h2>
<table>
	<tbody>
		<tr>
			<td>Name:
			<td><?php echo  $results['FIRSTNAME']." ".$results['LASTNAME'] ?>
		</tr>
		<tr>
			<td>Email:
			<td><?php echo  $results['EMAIL'] ?>
		</tr>
		<tr>
                    <td>You will pay &pound;<?php echo  $results['AMT'] ?> on the first day of every month.
		</tr>
	<tbody>
</table>
<form action='paypal/order_confirm/<?php echo $results['TOKEN']; ?>/<?php echo $results['EMAIL']; ?>/<?php echo $results['SHIPTONAME']; ?>/<?php echo $results['SHIPTOSTREET']; ?>/<?php echo $results['SHIPTOCITY']; ?>/<?php echo $results['SHIPTOSTATE']; ?>/<?php echo $results['SHIPTOZIP']; ?>/<?php echo $results['SHIPTOCOUNTRYCODE']; ?>/<?php echo $results['AMT']; ?>' METHOD='POST'>
<input type="submit" value="Review"/>
</form>