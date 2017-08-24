function setCookie(name, value, expires, path, domain, secure) {
	var today = new Date();
	today.setTime(today.getTime());
	if (expires) {
		expires = expires * 1000 * 60 * 60 * 24;
	}
	var expires_date = new Date(today.getTime() + (expires));
	document.cookie = name + '=' + escape(value) +
			((expires) ? ';expires=' + expires_date.toGMTString() : '') + //expires.toGMTString()
			((path) ? ';path=' + path : '') +
			((domain) ? ';domain=' + domain : '') +
			((secure) ? ';secure' : '');
}

//******************************************************************************************
// This functions reads & returns the cookie value of the specified cookie (by cookie name)
//******************************************************************************************
function getCookie(name) {
	var start = document.cookie.indexOf(name + "=");
	var len = start + name.length + 1;
	if ((!start) && (name !== document.cookie.substring(0, name.length))) {
		return null;
	}
	if (start === -1)
		return null;
	var end = document.cookie.indexOf(';', len);
	if (end === -1)
		end = document.cookie.length;
	return unescape(document.cookie.substring(len, end));
}

function deletecookie(name)
{
	var cookie_date = new Date( );  // current date & time
	cookie_date.setTime(cookie_date.getTime() - 1);
	document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
	location.reload(true);
}

var form_name = 'postform';
var text_name = 'message';
var fieldname = 'chat';
var xmlHttp = http_object();
var type = 'receive';
var d = new Date();
var post_time = d.getTime();
var interval = setInterval('handle_send("read", last_id);', read_interval);
var name = getCookie(cookie_name);
var blkopen = '';
var blkclose = '';

if (chatbbcodetrue && name !== null && name !== 'null') {

	blkopen = name;
	blkclose = '[/color2]';
}

function handle_send(mode, f)
{
	if (xmlHttp.readyState === 4 || xmlHttp.readyState === 0)
	{
		indicator_switch('on');
		type = 'receive';
		param = 'mode=' + mode;
		param += '&last_id=' + last_id;
		param += '&last_time=' + last_time;
		param += '&last_post=' + post_time;
		param += '&read_interval=' + read_interval;

		if (mode === 'add' && document.postform.message.value !== '')
		{
			type = 'send';
			for (var i = 0; i < f.elements.length; i++)
			{
				elem = f.elements[i];
				param += '&' + elem.name + '=' + blkopen + "" + encodeURIComponent(elem.value) + blkclose;
			}
			document.postform.message.value = '';
		} else if (mode === 'add' && document.postform.message.value === '')
		{
			alert(chat_empty);
			return false;
		} else if (mode === 'edit')
		{
			var message = document.getElementById('message').value;
			type = 'edit';
			mode += '/' + f;
			param = '&submit=1&message=' + message;
		} else if (mode === 'delete')
		{
			var parent = document.getElementById('chat');
			var child = document.getElementById('p' + f);
			parent.removeChild(child);
			type = 'delete';
			param += '&chat_id=' + f;
		} else if (mode === 'quotemessage')
		{
			type = 'quotemessage';
			param += '&chat_id=' + f;
		}

		xmlHttp.open('POST', query_url + '/' + mode, true);
		xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = handle_return;
		xmlHttp.send(param);
	}
}

function handle_return()
{
	if (xmlHttp.readyState === 4)
	{
		if (xmlHttp.status == 200)
		{
			results = xmlHttp.responseText.split('--!--');

			if (type === 'quotemessage') {
				if (results[0]) {
					$text = document.getElementById('message').value;
					document.getElementById('message').value = $text + results[0];
					document.getElementById("message").focus();
					$('#chat').find('.username, .username-coloured').attr('title', chat_username_title);
				}
			} else if (type === 'edit') {
				jQuery(function($) {

					'use strict';

					var opener = window.opener;
					if (opener) {
						$(opener.document).find('#p' + last_id).replaceWith(results[0]);
					}

					var popup = window.self;
					popup.opener = window.self;
					popup.close();
					$('#chat').find('.username, .username-coloured').attr('title', chat_username_title);
				});
			} else if (type !== 'delete') {
				if (results[1])
				{
					if (last_id === 0)
					{
						document.getElementById(fieldname).innerHTML = results[0];
					} else
					{
						document.getElementById(fieldname).innerHTML = results[0] + document.getElementById(fieldname).innerHTML;
					}
					last_id = results[1];
					if (results[2])
					{
						document.getElementById('whois_online').innerHTML = results[2];
						last_time = results[3];
						if (results[4] !== read_interval)
						{
							read_interval = results[4];
							window.clearInterval(interval);
							interval = setInterval('handle_send("read", last_id);', read_interval * 1000);
							document.getElementById('update_seconds').innerHTML = read_interval;
						}

					}
					$('#chat').find('.username, .username-coloured').attr('title', chat_username_title);
				}
			} else if (type == 'delete') {
				var parent = document.getElementById('chat');
				var child = document.getElementById('p' + results[0]);
				parent.removeChild(child);
			}
			if (chatmessagedown)
			{
				setInterval(function(){
					var $chatscroll = $('div.shout-body');
					if($chatscroll.filter(function(){ return $(this).is(':hover'); }).length){$chatscroll.stop();}else {$chatscroll.scrollTop($('#chat').height());}
				}, 200);
			}
			indicator_switch('off');
		} else {
			if (type == 'receive') {
				window.clearInterval(interval);
			}
			handle_error(xmlHttp.status, xmlHttp.statusText, type);
		}
	}
}

