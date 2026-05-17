<?php

include "../Includes/auth.php";
include "../Includes/navbar.php";

include "../Includes/sidebar.php";

include "../Config/DatabaseCon.php";
include "../Model/UserModel.php";
include "../Model/RoomModel.php";

$db = new DatabaseCon();

$connection = $db->openCon();

$userModel = new UserModel();

$roomModel = new RoomModel();



$userId = $_SESSION['user_id'];



$user =
$userModel->getUserById(
    $connection,
    $userId
);

$userData =
$user->fetch_assoc();



$room_type_id =
$_GET['room_type_id'];

$checkin =
$_GET['checkin'];

$checkout =
$_GET['checkout'];

$guests =
$_GET['guests'];



$roomType =
$roomModel->getRoomTypeById(
    $connection,
    $room_type_id
);

$roomData =
$roomType->fetch_assoc();



$days =

(
    strtotime($checkout)
    -
    strtotime($checkin)
)

/

(60 * 60 * 24);



$totalPrice =
$days
*
$roomData['price_per_night'];

?>
<!DOCTYPE html>
<html>

<head>

    <title>Booking Form</title>

</head>

<body>
    <div class="content">

<div id="bookingArea">

<h2>

Booking Confirmation

</h2>



<h3>

Room Type:
<?php echo $roomData['name']; ?>

</h3>



<p>

Description:
<?php echo $roomData['description']; ?>

</p>



<p>

Price Per Night:
<?php echo $roomData['price_per_night']; ?>

</p>



<p>

Check-in:
<?php echo $checkin; ?>

</p>



<p>

Check-out:
<?php echo $checkout; ?>

</p>



<p>

Guests:
<?php echo $guests; ?>

</p>



<p>

Total Price:
<?php echo $totalPrice; ?>

</p>



<form id="bookingForm">

<input
type="hidden"
id="room_type_id"
value="<?php echo $room_type_id; ?>">



<input
type="hidden"
id="checkin"
value="<?php echo $checkin; ?>">



<input
type="hidden"
id="checkout"
value="<?php echo $checkout; ?>">



<input
type="hidden"
id="guests"
value="<?php echo $guests; ?>">



<table>

<tr>

<td>

Name

</td>

<td>

<input
type="text"
name="name"
value="<?php echo $userData['name']; ?>">

</td>

</tr>



<tr>

<td>

Phone

</td>

<td>

<input
type="text"
name="phone"
value="<?php echo $userData['phone']; ?>">

</td>

</tr>



<tr>

<td>

<input
type="button"
value="Confirm Booking"
id="confirmButton"
onclick="confirmRoomBooking()">

</td>

</tr>

</table>

</form>

</div>



<script src="../JS/booking.js"></script>

    </div>

</body>

</html>