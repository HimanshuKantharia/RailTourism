<?php


?>

<!DOCTYPE html>
<html style="height:100%">
<head>
	<title>RailWays</title>
		<meta charset="utf-8">
 	<meta name="viewport" content="width=device-width, initial-scale=1">
  
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
<script type="text/javascript">
	function printme(){
		window.print();
	}

</script>


</head>
<body>

<nav class="navbar navbar-default " role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle = "collapse" data-target="#nvbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span> 
      </button>
      <a class="navbar-brand" href="../rail/">RAILWAY</a>
    </div>
    <div class="collapse navbar-collapse" id="nvbar">
      <ul class="nav navbar-nav">
        <li><a href="../rail/">Home</a></li>
        <li><a href="#">News</a></li>
        <li><a href="#">Contact</a></li>
        <li><a href="#">About Us</a></li>
      </ul>
        <ul class="nav navbar-nav navbar-right" style="margin-right:2px;">
        <li><a href="user/"><span class="glyphicon glyphicon-arrow-left"></span> Back</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
       
      </ul>   
    </div>
  </div>
</nav>




<?php

require 'phpfiles/classes.php';
session_start();
if(empty($_SESSION['userId'])){
	$message = " please login first and then try !";
	echo "<script type='text/javascript'>  var r =confirm('$message');
			if (r == true){  
				window.location='login.php';
				}else
		window.location='index.php';
	 </script>";
	
}
else{
$userId = $_SESSION['userId'];
}

?>


<div class="container">
<?php
if(isset($_GET['bookid']))
{
	$bookid = $_GET['bookid'];
}

