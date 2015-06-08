<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Video store</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/1-col-portfolio.css" rel="stylesheet">

      <!-- Custom styles for this template -->
    <link href="style.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
  <body>
      <form id="addition" action= "http://web.engr.oregonstate.edu/~hesseljo/Assignment4-part2/src/store.php" method= "post" name= "insert">
        <h1>What Videos Do Yu Wish to Add? Enter all fields below</h1>
        Name:<input type= "text" name= "name" required>
        <br>
        Category:<input type= "text" name= "category" >
        <br>
        Length:<input type= "number" name= "length" min= "0" required>
        <br>
        <br>
        <input id= "add" type= "submit" value= "Add" name="insert"> </input>

        <br>
        <br>
        <br>
      </form>

      <?php
      include "store.php";
      ini_set('display_errors', 'On');
      if (isset($_POST['CATEGORIES'])){ //check filtering is needed or not
        $catename = $_POST['CATEGORIES'];
        
        if ($catename=='All Movies'){
          $fil = 'id>0';
        }
        else 
        {
          $fil = "category = '$catename'";
        }
      }
      else {
        $fil = 'id>0';
      }

      //build out the inventory
      if(!$res = $mydata->query("SELECT * FROM store_table WHERE $fil order by id")){ 
        echo "Couldn't select data properly because of filtering.";
      }
      
      echo "<table>";
      echo "<thead> <B>Video Inventory</B></caption>";
      echo "<br>";
      echo"<thead>";
      echo"<tr>";
        echo "<th> </th>";
        echo "<th> Video Title </th>";
        echo "<th> Type </th>";
        echo "<th> Length </th>";
        echo "<th> Status </th>";
        echo "<th> Remove </th>"; 
        echo "<th> Action </th>";
      echo"</tr>";
      echo "</thead>";
      echo "<tbody>";
      while($row = $res->fetch_object()) {
        echo "<tr>";
        
        echo "<td> $row->id </td>";
        echo "<td> $row->name </td>";
        echo "<td> $row->category </td>";
        echo "<td> $row->length </td>";
        if ($row->rented == 0){
          echo "<td> here </td>";
        }
        else
        {
          echo "<td> out </td>";
        }
        echo "<form action= http://web.engr.oregonstate.edu/~hesseljo/Assignment4-part2/src/store.php method= get name=delete>";
        echo "<td><button type=submit value=$row->id name=delete>Delete</button> </td>";
        echo "</form>";
        
        if ($row->rented == 0){
          echo "<form action= http://web.engr.oregonstate.edu/~hesseljo/Assignment4-part2/src/store.php method= get name=checking>";
          echo "<td><button type=submit value=$row->id name=check>check-out</button> </td>";
          echo "</form>";
        }
        else {
          echo "<form action= http://web.engr.oregonstate.edu/~hesseljo/Assignment4-part2/src/store.php method= get name=checking>";
          echo "<td><button type=submit value=$row->id name=check>check-in</button> </td>";
          echo "</form>";
        }
        echo "</tr>";
      }  
      echo "</tbody>";
      echo "<tfoot>";
      echo "<form action= http://web.engr.oregonstate.edu/~hesseljo/Assignment4-part2/src/store.php method= get name=deleteall>";
      echo "<td colspan=2><button id=da type=submit name=deleteall value=1>DELETE ALL</button> </td>";
      echo "</form>";
      echo "</tfoot>";
      echo "</table>";
     
      // filtering the input by category
      $cat = $mydata->query("SELECT distinct category FROM store_table");
      echo "<form  id = fil action= http://web.engr.oregonstate.edu/~hesseljo/Assignment4-part2/src/main.php method= post>";
      echo "<input id=filter type=submit name=filter value=FILTER></input>";
      echo "<select id=filtering name='CATEGORIES'>";
      echo "<option value='All Movies'>All Movies</option>";
      
      while ($cat2 = $cat->fetch_array()) {
        if ($cat2['category']!=""){
          echo "<option value=$cat2[category]>$cat2[category]</option>";
        }
      }
      echo "</select>";
      echo "</form>";
      ?>
    
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>