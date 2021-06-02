<?php

$conn = mysqli_connect('localhost','root','','riot');

$result = mysqli_query($conn, "SELECT `api_key`, `expire_date` FROM `api` WHERE 1");
$res = mysqli_fetch_array($result);

$api_key = $res['api_key'];
$name = '';
$wins = '';
$losses = '';
$tier = '';
$losses = '';
$league_points = '';
$rank = '';
$total_match = '';
$winning_percentage = '';
$loosing_percentage = '';
$icon_id = '';
$error_message = '';

if (isset($_POST['search'])){

    $region = $_POST['region'];
    $summoner_name = $_POST['summoner_name'];
    $summoner_name = str_replace(" ","%20",$summoner_name);

    $id_url = "https://".$region.".api.riotgames.com/lol/summoner/v4/summoners/by-name/".$summoner_name."?api_key=".$api_key;

    try {
        function summoner_id($id_url, $api_key){

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL,$id_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            $error_response = json_decode(curl_exec($ch),TRUE);
            $response = json_decode(curl_exec($ch));

            $status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            if ($status == 400){
                throw new Exception("Some Thing Went Wrong! Please Insert Correct Information.");
            }elseif ($status == 0){
                throw new Exception("Some Thing Went Wrong! Please Insert Correct Information.");
            }elseif ($status == 403){
                throw new Exception("Some Thing Went Wrong! Please Insert Correct Information.");
            }elseif ($status == 404){
                throw new Exception("Some Thing Went Wrong! Please Insert Correct Information.");
            }
            else {
                $id = $response->id;
                global $icon_id;
                $icon_id = $response->profileIconId;
                $info_url = "https://la2.api.riotgames.com/lol/league/v4/entries/by-summoner/" . $id . "?api_key=" . $api_key;

                summoner_info($info_url);

            }
            //return true;
        }

        function summoner_info($info_url){
            $ch2 = curl_init();
            curl_setopt($ch2,CURLOPT_URL,$info_url);
            curl_setopt($ch2, CURLOPT_RETURNTRANSFER, TRUE);
            $result = curl_exec($ch2);
            $final = json_decode($result,true);
            curl_close($ch2);

            if (!empty($final)) {

                global $name;
                global $wins;
                global $losses;
                global $tier;
                global $rank;
                global $league_points;
                global $total_match;
                global $winning_percentage;
                global $loosing_percentage;

                $name = $final[0]["summonerName"];
                $wins = $final[0]["wins"];
                $losses = $final[0]["losses"];
                $tier = $final[0]["tier"];
                $rank = $final[0]["rank"];
                $league_points = $final[0]["leaguePoints"];
                $total_match = $wins + $losses;
                $winning_percentage = round(($wins * 100) / $total_match);
                $loosing_percentage = 100 - $winning_percentage;
            }else{
                throw new Exception("NO DATA FOUND ASSOCIATES THIS ID");
            }
        }

        summoner_id($id_url, $api_key);

    }
    catch (Exception $error){
        global $error_message;
        $error_message = $error->getMessage();
    }

}