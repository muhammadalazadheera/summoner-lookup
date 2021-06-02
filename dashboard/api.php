<?php

define('TITLE', "API Key Status");
include '../assets/layouts/header.php';
check_verified();

$api_key = '';
$expire_date = '';
$result = mysqli_query($conn, "SELECT `api_key`, `expire_date` FROM `api` WHERE 1");
$res = mysqli_fetch_array($result);

$api_key = $res['api_key'];
$expire_date = $res['expire_date'];

?>


<main role="main" class="container">

    <div class="row">
        <div class="col-sm-3">

            <?php include('../assets/layouts/profile-card.php'); ?>

        </div>
        <div class="col-sm-9">

            <div class="d-flex align-items-center p-3 mt-5 mb-3 text-white-50 bg-purple rounded box-shadow">
                <img class="mr-3" src="../assets/images/api.png" alt="" width="48" height="48">
                <div class="lh-100">
                    <form method="POST" action="includes/store_api.php">
                        <div class="form-group">
                            <label for="exampleInputEmail1">API Key</label>
                            <input type="text" class="form-control" name="api_key" placeholder="Enter API Key" value="<?php echo $api_key; ?>" required>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Expire Time</label>
                            <input type="datetime-local" class="form-control" name="expire_date" value="<?php echo $expire_date; ?>" required>
                            <small>Insert The Pacific Timezone Time</small>
                        </div>
                        <button type="submit" name="store_api" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>

            <div class="d-flex align-items-center p-3 mt-5 mb-3 text-white-50 bg-purple rounded box-shadow">
                <img class="mr-3" src="../assets/images/clock.png" alt="" width="48" height="48">
                <div id="counter-container" class="lh-100" style="">
                    <div id="countdown-container" class="countdown-container" style="">
                        <div class="hour-container">
                            <h3 class="hour">Time</h3>
                            <h6>Hour</h6>
                        </div>
                        <div class="minute-container">
                            <h3 class="minute">Time</h3>
                            <h6>Minute</h6>
                        </div>
                        <div class="second-container">
                            <h3 class="second">Time</h3>
                            <h6>Second</h6>
                        </div>
                    </div>
                    <div id="expire-message" class="expire-message">
                        <h5>The API Key Is Expired): Please Renew Your Api Key.</h5>
                    </div>
                </div>
            </div>

        </div>
    </div>
</main>


<?php
    include '../assets/layouts/footer.php';
?>

<script>
    
    const countDown = () => {
        const countDate = new Date("<?php echo $expire_date; ?>").getTime();
        const now = new Date().getTime();
        var gap = countDate - now;

        localStorage.setItem("api-key-expire-time",gap);

        if (gap < 1000){
            document.getElementById("countdown-container").style.display = "none";
            document.getElementById("counter-container").style.width = "100%";
        }else{
            document.getElementById("expire-message").style.display = "none";
            document.getElementById("counter-container").style.width = "25%";
        }

        const second = 1000;
        const minute = second * 60;
        const hour = minute * 60;

        const remainingHour = Math.floor(gap / hour);
        const remainingMinute = Math.floor((gap % hour) / minute);
        const remainingSecond = Math.floor((gap % minute) / second);

        document.querySelector(".hour").innerText = remainingHour;
        document.querySelector(".minute").innerText = remainingMinute;
        document.querySelector(".second").innerText = remainingSecond;

    }

    setInterval(countDown,1000);
        
</script>