if($bookid)
{
	$conn = new connect();
	$que = 'select * from book where bookid='.$bookid;
	$res = $conn->exeQuery($que);
	$row = $res->fetch_assoc();

	$que1 = 'select * from bookDetail where bookid='.$bookid;
	$result = $conn->exeQuery($que1);
	$bdetail  = $result->fetch_assoc();

	$query = 'select * from fareDetail where bookid='.$bookid;
	$result1 = $conn->exeQuery($query);
	$fdetail  = $result1->fetch_assoc();
 /*   
	echo "<br>".$row['userId'];
	echo "<br>".$row['t_name'];
	echo "<br>".$bdetail['p_name'];
	echo "<br>".$bdetail['p_age'];
	echo "<br>".$fdetail['Tkt_fare'];		
	echo "<br>".$fdetail['totalFare'];

*/

?>
    <table class="table table-bordered" style="max-width: 1000px; margin: auto">
        <tbody>
            <tr>
                <td>
                    <table class="table">
                        <tr>
                            <td>
                                <img src="images/indianrailways-logo.jpg" style="height: 40px" /></td>
                            <td style="text-align: center">
                                <h1 style="font-size: 1.5em">IRCTCs e-Ticketing Service Electronic Reservation Slip (Personal User)<br/><a style="color:red" href="http://erail.in">Click here to Search Seats</a></h1>
                                
                            </td>
                            <td>
                                <img src="images/irctclogo.jpg" style="height: 40px" /></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <ol>
                        <li>This Ticket will be valid with an ID proof in original. Please carry original Identity Proof. If found traveling without original ID proof, Passenger will be treated as without ticket and charged as per extent Railway Rules.
                        </li>
                        <li>Valid IDs to be presented during train journey by one of the passenger booked  on an e-ticket :- Voter Identity Card / Passport / PAN Card / Driving License / Photo ID card issued by Central / State Govt / Public Sector Undertakings of State / Central Government ,District Administrations , Muncipal bodies and Panchayat Administrations which are having serial number / Student Identity Card with photograph issued by recognized School or College for their students / Nationalized Bank Passbook with photograph /Credit Cards issued by Banks with laminated photograph/Unique Identification Card "Aadhaar".
                        </li>
                        <li>General rules/ Information for e-ticket passenger have to be studied by the customer for cancellation &amp; refund.
                        </li>
                    </ol>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><strong>PNR No:</strong>7899345674</td>
                                <td>Train No. &amp; Name:<?php echo $row['t_no']."/".$row['t_name']; ?></td>
                                <td>Quota:GENERAL (GN)</td>
                            </tr>
                            <tr>
                                <td><strong>Transaction ID:</strong>9842678837</td>
                                <td>Date Of Booking: <?php echo $row['bookDate']; ?></td>
                                <td>Class:<?php echo $row['t_class'];  ?> (CC)</td>
                            </tr>
                            <tr>
                                <td>From:<?php echo $row['t_from']; ?></td>
                                <td>Date Of Journey:<?php echo $row['t_jdate']; ?></td>
                                <td>To:<?php echo $row['t_to']; ?></td>
                            </tr>
                            <tr>
                                <td>Boarding At:<?php echo $row['t_from']; ?></td>
                                <td>Date Of Boarding:<?php echo $row['t_jdate']; ?></td>
                                <td>Scheduled Departure:XX-XXX-XXXX 06:50 *</td>
                            </tr>
                            <tr>
                                <td>Resv. Upto:<?php echo $row['t_to']; ?></td>
                                <td>Scheduled Arrival:XX-XXX-2016 12:40 *</td>
                                <td>Adult:1<strong>Child:</strong>0</td>
                            </tr>
                            <tr>
                                <td>Passenger Mobile No:XXXXXXXXXX</td>
                                <td></td>
                                <td>Distance:XXX KM</td>
                            </tr>
                            <tr>
                                <td colspan="1"><strong>Passenger Address:</strong></td>
                                <td colspan="3">Some Address</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td><strong><span>FARE DETAILS :</span></strong></td>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered">
                        <tbody>
                            <tr>
                                <td><span>Ticket Fare **</span></td>
                                <td>
                                    <img src="images/Rupee.gif" /><span><?php echo $fdetail['Tkt_fare']; ?></span></td>
                                <td><span>Rupees Three Thousand Seven Hundred and Sixty Only</span></td>
                            </tr>
                            <tr>
                                <td><span>Catering Charges</span></td>
                                <td>
                                    <img src="images/Rupee.gif" /><span><?php echo $fdetail['Cat_charge']; ?></span></td>
                                <td><span>Rupees Three Hundred and Sixty Only</span></td>
                            </tr>
                            <tr>
                                <td><span>piyRAIL Service Charge (Incl. of Service Tax) #</span></td>
                                <td>
                                    <img src="images/Rupee.gif" /><span><?php echo $fdetail['Ser_charge']; ?></span></td>
                                <td><span>Rupees Forty Six Only</span></td>
                            </tr>
                            <tr>
                                <td><span>Total Fare (all inclusive)</span></td>
                                <td>
                                    <img src="images/Rupee.gif" /><span><?php echo $fdetail['totalFare']; ?></span></td>
                                <td><span></span></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>

            <tr>
                <td>** Inclusive of Service Tax -<img src="images/Rupee.gif">60Only
										
                </td>
            </tr>

            <tr>
                <td># Service Charges per e-ticket irrespective of number of passengers on the ticket.	
                </td>
            </tr>

            <tr>
                <td><strong><span>PASSENGER DETAILS :</span></strong></td>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">SNo.</th>
                                <th scope="col">Name</th>
                                <th scope="col"><span style="text-align: center;">Age</span></th>
                                <th scope="col">Sex</th>
                                <th scope="col">ID Card</th>
                                <th scope="col">Booking Status</th>
                                <th scope="col">Current Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td><?php echo $bdetail['p_name']; ?></td>
                                <td><span style="text-align: center;"><?php echo $bdetail['p_age']; ?></span></td>
                                <td><?php echo $bdetail['p_gender']; ?></td>
                                <td><?php echo $bdetail['p_idcard']; ?></td>
                                <td>CNF/C5/20/WINDOW SIDE</td>
                                <td>CNF/C5/20/WINDOW SIDE</td>
                            </tr>
                            <!--
                            <tr>
                                <td>2</td>
                                <td>XXXXXXXXX</td>
                                <td><span style="text-align: center;">32</span></td>
                                <td>Female</td>
                                <td>VEG</td>
                                <td>CNF/C5/21/NO CHOICE</td>
                                <td>CNF/C5/21/NO CHOICE</td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>XXXXXXXXX</td>
                                <td><span style="text-align: center;">64</span></td>
                                <td>Male</td>
                                <td>VEG</td>
                                <td>CNF/C5/22/NO CHOICE</td>
                                <td>CNF/C5/22/NO CHOICE</td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>XXXXXXXXX</td>
                                <td><span style="text-align: center;">55</span></td>
                                <td>Female</td>
                                <td>VEG</td>
                                <td>CNF/C5/23/NO CHOICE</td>
                                <td>CNF/C5/23/NO CHOICE</td>
                            </tr>

                            -->
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td><u><strong>This ticket is booked on a personal user ID and cannot be sold by an agent. If bought from an agent by any individual, it is at his/her own risk.</strong></u></td>
            </tr>
            <tr>
                <td><strong>Ticket Printing Time: </strong>XX-XXX-XXXX 10:01:33 HRS</td>
            </tr>
            <tr>
                <td colspan="4"><span style="color: red; font: 11px arial;">IR recovers only 57% of cost of travel on an average</span>
                </td>
            </tr>
            <tr>
                <td><strong>IMPORTANT :</strong>
                    <ol>
                        <li>For details, rules and terms &amp; conditions of E-Ticketing services, please visit www.irctc.co.in.</li>
                        <li>*New Time Table will be effective from 1-Oct-2016. Departure time and Arrival Time printed on this ERS/VRM is liable to change. Please Check correct departure, arrival from Railway Station Enquiry, Dial 139 or  SMS RAIL to 139.</li>
                        <li>There are amendments in certain provision of Refund Rules. Refer Amended Refund Rules w.e.f 12-Nov-2015.(details available on www.irctc.co.in under heading Refund Rule--&gt; Cancellation of Ticket and Refund Rules 2015.)</li>
                        <li>The accommodation booked is not transferable and is valid only if the ORIGINAL ID card prescribed is presented during the journey. The ERS/VRM/MRM along with valid id card of any one the passenger booked on e-ticket proof in original would be verified by TTE with the name and PNR on the chart. If the Passenger fail to produced/display ERS/VRM due to any eventuality(loss, damaged mobile/laptop etc.) but has the prescribed original proof of identity, a penalty of Rs.50/- per ticket as applicable to such cases will be levied. The ticket checking staff on board/off board will give excess fare ticket for the same.</li>
                        <li>E-ticket cancellations are permitted through www.irctc.co.in by the user.</li>
                        <li>PNRs having fully waitlisted status will be dropped and the names of the passengers will not appear on the chart. They  are not allowed to board the train. However the namesof PARTIALLY waitlisted/confirmed and RAC will appear in the chart.</li>
                        <li>Obtain certificate from the TTE /Conductor in case of (a) PARTIALLY waitlisted e-ticket when LESS NO. OF PASSENGERS travel, (b)A.C.FAILURE, (c)TRAVEL IN LOWER CLASS. This original certificate must be sent to GGM (IT), IRCTC, Internet Ticketing Centre, IRCA Building, State Entry Road, New Delhi-110055 after filing TDR online within prescribed time  for claiming refund.</li>
                        <li>In case of Partial confirmed/RAC/Wait listed ticket, TDR should be filed online within prescribed time in case NO PASSENGER is travelling  for processing of refund as per Railway refund rules</li>
                        <li>While TDR refund requests are filed &amp; registered on IRCTC website www.irctc.co.in, they are processed by Zonal Railways as per Railway Refund Rules.(detail available on www.irctc.co.in under heading General Information.</li>
                        <li>In premium special train cancellation is not allowed.</li>
                        <li>No refund shall be granted on the confirmed ticket after four hours before the scheduled departure of the train.</li>
                        <li>No refund shall be granted on the RAC or Waitlisted ticket after thirty minutes before the scheduled departure of the train.</li>
                        <li>In case, on a party e-ticket or a family e-ticket issued for travel of more than one passenger, some passengers have confirmed reservation and others are on RAC or waiting list, full refund of fare , less clerkage, shall be admissible for confirmed passengers also subject to the condition that the ticket shall be cancelled online or online TDR shall be filed for all the passengers upto thirty minutes before the scheduled departure of the train.</li>
                        <li>For Suvidha Train , only 50% refund is allowed in case of cancellation of Confirm/RAC tickets upto 6 hours before the scheduled departure of the train or preparation of chart whichever is earlier. </li>
                        <li>In case of Train Cancellation, full refund will be granted automatically by the System.</li>
                        <li>Passengers are advised not to carry inflammable/dangerous/explosive/articles as part of their luggage and also to desist from smoking in the trains.</li>
                        <li>Contact us on: - 24*7 Hrs Customer Support at 011-23340000/011-39340000 , Chennai Customer Care 044 – 25300000 or Mail To: care@irctc.co.in.</li>
                        <li>Variety of meals available in more than 1500 trains. For delivery of meal of your choice on your seat log on to www.ecatering.irctc.co.in or call 1323  Toll Free. For any suggestions/complaints related to Catering services, contact Toll Free No. 1800-111-321 (07.00 hrs to 22.00 hrs)</li>
                        <li>Railway Security Helpline No.182</li>
                        <li>ALL India Passenger Helpline no 138</li>
                        <li>PNR and train arrival/departure enquiry no. 139</li>
                        <li>To report unsavoury situation during journey, Please dial railway security helpline no. 182</li>
                    </ol>

                </td>
            </tr>
        </tbody>
    </table>

<button class="btn btn-info" onclick="printme()">PRINT</button>

<?php
}
?>	
</div>




<!--	<script type="text/javascript" scr="../js/bootstrap.min.js"></script>  -->
	<script src="js/jquery-3.1.0.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 


</body>
</html>