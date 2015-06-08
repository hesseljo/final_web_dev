<?php
include_once 'config.php';

//file path code and SQL commands from the PHP guide or lectures
     $filePath = explode('/', $_SERVER['PHP_SELF'], -1);
     $filePath = implode('/',$filePath);
	   $redirect = "http://" . $_SERVER['HTTP_HOST'] . $filePath;
     $mydata = new mysqli($hostname, $username, $password, $databaseName);
     if ($mydata->connect_errno){
       	echo "Couldn't connect to MySQL: (" . $mydata->connect_errno . ")" . $mydata->connect_error;
  	   	echo "click <a href='main.php'>here</a> to return to the store.";      
     }
	if ($_POST["insert"]){
        if (!($stmt = $mydata->prepare("INSERT INTO store_table (name, category, length) VALUES (?, ?, ?)"))){
          echo "Prepare failed: (" . $mydata->errno . ")" . $mydata->error;
          echo "click <a href='main.php'>here</a> to return to the store.";
        }
        $name = $_POST["name"];
        $category = $_POST["category"];
        $length = $_POST["length"];
      
        if (!is_numeric($length)){
        	echo "Entered length is not valid";
        	echo "click <a href='main.php'>here</a> to return to the store.";
        }
        if ($name==null || strlen($name)>255){
        	echo "Entered name is null or the length is larger than 255.";
        	echo "click <a href='main.php'>here</a> to return to the store.";
        }
        if ($name==null || strlen($category)>255){
        	echo "Entered category is null or the length is larger than 255.";
        	echo "click <a href='main.php'>here</a> to return to the store.";
        }
        if(!$stmt->bind_param('ssi', $name, $category, $length)){
          echo "Binding parameters failed: (" . $mydata->errno . ")" . $mydata->error;
          echo "click <a href='main.php'>here</a> to return to the store";
        }
        if (!$stmt->execute()){
          echo "execute failed :(" . $mydata->errno . ")" . $mydata->error;
          echo "click <a href='main.php'>here</a> to return to the store.";
        }
		$stmt->close();
        header("Location: {$redirect}/main.php", true);
      }
     
     if ($_GET["delete"]){
      	if (!($stmt = $mydata->prepare("DELETE FROM store_table WHERE id=?"))){
          echo "Prepare failed: (" . $mydata->errno . ")" . $mydata->error;
    	  echo "click <a href='main.php'>here</a> to return to the store.";      
         }
		$id = $_GET["delete"];
      
        if(!$stmt->bind_param('i', $id)){
          echo "Binding parameters failed: (" . $mydata->errno . ")" . $mydata->error;
          echo "click <a href='main.php'>here</a> to return to the store";
        }
        if (!$stmt->execute()){
          echo "execute failed :(" . $mydata->errno . ")" . $mydata->error;
          echo "click <a href='main.php'>here</a> to return to the store.";
        }
		$stmt->close();
		header("Location: {$redirect}/main.php", true);
      	
      }
     if ($_GET["deleteall"]){
     	
      	if (!($stmt = $mydata->prepare("TRUNCATE store_table"))){
          echo "Prepare failed: (" . $mydata->errno . ")" . $mydata->error;
    	   echo "click <a href='main.php'>here</a> to return to the store";      
         }
      
        if (!$stmt->execute()){
          echo "execute failed :(" . $mydata->errno . ")" . $mydata->error;
          echo "click <a href='main.php'>here</a> to return to the store";
        }
		$stmt->close();
		header("Location: {$redirect}/main.php", true);
      
      }
	
     if ($_GET["check"]){
      	$id = $_GET["check"];
      	$sql = "SELECT rented FROM store_table WHERE id = $id LIMIT 1";
      	$target = $mydata->query($sql);
      	$tar = $target->fetch_array();
        $x=$tar['rented'];
      	
      	if ($x==0){
     		if (!$stmt = $mydata->prepare("UPDATE store_table SET rented = true WHERE id=? ")){
     			echo "prepare failed";
     			echo "click <a href='main.php'>here</a> to return to the store";
      		}
      		if(!$stmt->bind_param('i', $id)){
          		echo "Binding parameters failed: (" . $mydata->errno . ")" . $mydata->error;
          		echo "click <a href='main.php'>here</a> to return to the store";
       		 }
        	if (!$stmt->execute()){
          		echo "execute failed :(" . $mydata->errno . ")" . $mydata->error;
          		echo "click <a href='main.php'>here</a> to return to the store";
       		 }
			$stmt->close();
			header("Location: {$redirect}/main.php", true);
		} else 
    {
			if (!$stmt = $mydata->prepare("UPDATE store_table SET rented = false WHERE id=? ")){
				echo "prepare failed";
     			echo "click <a href='main.php'>here</a> to return to the store";
      		}
			if(!$stmt->bind_param('i', $id)){
          		echo "Binding parameters failed: (" . $mydata->errno . ")" . $mydata->error;
          		echo "click <a href='main.php'>here</a> to return to the store";
        	}
        	if (!$stmt->execute()){
          		echo "execute failed :(" . $mydata->errno . ")" . $mydata->error;
          		echo "click <a href='main.php'>here</a> to return to the store";
       		 }
			$stmt->close();
			
			header("Location: {$redirect}/main.php", true);
		}
	}
?>