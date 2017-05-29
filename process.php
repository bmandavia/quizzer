<?php include 'database.php'; ?>
<?php session_start(); ?>
<?php
	//check to see if score is set_error_handler
	if(!isset($_SESSION['score'])){
		$_SESSION['score'] = 0;
	}
	if($_POST){
		$number = $_POST['number'];
		$selected_choice = $_POST['choice'];
		
		//echo $number.'<br>';
		//echo $selected_choice;
		
		$next = $number+1;
		
		$query = "SELECT * FROM questions";
		
		$results = $mysqli->query($query) or die($mysqli->error.__LINE__);
		$total = $results->num_rows;
		
		/*
		*  Get correct choice
		*/
		
		$query = "SELECT * FROM `choices` WHERE question_number = $number and is_correct = 1";
		
		//Get result
		$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
		
		//Get row
		
		$row = $result->fetch_assoc();
		
		//correct choice
		$correct_choice = $row['id'];
		
		//compare
		
		if($correct_choice == $selected_choice)
		{
			$_SESSION['score']++;
			
		}
		
		//check if last question
		if($number == $total)
		{
			header("Location:final.php");
			exit();
			
		}else{
			header("location:questions.php?n=" .$next);
		}
		
	}
	
?>