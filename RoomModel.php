<?php

class RoomModel
{




   

    function getRoomById(
        $connection,
        $id
    )
    {

        $sql = "SELECT * FROM rooms
        WHERE id = ?";


        $statement = $connection->prepare($sql);

        $statement->bind_param(
            "i",
            $id
        );


        $statement->execute();

        return $statement->get_result();

    }



    function updateRoomStatus(
        $connection,
        $id,
        $status
    )
    {

        $sql = "UPDATE rooms
        SET status = ?
        WHERE id = ?";


        $statement = $connection->prepare($sql);

        $statement->bind_param(
            "si",
            $status,
            $id
        );


        return $statement->execute();

    }



    


function getTotalRooms($connection)
{
    $sql = "SELECT COUNT(*) AS total FROM rooms";

    $statement = $connection->prepare($sql);

    $statement->execute();

    $result = $statement->get_result();

    return $result->fetch_assoc();
}

function getAvailableRoomCount($connection)
{
    $sql = "SELECT COUNT(*) AS available FROM rooms WHERE status = ?";

    $statement = $connection->prepare($sql);

    $status = "available";

    $statement->bind_param("s", $status);

    $statement->execute();

    $result = $statement->get_result();

    return $result->fetch_assoc();
}

function getMaintenanceRooms($connection)
{
    $sql = "SELECT COUNT(*) AS maintenance FROM rooms WHERE status = ?";

    $statement = $connection->prepare($sql);

    $status = "maintenance";

    $statement->bind_param("s", $status);

    $statement->execute();

    $result = $statement->get_result();

    return $result->fetch_assoc();
}
function getOccupiedRooms($connection)
{
    $sql = "SELECT COUNT(*) AS occupied FROM bookings WHERE status = ?";

    $statement = $connection->prepare($sql);

    $status = "Checked-In";

    $statement->bind_param("s", $status);

    $statement->execute();

    $result = $statement->get_result();

    return $result->fetch_assoc();
}

}

?>
