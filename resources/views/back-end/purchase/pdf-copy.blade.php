<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Purchase</title>
  <style>
  
    .voucher-area{
      background: transparent;
     /* height: 300px;*/
    }
    .dealer-info{
      text-align: center;
      border-bottom:1px solid rgba(0,0,0,1);
      margin:0px 5px;
    }
    span#kss{
    font-size: 40px;
    color: rgba(255,86,169,1);
    font-weight: 600;
   }
   .customer-info{
      margin:20px 0px;
   }
   body {
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
   /* text-align: center;*/
    color: #555;
}

.invoice-box {
    max-width: 800px;
    margin: auto;
    padding: 30px;
   /* border: 1px solid #eee;*/
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
    font-size: 16px;
    line-height: 24px;
    font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
    color: #555;
}

.invoice-box table {
    width: 100%;
    line-height: inherit;
    text-align: left;
}

.invoice-box table td {
    padding: 5px;
    vertical-align: top;
}

.invoice-box table tr td:nth-child(2) {
    text-align: right;
}

.invoice-box table tr.top table td {
    padding-bottom: 20px;
}

.invoice-box table tr.top table td.title {
    font-size: 45px;
    line-height: 45px;
    color: #333;
}

.invoice-box table tr.information table td {
    padding-bottom: 40px;
}

.invoice-box table tr.heading td {
    background: rgba(255,86,169,1);
    border-bottom: 1px solid #ddd;
    font-weight: bold;
    text-align: center;
    color:#fff;
    font-size: 14px;
}

.invoice-box table tr.details td {
    padding-bottom: 20px;
}

.invoice-box table tr.item td {
    border: 1px solid #000;
    text-align: center;
    font-size: 14px;
}

.invoice-box table tr.item.last td {
    border-bottom: none;
}


.invoice-box table tr.total td:nth-child(5) {
    border-top: 2px solid #eee;
    font-weight: bold;
    float:right;
}
.item span{
  text-align: left;
}

.voucher-number p{
  text-align: right;
  font-weight: 600;
  margin-top:-70px;
  
}
#vn,#ta{
  color:rgba(255,86,169,1);
}
#cn{
 /* border:1px solid rgba(255,86,169,1);*/
    background:#fff;
    padding:5px 8px;
    color:rgba(255,86,169,1);
}

#cp{
  /*border:1px solid rgba(255,86,169,1);
*/    background:#fff;
    padding:5px 8px;
    margin-left:0px;
    color:rgba(255,86,169,1);
}
.total-amount p{
  text-align: right;
  margin-right: 0px;
  font-size: 14px;
}

  </style>
</head>
<body>

  <div class="voucher-area">
     

    <div class="invoice-box">

    <div class="dealer-info">
            <span id="kss">Ripon Traders</span><br/>
           <!--  <span id="name">Dealer Name: </span><br/>
            <span id="phone">Dealer Phone: </span> -->
      </div>

      <div class="customer-info">
          <span id="cn">Customer Name:</span>{{ $purchase->customer->name }}<span></span><br/>
          <span id="cp">Customer Phone:</span>{{ $purchase->customer->phone }}<span></span>
      </div>

      <div class="voucher-number">
          <p>
          	<span id="vn">Order No:</span> <span>{{ $purchase->purchase_no }}</span><br/>
          	<span id="vn">Date:</span>
            <span>{{ Carbon\Carbon::parse($purchase->date)->format('d-M-Y') }}</span>
            <br/>
          	
          </p>
      </div>

        <table cellpadding="0" cellspacing="0">

        
            <tr class="heading">
              <td width="30%">Product</td>
              <td width="20%">Image</td>
              <td width="20%">Unit Price</td>
              <td width="10%">Quantity</td>
              <td width="20%">Unit Total</td>
            </tr>
            
            @foreach($purchaseDetails as $info)
            <tr class="item">
                <td>{{ $info->product->name }}</td>
                <td>
                	<img src="data:image/png;base64,{{ base64_encode(file_get_contents(public_path('back-end/product/' . $info->product->image))) }}" style="width:30px;height:30px;">

                </td>
                <td>{{ $info->unit_price }}</td>
                <td>{{ $info->quantity }}</td>
                <td>{{ $info->unit_total }}</td>
            </tr>
            @endforeach
          
        </table>

        <div class="total-amount">

         <p> 
          <span id="ta">Total Amount: </span> 
           {{ $purchase->total_amount }} <br/>

           <span id="ta">Paid Amount: </span> 
           {{ $purchase->payment->paid_amount }}

           <br/>

           <span id="ta">Due Amount: </span> 
           {{ $purchase->payment->due_amount }}

         </p>

        </div>
      </div>
  </div>
  
</body>
</html>