<div id="header">
	<div class="row-fluid">
	  <div class="span6">
		<?php
			echo CHtml::image(Yii::app()->request->baseUrl.'/images/logo-sophie-paris-bw-small.png',
				"Sophie Paris Mactan",
				array("width"=>"118px" ,"height"=>"36px"));
		?>	  
	  </div>
	  <div class="span6 pull-right text-right">
		  <span><strong>
		  <?php
			switch($order->orderStatus->status)
			{
				case 'forOrder':
				case 'partial':
				case 'paid':
					echo 'SALES ORDER';
					break;
				case 'served':
					echo 'PROOF OF PURCHASE';
					break;
				default:
					echo 'TEMPORARY ORDER SUMMARY SLIP';
					break;
			}
		  ?>
		  </strong></span>
		  <br />
		  <em>Trasaction No.</em> <a href="#" onclick="window.print(); return false;"><strong>BC245<?php echo str_pad($order->id, 10, "0", STR_PAD_LEFT); ?></strong></a> 
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
				<em>Date Ordered</em>: <strong><?php echo date('d M Y g:i A', strtotime($order->dateCreated)); ?></strong>
				<br />
				<em>Date Printed</em>: <strong><?php echo date('d M Y g:i A'); ?></strong>
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
						<th>Item Description</th>
						<th style="text-align: right;">Catalog Price</th>
						<th style="text-align: right;">Discount</th>
						<th style="text-align: right;">Net Price</th>
						<th style="text-align: center;">Quantity</th>
						<th style="text-align: right;">Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$totalGross = 0;
					$totalNet = 0;
					$netPrice = 0;
					$amount = 0;
					foreach($order->orderdetails as $orderDetail): 
						if($orderDetail->orderDetailStatus->_active)
						{
							$netPrice = $orderDetail->product->catalogPrice * ( 1 - ( $orderDetail->discount / 100 ) );
							$amount = $netPrice * $orderDetail->quantity;

							$totalGross += $orderDetail->product->catalogPrice * $orderDetail->quantity;
							$totalNet += $amount;
						}
					?>
						<tr>
							<td>
							<?php 
								if(!$orderDetail->orderDetailStatus->_active) echo '<del>';
								echo $orderDetail->product->codename; 
								if(!$orderDetail->orderDetailStatus->_active) echo '</del>';
							?>
							</td>
							<td style="text-align: right;">
							<?php 
								if(!$orderDetail->orderDetailStatus->_active) echo '<del>';
								echo number_format($orderDetail->product->catalogPrice, 2); 
								if(!$orderDetail->orderDetailStatus->_active) echo '</del>';
							?>
							</td>
							<td style="text-align: right;">
							<?php 
								if(!$orderDetail->orderDetailStatus->_active) echo '<del>';
								echo $orderDetail->discount . ' %'; 
								if(!$orderDetail->orderDetailStatus->_active) echo '</del>';
							?>
							</td>
							<td style="text-align: right;">
							<?php 
								if(!$orderDetail->orderDetailStatus->_active) echo '<del>';
								echo number_format($netPrice, 2); 
								if(!$orderDetail->orderDetailStatus->_active) echo '</del>';
							?>
							</td>
							<td style="text-align: center;">
							<?php 
								if(!$orderDetail->orderDetailStatus->_active) echo '<del>';
								echo $orderDetail->quantity; 
								if(!$orderDetail->orderDetailStatus->_active) echo '</del>';
							?>
							</td>
							<td style="text-align: right;">
							<?php 
								if(!$orderDetail->orderDetailStatus->_active) echo '<del>';
								echo number_format($amount, 2); 
								if(!$orderDetail->orderDetailStatus->_active) echo '</del>';
							?>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="2" style="text-align: right;"><em>Gross Total</em>: <strong>Php <?php echo number_format($totalGross, 2); ?></strong></td>
						<td colspan="4" style="text-align: right;"><em>Total Amount</em>: <strong>Php <?php echo number_format($totalNet, 2); ?></strong></td>
					</tr>
				</tfoot>
			</table>
		</div>
	</div>
</div>

<div class="clear"></div>

<div class="footer">
	<div class="row-fluid">
		<div class="span4">
			<strong>Payment Summary:</strong>
			<br />
			&nbsp;&nbsp;<em>Total</em>: <strong>Php <?php echo number_format($order->totalPayment, 2); ?></strong>
			<?php if($totalNet - $order->totalPayment > 0): ?>
				<br />
				&nbsp;&nbsp;<em>Balance</em>: <strong>Php <?php echo number_format($totalNet - $order->totalPayment, 2); ?></strong>
			<?php endif; ?>
		</div>
		<div class="span4">
			<strong>Processed By</strong>: 
			<br /><br />___________________________________
		</div>
		<div class="span4">
			<div class="pull-right">
				<strong>Received By</strong>: 
				<br /><br />_____________________________________
				<br /><em>(Signature Over Printed Name / Date)</em>
			</div>
		</div>
	</div>
</div>