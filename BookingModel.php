<?php

class BookingModel
{

    


    function getAllBookings($connection)
{

    $sql = "SELECT

    bookings.id,

    bookings.room_id,

    users.name,

    rooms.room_number,

    room_types.name AS room_type,

    bookings.checkin_date,

    bookings.checkout_date,

    bookings.total_price,

    bookings.status,

    bookings.actual_checkin

    FROM bookings

    JOIN users
    ON bookings.user_id = users.id

    JOIN rooms
    ON bookings.room_id = rooms.id

    JOIN room_types
    ON rooms.room_type_id = room_types.id";


    return $connection->query($sql);

}
    



   

    function confirmBooking(
        $connection,
        $booking_id
    )
    {

        $sql = "UPDATE bookings
        SET status = 'Confirmed'
        WHERE id = ?";


        $statement = $connection->prepare($sql);

        $statement->bind_param(
            "i",
            $booking_id
        );


        return $statement->execute();

    }



    function checkInBooking(
        $connection,
        $booking_id
    )
    {

        $sql = "UPDATE bookings
        SET
        status = 'Checked-In',
        actual_checkin = NOW()

        WHERE id = ?";


        $statement = $connection->prepare($sql);

        $statement->bind_param(
            "i",
            $booking_id
        );


        return $statement->execute();

    }



    function checkOutBooking(
        $connection,
        $booking_id
    )
    {

        $sql = "UPDATE bookings
        SET status = 'Checked-Out'
        WHERE id = ?";


        $statement = $connection->prepare($sql);

        $statement->bind_param(
            "i",
            $booking_id
        );


        return $statement->execute();

    }



    


    function getBookingById(
    $connection,
    $booking_id
)
{

    $sql = "SELECT * FROM bookings
    WHERE id = ?";



    $statement = $connection->prepare($sql);



    $statement->bind_param(
        "i",
        $booking_id
    );



    $statement->execute();



    return $statement->get_result();

}


function getTodayArrivals(
    $connection
)
{

    $sql = "

    SELECT

    bookings.*,

    users.name

    FROM bookings

    JOIN users
    ON bookings.user_id = users.id

    WHERE

    checkin_date = CURDATE()

    AND

    status = 'Confirmed'

    ";



    $result =
    $connection->query($sql);



    return $result;

}

function getTodayDepartures(
    $connection
)
{

    $sql = "

    SELECT

    bookings.*,

    users.name

    FROM bookings

    JOIN users
    ON bookings.user_id = users.id

    WHERE

    checkout_date = CURDATE()

    AND

    status = 'Checked-In'

    ";



    $result =
    $connection->query($sql);



    return $result;

}

function getWeeklyRevenue($connection)
{
    $sql = "
        SELECT
            WEEK(checkin_date) AS week,
            SUM(total_price) AS revenue
        FROM bookings
        WHERE
            checkin_date >= DATE_SUB(CURDATE(), INTERVAL ? WEEK)
        GROUP BY WEEK(checkin_date)
        ORDER BY week ASC
    ";

    $statement = $connection->prepare($sql);

    $weeksLimit = 8;
    $statement->bind_param("i", $weeksLimit);

    $statement->execute();

    $result = $statement->get_result();

    return $result;
}

}


?>