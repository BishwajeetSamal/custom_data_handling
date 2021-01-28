<?php
include('connection.php'); 
$limit = 4;
$sql = "SELECT COUNT(id) FROM students";  
$rs_result = mysqli_query($conn, $sql);  
$row = mysqli_fetch_row($rs_result);  
$total_records = $row[0];
 
$total_pages = ceil($total_records / $limit); 
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Bishwajeet</title>
  <style>
    h1 {
      font-size: 72px;
      background: -webkit-linear-gradient(#eee, #333);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .clearfix{
      float: right;
      margin-right: 5%;
    }
  </style>
</head>

<body>
  <p id="deleteOne"></p>
  <div class="container-fluid">
    <h1><strong class="title">Student Information</strong></h1>
    <div>
      <button class="btn btn-info" id="insertOneDate" onclick="insertNewData()">Insert New Row</button>
      <div class="container input-group mb-3" style="float:right;width:30%">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Search</span>
        </div>
        <input type="text" class="form-control" aria-describedby="basic-addon1">
      </div>
      <div id="target-content">...loading</div>
    
      <div class="clearfix">
               
               <ul class="pagination">
                         <?php 
               if(!empty($total_pages)){
                 for($i=1; $i<=$total_pages; $i++){
                     if($i == 1){
                       ?>
                     <li class="pageitem " id="<?php echo $i;?>"><a href="JavaScript:Void(0);" data-id="<?php echo $i;?>" class="page-link" ><?php echo $i;?></a></li>
                                   
                     <?php 
                     }
                     else{
                       ?>
                     <li class="pageitem" id="<?php echo $i;?>"><a href="JavaScript:Void(0);" class="page-link" data-id="<?php echo $i;?>"><?php echo $i;?></a></li>
                     <?php
                     }
                 }
               }
                     ?>
               </ul>
                    </ul>
                 </div>

    </div>

  </div>
</body>
<script type="text/javascript" src="jquery.js"></script>
<script>
	$(document).ready(function() {
		$("#target-content").load("pagination.php");
		$(".page-link").click(function(){
			var id = $(this).attr("data-id");
			var select_id = $(this).parent().attr("id");
			$.ajax({
				url: "pagination.php",
				type: "GET",
				data: {
					page : id
				},
				cache: false,
				success: function(dataResult){
					$("#target-content").html(dataResult);
					$(".pageitem").removeClass("active");
					$("#"+select_id).addClass("active");
					
				}
			});
		});
    });
</script>
<script>
  function updateFun(id) {
    console.log(id);
    var element = document.getElementById(id);
    console.log(element);

    var subElement = element.getElementsByClassName('inline_edit_data');

    for (var index = 0; index < subElement.length; index++) {

      if (subElement[index].id === "update") {

        subElement[index].innerHTML = '<button class="btn btn btn-outline-success" onclick="Save(' + id + ')">Save</button>';
      } else {
        subElement[index].innerHTML = '<input id="item' + index + '" type="text" value="' + subElement[index].innerHTML + '"/>';
      }
    }

  }



  function Save(id) {

    var element = document.getElementById(id);
    var subElement = element.getElementsByClassName('inline_edit_data');

    for (var i = 0; i < subElement.length; i++) {


      if (subElement[i].id === "update") {

        subElement[i].innerHTML = '<button onclick="updateFun(' + id + ')"class="btn btn btn-info">Edit</button>';
      } else {

        subElement[i].innerHTML = '<td class="inline_edit_data">' + document.getElementById("item" + i).value + '</td>';
      }
    }


    let name = subElement[0].innerHTML;
    let classses = subElement[1].innerHTML;
    let roll_no = subElement[2].innerHTML;
    let email = subElement[3].innerHTML;
    let mobile = subElement[4].innerHTML;
    let percent = subElement[5].innerHTML;

    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("tab").innerHTML = this.responseText;
      }
    };
    xhttp.open("GET", "updateAjax.php?id=" + id + "&" + "name=" + name + "&" + "classes=" + classses + "&" + "roll_no=" + roll_no + "&" + "email=" + email + "&" + "mobile=" + mobile + "&" + "percent=" + percent, true);
    xhttp.send();
  }

  function deleteFun(id) {


    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        // document.getElementById("deleteOne").innerHTML = this.responseText;

        //This two lines is very important for the specifically to delete the row from the table
        var row = document.getElementById(id);
        row.parentNode.removeChild(row);
      }
    };
    xhttp.open("GET", "deleteAjax.php?id=" + id, true);
    xhttp.send();
  }


  //Insert New Row to the Table
  function insertNewData(value) {
    var node = document.createElement("TR");
  node.setAttribute("id", "rowInsert");
  
  document.getElementById("table_data_for_students").appendChild(node);   //appendChild is here helps to put a <tr></tr> inside table

    document.getElementById("rowInsert").innerHTML = "<td class='insertInput' id='stop_data'><input type='text' id='itemsss0' placeholder='Enter Name'></td> <td class='insertInput'><input type='text' id='itemsss1' placeholder='Enter Class'></td> <td class='insertInput'><input type='text' id='itemsss2' placeholder='Enter Roll Number'></td> <td class='insertInput'><input type='text' id='itemsss3' placeholder='Enter Email'></td> <td class='insertInput'><input type='text' id='itemsss4' placeholder='Enter Mobile Number'></td> <td class='insertInput'><input type='text' id='itemsss5' placeholder='Enter Percent'></td>  <td><button class='btn btn-success' onclick='InsertRow()'>Save</button></td>  <td><button class='btn btn-danger'>Cancel</button></td>";
   

  }


  function InsertRow() {
    let element = document.getElementById("rowInsert");
    let subElement = element.getElementsByClassName("insertInput");
    for (var index = 0; index < subElement.length; index++) {
      subElement[index].innerHTML = document.getElementById("itemsss" + index).value;
      // console.log(  subElement[index].innerHTML);
    }

    let name = subElement[0].innerHTML;
    let classses = subElement[1].innerHTML;
    let roll_no = subElement[2].innerHTML;
    let email = subElement[3].innerHTML;
    let mobile = subElement[4].innerHTML;
    let percent = subElement[5].innerHTML;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {

        var id = this.responseText;
        var row = document.getElementById("rowInsert");
        row.parentNode.removeChild(row);

        //var ss=document.getElementById("showData").innerHTML+=
        var table = document.getElementById('table_row');
        // console.log(table);
        // Insert a cell at the end of the row
        var tbodyRef = table.insertRow(-1);
        tbodyRef.setAttribute("id", +id); //This helps to set the id to the bydefault produced <tr> by insertrow() function

        tbodyRef.innerHTML = '<tr id=' + id + '><td class="inline_edit_data">' + name + '</td><td class="inline_edit_data">' + classses + '</td><td class="inline_edit_data">' + roll_no + '</td><td class="inline_edit_data">' + email + '</td><td class="inline_edit_data">' + mobile + '</td><td class="inline_edit_data">' + percent + '</td> <td class="inline_edit_data" id="update"><button class="btn btn-info" onclick="updateFun(' + id + ')">Edit</button></td><td><button class="btn btn-danger" onclick="deleteFun(' + id + ')">Delete</button></td></tr>';
      }
    }
    xhttp.open("GET", "insertData.php?name=" + name + "&" + "classes=" + classses + "&" + "roll_no=" + roll_no + "&" + "email=" + email + "&" + "mobile=" + mobile + "&" + "percent=" + percent, true);
    xhttp.send();
  }




</script>

</html>