<?php


include "../Includes/auth.php";

include "../Includes/navbar.php";

include "../Includes/sidebar.php";

?>
<!DOCTYPE html>
<html>

<head>
    <script src="../JS/searchRooms.js"></script>

    <script src="../JS/booking.js"></script>
    <link rel="stylesheet" href="../CSS/task3.css">

    <title>Search Rooms</title>

</head>

<body>
    <div class="content">



<h2>Search Available Rooms</h2>



<form>

<input type="date" id="checkin">

<input type="date" id="checkout">

<input type="number" id="guests">

<button
type="button"
onclick="searchRooms()"
>

Search

</button>

</form>


<div
id="searchError"
style="
color:red;
margin-top:10px;
margin-bottom:10px;
">

</div>

<div id="roomResults">

</div>


</div>
</body>

</html>