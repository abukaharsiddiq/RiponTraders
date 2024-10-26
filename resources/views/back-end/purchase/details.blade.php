<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Design</title>
    <link rel="stylesheet" href="styles.css">
</head>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap');
  @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+Bengali:wght@100..900&display=swap');
  body {
    font-family: "Hind Siliguri", sans-serif;
    font-family: "Noto Sans Bengali", sans-serif;
}
.pdf-area {
  width: 700px;
  background: #f5f5f5;
  margin: auto;
  margin-top: 50px;
  padding: 20px;
  height: 500px;
  border: 1px solid rgba(0,0,0,.2);
}

.header-area {
  position: relative;
  background: transparent;
  height: 150px;
}

.header-left{
  position: absolute;
  width:82%;
  left:0;
}
.header-right{
  position: absolute;
  width:18%;
  right:0;
}

.header-top{
  text-align: center;
}

.header-top-left {
  width: 10%;
}

.header-top-right{
  width:90%;
  text-align: center;
}
.header-top img{
  height: 30px;
}

#ripon-traders {
  font-size: 40px;
  font-weight: 600;
  position: absolute;
  top: 0;
  color: #0D659D;
  letter-spacing: 10px;
  left: 150px;
}

#address {
  position: relative;
  top: -10px;
  left: 55px;
  font-size: 16px;
}

.header-bottom-left {
  width: 50%;
  position: absolute;
  top: 70px;
}

.header-bottom-right {
  width: 50%;
  position: absolute;
  right: 20px;
  top: 90px;
}

.header-bottom-left p {
  margin-right: 45px;
  font-size: 14px;
}

#propaitor {
  border: 1px dotted #0D659D;
  border-radius: 20px;
  padding: 2px 10px 0px 10px;
  /* padding-bottom: 10px; */
  margin-top: -10px;
  color: #0D659D;
}

#pmobile {
  /* margin-top: ; */
  position: absolute;
  top: 17px;
}

.info{
  position: relative;
  background: transparent;
  height: 50px;
}

.info-left{
  position: absolute;
  left:0;
}

.info-right{
  position: absolute;
  right:0;
}

.table-container {
    width: 100%;
}

table {
    width: 100%;
    border-collapse: collapse;
}

table, th, td {
    border: 1px solid #00000029;
}

th, td {
    padding: 10px;
    text-align: center;
    font-size: 16px;
}

th {
    background-color: #c85c5c2e;
}

</style>

<body>
    <div class="pdf-area">
         <div class="header-area">
              <div class="header-left">

                  <div class="header-top">
                       <div class="header-top-left">
                         <img src="{{ asset('/') }}back-end/setting/1723371603.ripon-logo.png" alt="">
                       </div>
                       <div class="header-top-right">
                         <span id="ripon-traders">রিপন ট্রেডার্স </span> <br/>
                          <span id="address">সুন্দরবন কমিউনিটি সেন্টারের পিছনে, গোটাটিকর, কদমতলী, সিলেট ।</span>
                       </div>
                  </div>

                  <div class="header-bottom">
                      <div class="header-bottom-left">
                          <p>
                            উন্নত মানের প্লাষ্টিক রশি, প্লাষ্টিক বেত ও প্লাষ্টিক দানা সুলভ মূল্যে পাওয়া যায় । মোলাম ক্রয় বিক্রয় করা হয় 
                          </p>
                      </div>
                      <div class="header-bottom-right">
                           <span id="propaitor">প্রোপাইটর: আবুল হাসেম </span></br></br>
                           <span id="pmobile" style="margin-top:10px;">মোবাইল: ০১৭১৩৮১৬৮৮৪</span>
                      </div>
                  </div>

              </div>

              <div class="header-right">
                  <div class="company-phone">
                    <span>মার্কেট ম্যানেজার </span><br/><span>০১৭১৮৩৮৮৩৩০</span> <br/>
                    <span>অফিস (রিপন) </span><br/><span>০১৭৪৮৩৪৯৬৫৭</span> <br/>
                    <span>অফিস</span><br/><span>০১৭৪৮৩৪৯৬৫৭</span> <br/>
                  </div>
              </div>

         </div>

            <div class="info">
                <div class="info-left">
                    <p>ভাউচার নং: {{ $payment->purchase_no }}</p>
                </div>
                <div class="info-right">
                    <p>তারিখ: {{ $payment->date }} </p>
                </div>
            </div>

            <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>সংখ্যা</th>
                        <th>বিবরণ</th>
                        <th>পরিমাণ</th>
                        <th>দর</th>
                        <th>টাকা</th>
                    </tr>
                </thead>
                <tbody>
                  @php
                  $i=1
                  @endphp
                  @foreach($lists as $info)
                    <tr>
                      <td>{{ $i++ }}</td>
                      <td>{{ $info->product->name }}</td>
                      <td>{{ $info->quantity }}</td>
                      <td>{{ $info->unit_price }}</td>
                      <td>{{ $info->unit_total }}</td>
                    </tr>
                   @endforeach

                </tbody>
            </table>
        </div>

    </div>
</body>
</html>
