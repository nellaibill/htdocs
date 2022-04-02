<?php
include 'globalfile.php';
?>
<?php

if(isset($_POST['submit'])) {
    $country = $_POST['countries'];
    echo $country;
}

?>

<form method="POST">
    <input list="countries" name="countries" />
    <datalist id="countries">
        <option value="India">India</option>
        <option value="United States">United States</option>
        <option value="United Kingdom">United Kingdom</option> 
        <option value="Germany">Germany</option> 
        <option value="France">France</option> 
    </datalist>
    <input type="submit" name="submit" />
    
    <div class="row">
      <div class="col-sm-10">.col-sm-4</div>
  <div class="col-sm-2"><marquee>
  saleem
  </marquee></div>


</div>
</form>

<!DOCTYPE html>
<html>
<head>
<style>
* {
  box-sizing: border-box;
}

#myInput {
  background-image: url('/css/searchicon.png');
  background-position: 10px 12px;
  background-repeat: no-repeat;
  width: 100%;
  font-size: 16px;
  padding: 12px 20px 12px 40px;
  border: 1px solid #ddd;
  margin-bottom: 12px;
}

#myUL {
  list-style-type: none;
  padding: 0;
  margin: 0;
}

#myUL li a {
  border: 1px solid #ddd;
  margin-top: -1px; /* Prevent double borders */
  background-color: #f6f6f6;
  padding: 12px;
  text-decoration: none;
  font-size: 18px;
  color: black;
  display: block
}

#myUL li a.header {
  background-color: #e2e2e2;
  cursor: default;
}

#myUL li a:hover:not(.header) {
  background-color: #eee;
}
</style>
</head>
<body>

<h2>My Phonebook</h2>

<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">

<ul id="myUL">
  <li><a href="#" class="header">A</a></li>
  <li><a href="#">Adele</a></li>
  <li><a href="#">Agnes</a></li>

  <li><a href="#" class="header">B</a></li>
  <li><a href="#">Billy</a></li>
  <li><a href="#">Bob</a></li>

  <li><a href="#" class="header">C</a></li>
  <li><a href="#">Calvin</a></li>
  <li><a href="#">Christina</a></li>
  <li><a href="#">Cindy</a></li>
</ul>

<script>
function myFunction() {
    var input, filter, ul, li, a, i;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("myUL");
    li = ul.getElementsByTagName("li");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("a")[0];
        if (a.innerHTML.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "";
        } else {
            li[i].style.display = "none";

        }
    }
}
</script>

</body>
</html>
