<?php 
	session_start();
	if($_SESSION['username']){?>
<?php
	$caseInfoResult = "";
	$dateResult = "";
	$petiResResult = "";
	$proceedingResult = "";
	$fileNumber = "";

	if(isset($_GET['fileNumber'])){
		require('connection.php');

		$fileNumber = $_GET['fileNumber'];

		#1 case info
		$caseInfoQuery = "SELECT * FROM `case_info` where file_number = '$fileNumber'";
			$caseInfoResult = mysqli_query($connection, $caseInfoQuery) or die(mysqli_error($connection));
			$caseInfoResult = mysqli_fetch_assoc($caseInfoResult);
			// $caseInfoCount = mysqli_num_rows($caseInfoResult);
		
		#2 date info
		$dateQuery = "SELECT * FROM `date_info` WHERE file_number = '$fileNumber'";
			$dateResult = mysqli_query($connection, $dateQuery) or die(mysqli_error($connection));
			$dateResult = mysqli_fetch_assoc($dateResult);
			// $dateCount = mysqli_num_rows($dateResult);

		#3 petitioner/ respondent info
		$petiResQuery = "SELECT petitioner_name, petitioner_email, petitioner_address, respondent_name, respondent_email, respondent_address FROM `petitioner_respondent_info` where file_number = '$fileNumber'";
			$petiResResult = mysqli_query($connection, $petiResQuery) or die(mysqli_error($connection));

			$petiResResult = mysqli_fetch_assoc($petiResResult);
			// $petiResCount = mysqli_num_rows($petiResResult);

		#4 proceeding info
		$proceedingQuery = "SELECT proceeding_number, proceeding_date, decision, next_hearing_on, description FROM `latest_proceeding` where file_number = '$fileNumber'";
			$proceedingResult = mysqli_query($connection, $proceedingQuery) or die(mysqli_error($connection));

			$proceedingResult = mysqli_fetch_assoc($proceedingResult);
			// $proceedingCount = mysqli_num_rows($proceedingResult);        
     }
?>
<html>
<head>
	<link rel="shortcut icon" type="image/x-icon" href="favicon.png" />
	<title><?php echo "File Number ".$fileNumber; ?></title>
<style>
	td{
	word-wrap: break-word;
	max-width: 150px;
	width: 150px;
}
</style>
</head>
<body>
File Number: <!-- 1 --><?php echo $fileNumber; ?><br />
Case Number: <!-- 2 --><?php echo $caseInfoResult['case_number']; ?><br />
Year: <!-- 2017 --><?php echo $caseInfoResult['year']; ?><br />
Nature of Case: <!-- CRIMINAL --><?php echo $caseInfoResult['case_type']; ?><br />
Court Name: <!-- SUPREME COURT --><?php echo $caseInfoResult['court_name']; ?><br />
Lawyer: <!--   RASTOGI --><?php echo $caseInfoResult['lawyer']; ?><br />
Location: <!-- NEW DELHI --><?php echo $caseInfoResult['location']; ?><br />
<hr />
<h3>DATE INFO:</h3>
Case Filed On: <!-- 2017-09-05 --><?php echo $dateResult['case_filed_on']; ?><br />
Notice Received On: <!-- 2017-09-05 --><?php echo $dateResult['notice_received_on'];?><br />
First Hearing On: <!-- 2017-09-06 --><?php echo $dateResult['first_hearing_on'];?><br />
<hr />
<h3>PETITIONER-RESPONDENT INFO:</h3>
<table>
	<tr><th align="left" valign="top">Petitioner Name: </th><td><!-- AL --><?php echo $petiResResult['petitioner_name']; ?></td>
<tr><th align="left" valign="top">Petitioner e-Mail: </th><td><!-- nflds --><?php echo $petiResResult['petitioner_email']; ?></td>
</tr><tr>
	<th align="left" valign="top">Petitioner Address: </th><td><!-- NLF --><?php echo $petiResResult['petitioner_address']; ?></td>
</tr>
<tr>
	<!-- <td>&nbsp;</td><td>&nbsp;</td> -->
</tr>
<tr>
	<th align="left" valign="top">Respondent Name: </th><td><!-- NSDLJ --><?php echo $petiResResult['respondent_name']; ?></td></tr>
<tr><th align="left" valign="top">Respondent e-Mail: </th><td><!-- njsld --><?php echo $petiResResult['respondent_email']; ?></td>
<tr>
	<th align="left" valign="top">Respondent Address: </th><td><!-- LN --><?php echo $petiResResult['respondent_address']; ?></td>
</tr>
</table>
<hr />
<h3>PROCEEDING INFO:</h3>
<table border="1">
<tr>	<th>Proc. No.</th>
	<th>Proc. Date</th>
	<th>Decision</th>
	<th>Next Hearing</th>
<th>Description</th>
</tr>
<tr>	
	<td align="center"><!-- 1 --><?php echo $proceedingResult['proceeding_number']; ?></td>
	<td align="center"><!-- 2017-09-20 --><?php echo $proceedingResult['proceeding_date']; ?></td>
	<td align="center"><!-- FINAL JUDGEMENT --><?php echo $proceedingResult['decision']; ?></td>
	<td align="center"><?php if($proceedingResult['decision'] == "FINAL JUDGEMENT"){echo "N/A";}else{echo $proceedingResult['next_hearing_on'];}?></td>
	<td align="center"><!-- FINAL JUDGEMENT --><?php echo $proceedingResult['description']; ?></td>
	<!-- <td align="center"></td> -->
</tr>
		</table>
	</body>
</html>

<?php
}
else{
  header("location:index.php");
}
?>
