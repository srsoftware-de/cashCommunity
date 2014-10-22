<h2><?php print t('Balance overview')?></h2>
<?php
$mate_id=$_POST['flatmate']['id'];
$mate_name=$_POST['flatmate']['name'];
print str_replace('%flatmate',$mate_name,t('showing the balances of %flatmate.'));
?>
<form action="." method="POST">
  <input type="hidden" name="flatmate[id]" value="<?php print $mate_id; ?>" />
  <input type="hidden" name="flatmate[name]" value="<?php print $mate_name; ?>" />
  <button type="submit" name="action" value="show payments"><?php print t('show payments');?></button>  
</form> 
<table>
  <tr>
    <th><?php print t('ID');?></th>
    <th><?php print t('Description');?></th>
    <th><?php print t('Value');?></th>
    <th><?php print t('Allotment');?></th>
		<th><?php print t('Proportional value');?></th>
	</tr>
	
	<?php
	$invoice_sum=0; 
	foreach ($balance as $invoice_id => $invoice){
	  $value=ceil($invoice['part']*$invoice['value']*100)/100;
	  $invoice_sum+=$value;
	  ?>
		<tr>
			<td><?php print $invoice_id;?></td>
		  <td><?php print $invoice['description'];?></td>
		  <td><?php print $invoice['value'];?></td>
		  <td><?php print $invoice['part'];?></td>
			<td><?php print $value; ?></td>
		</tr>
	<?php			
	}	
	?>
	<tr>
    <td>-</td>
    <td><?php print t('Sum of all invoices');?></td>
    <td>-</td>
    <td>-</td>
		<td><?php print $invoice_sum;?></td>
	</tr>
	
		<?php
	$payment_sum=0; 
	foreach ($data['payments'][$mate_id] as $payment_id => $payment){
	  $payment_sum+=$payment['value'];
	  ?>
		<tr>
			<td><?php print $payment_id;?></td>
		  <td><?php print $payment['description'];?></td>
		  <td><?php print $payment['value'];?></td>
		  <td>100.00%</td>
			<td><?php print $payment['value']; ?></td>
		</tr>
	<?php			
	}	
	?>
	<tr>
    <td>-</td>
    <td><?php print t('Sum of all payments');?></td>
    <td>-</td>
    <td>-</td>
		<td><?php print $payment_sum;?></td>
	</tr>	
	<tr>
    <td>-</td>
    <td><?php $sum=$payment_sum-$invoice_sum;
    					if ($sum>0) {
    						print t('Deposit');
    					} else {
    					  print t('Debit');
    					}?></td>
    <td>-</td>
    <td>-</td>
		<td><?php print abs($sum);?></td>
	</tr>
	
</table>