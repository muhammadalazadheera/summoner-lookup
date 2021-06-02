<?php include('includes/function.php') ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="shortcut icon" type="image/icon-x" href="assets/img/icon.png">
    <title>Summoner Lookup</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="assets/css/percircle.css">
    <link rel="stylesheet" href="assets/css/">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section id="expire-message" class="cinzel">
        <div class="expire-message-box">
            <h1>Your API Key Is Expired. Please Renew Your API Key.</h1>
        </div>
    </section>
    <section id="main-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="sidebar">
                        <div class="summoner-details">
                            <form action="index.php" method="POST">
                                <div class="input-group">
                                    <input type="text" name="summoner_name" class="form-control summoner-name" placeholder="Summoner" aria-label="Text input with dropdown button">
                                    <div class="input-group-append">
                                        <select class="form-control" name="region">
                                            <option value="br1">BR</option>
                                            <option value="eun1">EUN</option>
                                            <option value="euw1">EUW</option>
                                            <option value="jp1">JP</option>
                                            <option value="kr">KR</option>
                                            <option value="la1">LA1</option>
                                            <option value="la2">LA2</option>
                                            <option value="na1">NA</option>
                                            <option value="oc1">OC</option>
                                            <option value="tr1">TR</option>
                                            <option value="ru">RU</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="submit" name="search" class="btn btn-info summoner-btn" value="SEARCH">
                            </form>
                        </div>
                        <div class="css-mode-switch">
                            <ul class="cinzel">
                                <li><a id="light" href="javascript:void(0)" onclick="lightMode()"><img src="assets/img/sun.png" width="15"> Light Mode</a></li>
                                <li><a id="dark" href="javascript:void(0)" onclick="darkMode()"><img src="assets/img/moon.png" width="15"> Dark Mode</a></li>
                            </ul>
                        </div>
                        <div class="riot-logo">
                            <img class="img-fluid" src="assets/img/logo.png">
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div id="overlay" class="overlay" style="display: none;">
                        <img src="assets/img/main-logo.png">
                    </div>
                    <div class="player-info">
                        <div class="player-banner" style="">
                          <div class="player-profile-picture">
                            <img src="http://ddragon.leagueoflegends.com/cdn/11.8.1/img/profileicon/<?php echo $icon_id; ?>.png" width="75">
                          </div>
                          <div class="player-name cinzel">
                              <h1 id="scrambler"><?php echo $name; ?></h1>
                          </div>
                        </div>

                        <div class="player-stat">
                            <div class="stat-logo stat-box">
                                <div class="tier-img">
                                    <?php
                                        if ($tier == "BRONZE"){?>
                                            <img src="assets/img/tier/Emblem_Bronze.png">
                                        <?php }elseif($tier == "CHALLENGER"){?>
                                            <img src="assets/img/tier/Emblem_Challenger.png">
                                        <?php }elseif($tier == "DIAMOND"){?>
                                            <img src="assets/img/tier/Emblem_Diamond.png">
                                        <?php }elseif($tier == "GOLD"){?>
                                            <img src="assets/img/tier/Emblem_GOLD.png">
                                        <?php }elseif($tier == "GRANDMASTER"){?>
                                            <img src="assets/img/tier/Emblem_Grandmaster.png">
                                        <?php }elseif($tier == "IRON"){?>
                                            <img src="assets/img/tier/Emblem_Iron.png">
                                        <?php }elseif($tier == "MASTER"){?>
                                            <img src="assets/img/tier/Emblem_Master.png">
                                        <?php }elseif($tier == "PLATINUM"){?>
                                            <img src="assets/img/tier/Emblem_Platinum.png">
                                        <?php }elseif($tier == "SILVER"){?>
                                            <img src="assets/img/tier/Emblem_Silver.png">
                                        <?php } ?>
                                </div>
                                <div class="tier-name cinzel">
                                    <h3 id="tier"><?php echo $tier; ?></h3>
                                </div>
                            </div>
                            <div class="stat-text stat-box">
                                <ul>
                                    <li><h5 class="stint">Name: <span class="cinzel" id="scrambler-1" style="float: right;"><?php echo $name; ?></span></h5></li>
                                    <li><h5 class="stint">LP: <span class="cinzel" id="scrambler-2" style="float: right;"><?php echo $league_points; ?></span></h5></li>
                                    <li><h5 class="stint">Rank: <span class="cinzel" id="scrambler-3" style="float: right;"><?php echo $rank;?></span></h5></li>
                                    <li><h5 class="stint" style="color: #55a509 !important;">Wins: <span class="cinzel" id="scrambler-4" style="float: right; color: #55a509 !important;"><?php echo $wins; ?></span></h5></li>
                                    <li><h5 class="stint" style="color: orangered !important;">Losses: <span class="cinzel" id="scrambler-5" style="float: right; color: orangered !important;"><?php echo $losses; ?></span></h5></li>
                                    <li><h5 class="stint">Total Match: <span class="cinzel" id="scrambler-6" style="float: right;"><?php echo $total_match; ?></span></h5></li>
                                </ul>
                            </div>
                        </div>
                        <div class="percentage-box">
                            <div class="p-box">
                                <div class="percentage">
                                    <div id="demo-1" 
                                        data-text="<?php echo $total_match; ?>"
                                        data-percent="100"
                                        data-progressBarColor="#ece60e"
                                        class="red">
                                    </div>
                                </div>
                                <div class="title">Total Match</div>
                            </div>
                            <div class="p-box">
                                <div class="percentage">
                                    <div id="demo-2" 
                                        data-text="<?php echo $winning_percentage; ?>%"
                                        data-percent="<?php echo $winning_percentage; ?>"
                                        data-progressBarColor="#00ff95"
                                        class="red">
                                    </div>
                                </div>
                                <div class="title">Winning Rate</div>
                            </div>
                            <div class="p-box">
                                <div class="percentage">
                                    <div id="demo-3" 
                                        data-text="<?php echo $loosing_percentage; ?>%"
                                        data-percent="<?php echo $loosing_percentage; ?>"
                                        data-progressBarColor="#FF4654"
                                        class="red">
                                    </div>
                                </div>
                                <div class="title">Loosing Rate</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
  
