<?php
    function strip_input($input) {
        $input = htmlspecialchars(addslashes(strip_tags(trim($input))));
        return $input;
    }
    
    function draw_stream($id) {
        echo "<object type='application/x-shockwave-flash' height='100%' width='100%' data='http://www.twitch.tv/widgets/live_embed_player.swf?channel={$id}' bgcolor='#000000' id='live_embed_player_flash' class='videoplayer'>\n";
        echo "            <param name='allowFullScreen' value='true' />\n";
        echo "            <param name='allowScriptAccess' value='always' />\n";
        echo "            <param name='allowNetworking' value='all' />\n";
        echo "            <param name='movie' value='http://www.twitch.tv/widgets/live_embed_player.swf' />\n";
        echo "            <param name='flashvars' value='hostname=www.twitch.tv&channel={$id}&auto_play=true&start_volume=100' />\n";
        echo "        </object>\n";
    }
    
    $set = 0;
    $one = '';
    $two = '';
    
    if(isset($_GET['one']) && $_GET['one'] != '') {
        $one = strip_input($_GET['one']);
        $set++;
    }
    if(isset($_GET['two']) && $_GET['two'] != '') {
        $two = strip_input($_GET['two']);
        $set++;
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
<?
    if ($set == 1) {
        echo "    <title>stay a while and listen &raquo; {$one}</title>\n";
    }
    elseif ($set == 2) {
        echo "    <title>stay a while and listen &raquo; {$one} & {$two}</title>\n";
    }
    else {
        echo "    <title>stay a while and listen</title>\n";
    }
?>
    <link href="http://fonts.googleapis.com/css?family=Alegreya+Sans+SC:100,300,700" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="/includes/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="/tv/index.css" type="text/css" media="screen" />
    <script src="/includes/jquery.min.js"></script>
    <script src="/tv/index.js"></script>
</head>
<body>
<? if($set == 1) { ?>
    <script>window.onload = function() { $("#remote").load("/tv/splash.php") };</script>
    <div id="split_none">
        <? draw_stream($one); ?>
    </div>
    <div id="remote"></div>
    <div id="control">
        <p><a href="/tv/" data-hover="home">home</a> <a href="javascript:void(0);" onClick="toggle_remote()" data-hover="remote">remote</a></p>
    </div>
<? } elseif ($set == 2) { ?>
    <script>window.onload = function() { $("#remote").load("/tv/splash.php") };</script>
    <div id="split_left">
        <? draw_stream($one); ?>
    </div>
    <div id="split_right">
        <? draw_stream($two); ?>
    </div>
    <div id="remote"></div>
    <div id="control">
        <p>
            <a href="/tv/" data-hover="home">home</a>
            <a href="/tv/watch/<? echo $one; ?>/" title="<? echo $one; ?>">left only</a>
            <a href="javascript:void(0);" onClick="toggle('left')" id="toggle_left">hide left</a>
            <a href="javascript:void(0);" onClick="toggle('right')" id="toggle_right">hide right</a>
            <a href="/tv/watch/<? echo $two; ?>/" title="<? echo $two; ?>">right only</a>
            <a href="javascript:void(0);" onClick="toggle_remote()">remote</a>
        </p>
    </div>
<? } else { include("splash.php"); } ?>
</body>
</html>