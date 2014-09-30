<?php
// var_dump($order);
?>

<div id="header">
	<div class="row-fluid">
	  <div class="span6">
		<?php
			echo CHtml::image(Yii::app()->request->baseUrl.'/images/logo-sophie-paris-bw-small.png',
				"Sophie Paris Mactan",
				array("width"=>"157px" ,"height"=>"48px"));
		?>	  
	  </div>
	  <div class="span6 pull-right text-right">
		  <em>Order Trasaction No.</em> <a href="#" onclick="window.print(); return false;"><strong>BC245<?php echo str_pad($order->id, 10, "0", STR_PAD_LEFT); ?></strong></a> 
	  </div>
	</div>
	<br />
	<div class="row-fluid">
		<div class="span12 well">
			<div class="span6">
				<em>Ordered By</em>: <strong><?php echo $order->member->codename; ?></strong>
				<br />
				<em>Prepared By</em>: <strong><?php echo $order->user->username; ?></strong>
			</div>
			<div class="span6 text-right">
				<em>Date</em>: <strong><?php echo date('d M Y', strtotime($order->dateCreated)); ?></strong>
			</div>
		</div>
	</div>
</div>

<div id="body">
	<div class="row-fluid">
		<div id="order_details" class="span12">
			<table class="table table-condensed">
				<thead>
					<tr>
						<th style="text-align: center;">Quantity</th>
						<th>Item Description</th>
						<th style="text-align: right;">Catalog Price</th>
						<th style="text-align: right;">Discount</th>
						<th style="text-align: right;">Net Price</th>
						<th style="text-align: right;">Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$totalGross = 0;
					$totalNet = 0;
					foreach($order->orderdetails as $orderDetail): 
						$netPrice = $orderDetail->product->catalogPrice * ( 1 - ( $orderDetail->discount / 100 ) );
						$amount = $netPrice * $orderDetail->quantity;
						
						$totalGross += $orderDetail->product->catalogPrice * $orderDetail->quantity;
						$totalNet += $amount;
					?>
						<tr>
							<td style="text-align: center;"><?php echo $orderDetail->quantity; ?></td>
							<td><?php echo $orderDetail->product->codename; ?></td>
							<td style="text-align: right;"><?php echo number_format($orderDetail->product->catalogPrice, 2); ?></td>
							<td style="text-align: right;"><?php echo $orderDetail->discount; ?> %</td>
							<td style="text-align: right;"><?php echo number_format($netPrice, 2); ?></td>
							<td style="text-align: right;"><?php echo number_format($amount, 2); ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3" style="text-align: right;"><em>Gross Total</em>: <strong>Php <?php echo number_format($totalGross, 2); ?></strong></td>
						<td colspan="3" style="text-align: right;"><em>Total Amount</em>: <strong>Php <?php echo number_format($totalNet, 2); ?></strong></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>

<div class="clear"></div>

<div class="footer">
	<div class="row-fluid">
		<div class="span6">
			<strong>Payments:</strong>
			<br />
			&nbsp;&nbsp;<em>Total Payments Made</em>: <strong>Php <?php echo number_format($order->totalPayment, 2); ?></strong>
			<br />
			&nbsp;&nbsp;<em>Balance Due</em>: <strong>Php <?php echo number_format($totalNet - $order->totalPayment, 2); ?></strong>
		</div>
		<div class="span6">
			<div class="pull-right">
			<strong>Customer Signature</strong>: 
			<br /><br />
			<table>
				<tr>
					<td>_________________________________________</td>
				</tr>
				<tr>
					<td align="center"><em><?php echo $order->member->codename; ?></em></td>
				</tr>
			</table>
			</div>
		</div>
	</div>
</div>