function handle_error(http_status, status_text, type) {
	var error_text = status_text;

	if (http_status == 403) {
		if (type == 'send') {
			error_text = chat_error_post;
		} else if (type == 'delete') {
			error_text = chat_error_del;
		} else {
			error_text = chat_error_view;
		}
	}
	$('#chat-text').after('<div class="error">' + error_text +'</div>');
}

function delete_post(chatid)
{
	document.getElementById('p' + chatid).style.display = 'none';
	handle_send('delete', chatid);
}

function chatquote(chatid)
{
	handle_send('quotemessage', chatid);
}

function indicator_switch(mode)
{
	if (document.getElementById("act_indicator"))
	{
		var img = document.getElementById("act_indicator");
		if (img.style.visibility === "hidden" && mode === 'on')
		{
			img.style.visibility = "visible";
		} else if (mode === 'off')
		{
			img.style.visibility = "hidden";
		}
	}

	if (document.getElementById("check_indicator"))
	{
		var img = document.getElementById("check_indicator");
		if (img.style.visibility === "hidden" && mode === 'off')
		{
			img.style.visibility = "visible";
		} else if (mode === 'on')
		{
			img.style.visibility = "hidden";
		}
	}
}

function http_object()
{
	if (window.XMLHttpRequest)
	{
		return new XMLHttpRequest();
	} else if (window.ActiveXObject)
	{
		try
		{
			return new ActiveXObject("Msxml2.XMLHTTP");
		} catch (e)
		{
			try
			{
				return new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e)
			{
				document.getElementById('p_status').innerHTML = (ie_no_ajax);
			}
		}
	} else
	{
		document.getElementById('p_status').innerHTML = (upgrade_browser);
	}
}

//START:Whatever
function addText(instext)
{
	var mess = document.getElementById('message');
	//IE support
	if (document.selection)
	{
		mess.focus();
		sel = document.selection.createRange();
		sel.text = instext;
		document.message.focus();
	}
	//MOZILLA/NETSCAPE support
	else if (mess.selectionStart || mess.selectionStart === "0")
	{
		var startPos = mess.selectionStart;
		var endPos = mess.selectionEnd;
		var chaine = mess.value;
		mess.value = chaine.substring(0, startPos) + instext + chaine.substring(endPos, chaine.length);
		mess.selectionStart = startPos + instext.length;
		mess.selectionEnd = endPos + instext.length;
		mess.focus();
	} else
	{
		mess.value += instext;
		mess.focus();
	}
}
//END;Whatever

function parseColor(color) {
    var arr=[]; color.replace(/[\d+\.]+/g, function(v) { arr.push(parseFloat(v)); });
    return {
        hex: "#" + arr.slice(0, 3).map(toHex).join(""),
        opacity: arr.length == 4 ? arr[3] : 1
    };
}
function toHex(int) {
    var hex = int.toString(16);
    return hex.length == 1 ? "0" + hex : hex;
}

jQuery(function($) {

	'use strict';

	$(window).load(function () {
		$("#smilies").click(function () {
			$("#chat_smilies").toggle(600);
		});
		$("#bbcodes").click(function () {
			$("#chat_bbcodes").toggle(600);
		});
		$("#chat_bbpalette").click(function () {
			$("#chat_colour_palette").toggle(600);
		});
		if (chatmessagedown && type !== 'edit')
		{
			setInterval(function(){
				var $chatscroll = $('div.shout-body');
				if($chatscroll.filter(function(){ return $(this).is(':hover'); }).length){$chatscroll.stop();}else {$chatscroll.scrollTop($('#chat').height());}
			}, 200);
		}
	});

	var $chat_edit = $('#chat_edit');
	$chat_edit.find('#submit').on('click', function(e) {
		e.preventDefault();
		handle_send('edit', $chat_edit.find('input[name=chat_id]').val());
	});

	$('#chat').find('.username, .username-coloured').attr('title', chat_username_title);

	$('#chat').on('click', '.username, .username-coloured', function(e) {
		e.preventDefault();

		var username = $(this).text(),
			user_colour = ($(this).hasClass('username-coloured')) ? parseColor($(this).css('color')).hex : false;

		if (user_colour) {
			insert_text('[color=' + user_colour + '][b]@' + username + '[/b][/color], ');
		} else {
			insert_text('[b]@' + username + '[/b], ');
		}
	});
});