</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="assets/js/percircle.js"></script>
<script src="assets/js/jquery.scrambler.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    $("#demo-1").percircle();
    $("#demo-2").percircle();
    $("#demo-3").percircle();
</script>

<script>
    var rank = "<?php print $rank; ?>";
    if (!rank){
        document.getElementById("overlay").style.display = "flex";
    }
</script>

<script>
    $(document).ready(function(){
        $("#scrambler").scrambler({
            speed : 50,
            duration : 100,
            reveal: 200
        });

        $("#scrambler-1").scrambler({
            speed : 50,
            duration : 100,
            reveal: 200
        });

        $("#tier").scrambler({
            speed : 50,
            duration : 100,
            reveal: 200
        });

        $("#scrambler-2").scrambler({
            speed : 100,
            duration : 500,
            reveal: 1000
        });

        $("#scrambler-3").scrambler({
            speed : 1000,
            duration : 500,
            reveal: 1200
        });

        $("#scrambler-4").scrambler({
            speed : 1000,
            duration : 500,
            reveal: 1200
        });

        $("#scrambler-5").scrambler({
            speed : 1000,
            duration : 500,
            reveal: 1200
        });

        $("#scrambler-6").scrambler({
            speed : 1000,
            duration : 500,
            reveal: 1200
        });

    });
</script>

<script>

    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": true,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

    <?php if ($error_message){?>
    toastr.error("<?php echo $error_message; ?>", "Error")
    <?php } ?>

</script>

<script>
    function lightMode(){
        localStorage.setItem("activeTheme", "light");
        location.reload();
        //console.log("Light")
    }
</script>

<script>
    function darkMode(){
       localStorage.setItem("activeTheme", "dark");
        location.reload();
        //console.log("Dark")
    }
</script>

<script>
    const activeTheme = localStorage.getItem("activeTheme");
    if (activeTheme) {
        document.getElementById(activeTheme).className = "css-mode-active";
        document.querySelector("link[href='assets/css/']").href = "assets/css/" + activeTheme + ".css";
    }else{
        document.querySelector("link[href='assets/css/']").href = "assets/css/dark.css";
    }
</script>

<script>
    const gap = localStorage.getItem("api-key-expire-time");
    console.log(gap);
    if (gap < 1000){
        document.getElementById("main-section").style.display = "none";
    }else{
        document.getElementById("expire-message").style.display = "none";
    }
</script>


</html>