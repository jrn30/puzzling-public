<html>
<head>
<title>Transcript</title>
<link href="../css/style.css" rel="stylesheet" type="text/css">
</head>
<body>

<?php

$transcriptkey = $_GET[ref];

//get the transcript data from the db
include('../includes/dblogin.php');
$row = DBonerow("SELECT * from transcripts WHERE ref = '$transcriptkey'");
if($row){ ?>
	<h4>Transcript: <?php echo($row->title); ?></h4>
	<?php if(!empty($row->pic)){?>
	<div style="float:right"><img src="<?php echo($row->pic); ?>"></div>
	<?php } 
	echo($row->body);
}
else{ ?>
	<h4>Transcript</h4>
	<i>Sorry, transcript not found.</i><br>
	Go back to the <a href="/">Homepage</a>
<?php
}
?>

</body>
</html>