$(function()
{

    function timeChecker()
    {
        setInterval(function()
        {
            var storedTimeStamp = sessionStorage.getItem("lastTimeStamp");
            timeCompare(storedTimeStamp);
        },1000);
    }


    function timeCompare(timeString)
    {
        var maxMinutes  = 30;
        var currentTime = new Date();
        var pastTime    = new Date(timeString);
        var timeDiff    = currentTime - pastTime;
        var minPast     = Math.floor( (timeDiff/60000) );

        if( minPast > maxMinutes)
        {
            sessionStorage.removeItem("lastTimeStamp");
            window.alert('you have been logged out due to inactivity');
            window.location = "./logout.php";
            return false;
        }
    }

    if(typeof(Storage) !== "undefined")
    {
        $(document).mousemove(function()
        {
            var timeStamp = new Date();
            sessionStorage.setItem("lastTimeStamp",timeStamp);
        });

        timeChecker();
    }
});//END JQUERY

// (https://www.youtube.com/watch?v=m930dkSCjrk)