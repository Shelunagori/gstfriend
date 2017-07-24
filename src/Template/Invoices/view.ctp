<style>
@media print{
	.maindiv{
		width:100% !important;
	}	
	.hidden-print{
		display:none;
	}
	body {
      -webkit-print-color-adjust: exact;
   }
}
@page {
    size: auto;   /* auto is the initial value */
    margin: 0 5px 0 20px;  /* this affects the margin in the printer settings */
}

p{
	margin-bottom: 0;
}

.tbl td, .tbl th {
    border: 1px solid black;
}
.nbtbl td, .nbtbl th {
    border: none;
}
.tbl th {
    text-align:center;
}
.tbl td {
    padding:3px;
}
</style>
<div style="width:80%;margin:auto;border:solid 1px;font-family: serif;background-color: #FFF;" class="maindiv">
	<table width="100%">
		<tr>
			<td width="30%" style="padding:5px;"><?php echo $this->Html->image('/img/viewlogo.png', ['height' => '100px']); ?></td>
			<td>
				<div align="center" style="color: #c4151c;"><b>
					<span style="font-size:16px;">NEW BHAGYALAXMI MOBILE POINT</span><br/>
					<span style="color: #4a4c4c;">287-A, MAIN ROAD SAVEENA,</span><br/>
					<span style="color: #4a4c4c;">Udaipur, Rajasthan. PIN: 313001</span><br/>
					<span style="color: #4a4c4c;">Tel: +91 9001222622</span><br/>
					<span style="color: #4a4c4c;">GSTIN: 08BICPD5795A1ZG</span></b>
				</div>
			</td>
			<td width="30%"></td>
		</tr>
	</table>
	
	<div align="center" style="padding: 5px 0px;border-top: solid 1px;border-bottom: solid 1px;background-color: #c4151c;font-size:18px;color: #FFF;"><b>TAX INVOICE</b></div>
	<div>
		<table width="100%">
			<tr>
				<td style="border-right:solid 1px;padding:5px;" width="50%" valign="top">
					<table>
						<tr>
							<td><b>Invoice No.</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td>0001</td>
						</tr>
						<tr>
							<td><b>Invoice Date</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td>16-7-2017</td>
						</tr>
						<tr>
							<td><b>State</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td>Rajasthan</td>
						</tr>
					</table>
				</td>
				<td style="padding:5px;" valign="top">
					<table width="100%">
						<tr>
							<td colspan="6">
								<div style="text-align: center;"><u>Bill to Party</u></div>
							</td>
						</tr>
						<tr>
							<td><b>Name</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td>Abhilash Lohar</td>
							<td><b>Mobile</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td>9636653883</td>
						</tr>
						<tr>
							<td><b>Address</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td colspan="4">Adarsh Bazar, Chawand, Teh. sarara, Udaipur</td>
						</tr>
						<tr>
							<td><b>State</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td>Rajasthan</td>
							<td><b>GSTIN</b></td>
							<td>&nbsp;:&nbsp;</td>
							<td>32253534FS35</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
	</div>
	<div align="center" style="border:none;">
		<table width="100%" class="tbl">
			<thead>
				<tr style="background-color: #e4e3e3;">
					<th rowspan="2" style="border-left: none;">Sr. No.</th>
					<th rowspan="2">Item Description</th>
					<th rowspan="2">HSN code</th>
					<th rowspan="2">Qty</th>
					<th rowspan="2">Rate</th>
					<th rowspan="2">Amount</th>
					<th colspan="2">Discount</th>
					<th rowspan="2">Taxable Value</th>
					<th colspan="2">CGST</th>
					<th colspan="2">SGST</th>
					<th rowspan="2" style="border-right: none;">Total</th>
				</tr>
				<tr style="background-color: #e4e3e3;">
					<th>Rate</th>
					<th>Amount</th>
					<th>Rate</th>
					<th>Amount</th>
					<th>Rate</th>
					<th>Amount</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="text-align:center;border-left: none;">1</td>
					<td>Item 1</td>
					<td></td>
					<td style="text-align:center;">1</td>
					<td style="text-align:right;">1000</td>
					<td style="text-align:right;">1000</td>
					<td style="text-align:right;">5</td>
					<td style="text-align:right;">50</td>
					<td style="text-align:right;">950</td>
					<td style="text-align:right;">9</td>
					<td style="text-align:right;">100</td>
					<td style="text-align:right;">9</td>
					<td style="text-align:right;">100</td>
					<td style="text-align:right;border-right: none;">1150</td>
				</tr>
				<tr>
					<td style="text-align:center;border-left: none;">2</td>
					<td>Item 2</td>
					<td></td>
					<td style="text-align:center;">1</td>
					<td style="text-align:right;">1000</td>
					<td style="text-align:right;">1000</td>
					<td style="text-align:right;">5</td>
					<td style="text-align:right;">50</td>
					<td style="text-align:right;">950</td>
					<td style="text-align:right;">9</td>
					<td style="text-align:right;">100</td>
					<td style="text-align:right;">9</td>
					<td style="text-align:right;">100</td>
					<td style="text-align:right;border-right: none;">1150</td>
				</tr>
				<tr>
					<td style="text-align:center;border-left: none;">3</td>
					<td></td>
					<td></td>
					<td style="text-align:center;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;border-right: none;"></td>
				</tr>
				<tr>
					<td style="text-align:center;border-left: none;">4</td>
					<td></td>
					<td></td>
					<td style="text-align:center;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;border-right: none;"></td>
				</tr>
				<tr>
					<td style="text-align:center;border-left: none;">5</td>
					<td></td>
					<td></td>
					<td style="text-align:center;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;border-right: none;"></td>
				</tr>
				<tr style="background-color: #e4e3e3;">
					<td style="text-align:center;border-left: none;font-size:16px;" colspan="5"><b>Total</b></td>
					<td style="text-align:right;">2000</td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;">100</td>
					<td style="text-align:right;">1900</td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;">200</td>
					<td style="text-align:right;"></td>
					<td style="text-align:right;">200</td>
					<td style="text-align:right;border-right: none;" width="80">2300</td>
				</tr>
			</tbody>
		</table>
		<table width="100%" class="tbl">
			<tbody>
				<tr>
					<td style="text-align:left;border-left: none;border-top: none;" rowspan="2" width="70%" valign="top">
						<p><b>Amount in words : </b>Two thousand and two hundred only</p>
					</td>
					<td style="text-align:right;border-top: none;"><b>Total Amount before Tax</b></td>
					<td style="text-align:right;border-right: none;border-top: none;" width="80">1900</td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total CGST</b></td>
					<td style="text-align:right;border-right: none;">200</td>
				</tr>
				<tr>
					<td style="border-left: none;border-top: none;" rowspan="2" width="70%" valign="top">
						<table width="100%" class="nbtbl">
							<tr>
								<td colspan="2"><b><u>Bank Details</u></b></td>
							</tr>
							<tr>
								<td><b>Bank A/C : </b>76458736578</td>
								<td><b>Bank IFSC : </b>UUHH76763H</td>
							</tr>
						</table>
					</td>
					<td style="text-align:right;"><b>Total SGST</b></td>
					<td style="text-align:right;border-right: none;">200</td>
				</tr>
				<tr>
					<td style="text-align:right;"><b>Total Amount after Tax</b></td>
					<td style="text-align:right;border-right: none;">2300</td>
				</tr>
			</tbody>
		</table>
		<table width="100%" class="tbl">
			<tbody>
				<tr>
					<td style="border-top: none;border-left: none;border-right: none;"  valign="top" colspan="2">
						<b><u>Terms & Conditions</u></b>
						<ol>
							<li>Interest @15% per annum shall be charged if not paid with in agreed terms. </li>
							<li>Interest d if not paid with in agreed terms. </li>
							<li>Interest @15% per annum shall be charged  per annum shall be charged  per annum shall be charged if not paid with in agreed terms. </li>
						</ol>
					</td>
				</tr>
				<tr>
					<td style="border-top: none;border-left: none;border-bottom: none;" width="50%" valign="top">
						<div align="center"><b>Customer Signture</b></div>
					</td>
					<td style="border-top: none;border-right: none;border-bottom: none;" valign="bottom">
						<div align="center"><b>For NEW BHAGYALAXMI MOBILE POINT</b></div><br/><br/><br/>
						<div align="center"><span style="border-top: solid 1px;"><b>Authorised signatory</b><span></div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
