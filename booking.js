function loadBookings(status = 'all')
{
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            document.getElementById("bookingTable").innerHTML = this.responseText;
        }
    };

    xhttp.open("GET", "../Controller/showBookings.php?status=" + status, true);
    xhttp.send();
}

function filterBookings()
{
    let status = document.getElementById("statusFilter").value;
    loadBookings(status);
}

function confirmBooking(id)
{
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            let currentStatus = document.getElementById("statusFilter")?.value || 'all';
            loadBookings(currentStatus);
        }
    };

    xhttp.open("POST", "../Controller/bookingController.php", true);
    xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=confirm&booking_id=" + id);
}

function checkInBooking(id)
{
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            let currentStatus = document.getElementById("statusFilter")?.value || 'all';
            loadBookings(currentStatus);
        }
    };

    xhttp.open("POST", "../Controller/bookingController.php", true);
    xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=checkin&booking_id=" + id);
}

function checkOutBooking(id)
{
    let xhttp = new XMLHttpRequest();

    xhttp.onreadystatechange = function()
    {
        if(this.readyState == 4 && this.status == 200)
        {
            let currentStatus = document.getElementById("statusFilter")?.value || 'all';
            loadBookings(currentStatus);
        }
    };

    xhttp.open("POST", "../Controller/bookingController.php", true);
    xhttp.setRequestHeader("content-type", "application/x-www-form-urlencoded");
    xhttp.send("action=checkout&booking_id=" + id);
}

window.onload = function() {
    loadBookings('all');
};