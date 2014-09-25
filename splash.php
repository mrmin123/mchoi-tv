<div id="splash">
    <div class="splash_box splash_main">
        <h1>stay a while and listen</h1>
        <p>a minimal interface for twitch streams, for people who don't need everything the twitch.tv interface offers</p>
        <form class="search">
            <p>
                <input type="text" value="<? echo $one; ?>" id="one" placeholder="screen one" />
            </p>
            <p>
                <input type="text" value="<? echo $two; ?>" id="two" placeholder="screen two" />
            </p>
        </form>
        <a href="javascript:void(0);" id="load" class="button" onClick="load()"><i class="fa fa-play-circle"></i> <span>load</span></a>&nbsp;
        <a href="javascript:void(0);" id="clear" class="button" onClick="form_clear()"><i class="fa fa-square-o"></i> <span>clear</span></a><br />
        <a href="javascript:void(0);" id="refresh" class="button" onClick="refresh()"><i class="fa fa-refresh"></i> <span>refresh</span></a>
    </div>
    
    <div id="streamlist"></div>
    
    <div id="loading">
        <i id="loading_icon" class="fa fa-spinner fa-spin"></i>
    </div>
</div>
