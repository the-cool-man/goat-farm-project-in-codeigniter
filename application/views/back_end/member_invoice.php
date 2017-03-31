<?php $dna = $this->common_model->data_not_availabel;
$base_url = base_url();
$logo_url = 'assets/front_end/images/logo-wide.png';
if(isset($config_data['SiteLogo']) && $config_data['SiteLogo'] !='')
{
		$logo_url = 'assets/logo/'.$config_data['SiteLogo'];
}
	
?>
<style type="text/css">
	@media print
{
    .noprint {display:none;}
	h2{
		margin-top:0px !important;
		padding-top:0px !important;
	}
}
</style>

<div class="pad margin no-print">
  <!--<div class="alert alert-info" style="margin-bottom: 0!important;">												
    <h4><i class="fa fa-info"></i> Note:</h4>
    This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
  </div>-->
</div>
<section class="invoice">
	<div class="row">
    	<div class="col-xs-12">
      		<h2 class="page-header">
        		<img src="<?php echo $base_url.$logo_url;?>" alt="<?php echo $config_data['FriendlyName'];?>" style="max-width:300px;">
	      	</h2>
    	</div>
  	</div>
  	<div class="row invoice-info">
    	<div class="col-xs-4 invoice-col">
	  		From
      		<address>
     			<strong><?php echo $config_data['FriendlyName'];?></strong><br>
     			<div class="row">
     				<div class="col-xs-12">Contact No : <?php echo $config_data['ContactNumber'];?></div>
     				<div class="col-xs-12">Email : <?php echo $config_data['FromEmail'];?></div>
      			</div>
       		</address>
    	</div>
	    <div class="col-xs-4 invoice-col">
    		&nbsp;&nbsp;&nbsp; To
     		<address>
    			<div class="col-xs-12"><strong><?php echo $payment_data['DonerName'];?></strong></div>     			
    			<div class="col-xs-12">Mobile : <?php echo $payment_data['DonerContact'];?></div>
     			<div class="col-xs-12">Email : <?php echo $payment_data['DonerEmail'];?></div>
      		</address>
    	</div>
    	<div class="col-xs-4 invoice-col">
            <div class="col-xs-12"><strong>Receipt : </strong>INV001<?php echo $payment_data['ID'];?></div>
            <div class="col-xs-12"><strong>Transaction Id : </strong><?php echo $payment_data['ProcessID'];?></div>
          
    	</div>
	</div>
  	<div class="row">
    <br/>
  	<div class="col-xs-12 table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>Qty</th>
            <th>Donation For</th>
            <th>Donated On</th>
            <th>Donation Amount</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>1</td>
    		<td><?php echo $payment_data['CauseTitle'];?></td>
            <td><?php echo $this->common_model->displayDate($payment_data['CompletionDate']);?></td>
            <td><?php echo $payment_data['Currency'].' '.number_format($payment_data['DonationAmount'],2);?></td>
         </tr>
         
        
       	</tbody>
      </table>
      <hr>
     <p class="text-center">This is a computer generated receipt</p>
    	</div>
	</div>	
	<div class="row no-print">
    <div class="col-xs-12">
       	<div align="left">
			<img src="<?php echo $base_url; ?>assets/back_end/images/print.png" onClick="window.print()" style=" text-align:center; cursor:pointer;" ></br>
			<span><strong>Print Receipt</strong></span>
        </div>
    </div>
    </div>
</section>