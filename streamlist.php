<?php
    $command = "python streamlist.py";
    $pid = popen($command, "r");
    while( !feof( $pid ) ) {
        $temp .= fread($pid, 256);
        flush();
        ob_flush();
    }
    pclose($pid);
    $temp = explode("|||||", $temp);
    array_shift($temp);
    foreach($temp as $x => $value) {
        $temp1 = explode("|||", $value);
        $temp2 = explode("|", $temp1[1]);
        array_pop($temp2);
        
        echo "<div class=\"splash_box splash_extra\">\n";
        
        echo "<ul class=\"list\">\n";
        echo "<div class=\"header\"><span>{$temp1[0]}</span></div>\n";
        echo "<div class=\"divide\">&nbsp;</div>\n";
        
        if(count($temp2) > 0) {
            foreach($temp2 as $y => $streamsraw) {
                $temp3 = explode(";", $streamsraw);
                $temp3[2] = number_format($temp3[2], 0, '.', ',');
                echo "<li class=\"item\" onClick=\"fill_in('{$temp3[1]}', 'twitch.tv')\"><i class=\"fa fa-play\"></i> <div class=\"name\">{$temp3[0]}</div> <div class=\"count\">{$temp3[2]} viewers</div></li>\n";
            }
        }
        else {
            echo "nobody streaming this :(";
        }
        echo "</ul>\n";
        echo "</div>\n";
    }
?>