var c = 0;
var h = 0;
var cooldown = 30;
var min_width = 0;
var state_left = 1;
var state_right = 1;

$(document).ready(function() {
    $('#splash').css('width', $(window).width());
    
    $('#remote').hide();
    $('#streamlist').load('/tv/streamlist.php', function () { animateLists(); });
    
    $(window).resize(function() {
        if ($(window).width() < min_width) {
            $('#splash').css('width', min_width);
        } else {
            $('#splash').css('width', $(window).width());
        }
    });
});

function load() {
    if ($('#one').val() !== '' && $('#two').val() === '') {
        window.location.href = '/tv/watch/' + $('#one').val() + '/';
    }
    else if ($('#one').val() === '' && $('#two').val() !== '') {
        window.location.href = '/tv/watch/' + $('#two').val() + '/';
    }
    else if ($('#one').val() !== '' && $('#two').val() !== '') {
        window.location.href = '/tv/watch/' + $('#one').val() + '/' + $('#two').val() + '/';
    }
}

function form_clear() {
    $('#one').val('');
    $('#one_s').val('twitch.tv');
    $('#two').val('');
    $('#two_s').val('twitch.tv');
    c = 0;
}

function refresh() {
    var tot_time = cooldown * 1000;
    $('.splash_extra').each(function(i) {
        $(this).delay(i*150).animate({'top': 1000}, 800, 'swing');
    });
    $('#loading_icon').delay(1000).animate({'opacity': 1}, 200, 'linear');
    $('#streamlist').load('/tv/streamlist.php', function () { animateLists(); });
    
    $('#refresh').html('<span>' + cooldown + '</span>');
    $('#refresh').removeClass('button');
    $('#refresh').addClass('button_disabled');
    document.getElementById("refresh").onclick = refresh_disabled;
    setTimeout (function(){
        $('#refresh').html('<i class="fa fa-refresh"></i> <span>refresh</span>');
        $('#refresh').removeClass('button_disabled');
        $('#refresh').addClass('button');
        document.getElementById("refresh").onclick = refresh;
    },tot_time);
    
    countdowntimer(cooldown);
    function countdowntimer(timer) {
        setTimeout (function(){
            if(timer > 1){
            timer--;
            $('#refresh').html('<span>' + timer + '</span>');
            countdowntimer(timer);
            }
        },1000);
    };
}

function refresh_disabled() {
}

function fill_in(x, y) {
    if ($('#one').val() === '') {
        $('#one').val(x);
        $('#one_s').val(y);
    }
    else if ($('#one').val() !== '' && $('#two').val() === '') {
        $('#two').val(x);
        $('#two_s').val(y);
    }
    else {
        if (c == 0) {
            $('#one').val(x);
            $('#one_s').val(y);
            c = 1;
        }
        else if (c == 1) {
            $('#two').val(x);
            $('#two_s').val(y);
            c = 0;
        }
    }
}

function toggle_remote() {
    $('#remote').slideToggle('500', 'swing');
	if (h == 0) {
        $('#streamlist').load('/tv/streamlist.php', function () { animateLists(); });
		h = 1;
	}
	else if (h == 1) {
		h = 0;
	}
}

function animateLists() {
    var col_count = 0;
    
    $('#loading_icon').animate({'opacity': 0}, 200, 'linear');
    $('.splash_extra').each(function(i) {
        $(this).delay(i*150).animate({'top': 0}, 800, 'swing');
        col_count++;
    });
    
    min_width = 500 + (col_count * 150);
    if ($(window).width() < min_width) {
        $('#splash').css('width', min_width);
    } else {
        $('#splash').css('width', $(window).width());
    }
}

function toggle(side) {
    $('html').css('overflow', 'hidden');
    if (side == 'left') {
        if (state_left == 1) {
            hide_left();
            show_right();
        } else {
            show_both();
        }
    } else if (side == 'right') {
        if (state_right == 1) {
            hide_right();
            show_left();
        } else {
            show_both();
        }
    }
}

function hide_left() {
    $('#split_left').animate({'right': '100%', 'left': 0}, 'linear');
    $('#toggle_left').text('show left');
    state_left = 0;
}

function hide_right() {
    $('#split_right').animate({'right': '-50%','left': '100%'}, 500, 'linear');
    $('#toggle_right').text('show right');
    state_right = 0;
}

function show_left() {
    $('#split_left').animate({'right': 0, 'left': 0}, 500, 'linear');
    $('#toggle_left').text('hide left');
    state_left = 1;
}

function show_right() {
    $('#split_right').animate({'right': 0, 'left': 0}, 500, 'linear');
    $('#toggle_right').text('hide right');
    state_right = 1;
}

function show_both() {
    $('#split_left').animate({'right': '50%', 'left': 0}, 500, 'linear');
    $('#split_right').animate({'right': 0, 'left': '50%'}, 500, 'linear');
    $('#toggle_left').text('hide left');
    $('#toggle_right').text('hide right');
    state_left = 1;
    state_right = 1;
}