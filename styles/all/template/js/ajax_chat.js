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
	if ((!start) && (name != document.cookie.substring(0, name.length))) {
		return null;
	}
	if (start == -1)
		return null;
	var end = document.cookie.indexOf(';', len);
	if (end == -1)
		end = document.cookie.length;
	return unescape(document.cookie.substring(len, end));
}
var form_name = 'postform';
var text_name = 'message';
var fieldname = 'chat';
var xmlHttp = http_object();
var type = 'receive';
var d = new Date();
var post_time = d.getTime();

var interval = setInterval('handle_send("read", last_id);', read_interval);
var name = getCookie("fontholdcookie");
if (chatbbcodetrue)
{
	var blkopen = name;

	if (name == null || name === null || name == 'null')
	{
		//******************************************************************************************
		// [color2=#000000] sets the default user colour and might need to be changed depending on
		// the boards chat background colour. #000000 is black and #FFFFFF is white. 
		//******************************************************************************************
		var blkopen = '[color2=#000000]';
	}
	else
	{
		var blkopen = name;
	}

	var blkclose = '[/color2]';
}
else
{
	var blkopen = '';
	var blkclose = '';
}
$(window).load(function () {
	$("#smilies").click(function () {
		$("#chat_smilies").toggle(600);
	});
	$("#bbcodes").click(function () {
		$("#chat_bbcodes").toggle(600);
	});
	$("#bbpalette").click(function () {
		$("#colour_palette").toggle(600);
	});
});

function handle_send(mode, f)
{
	if (xmlHttp.readyState == 4 || xmlHttp.readyState == 0)
	{
		indicator_switch('on');
		type = 'receive';
		param = 'mode=' + mode;
		param += '&last_id=' + last_id;
		param += '&last_time=' + last_time;
		param += '&last_post=' + post_time;
		param += '&read_interval=' + read_interval;

		if (mode == 'add' && document.postform.message.value != '')
		{
			type = 'send';
			for (var i = 0; i < f.elements.length; i++)
			{
				elem = f.elements[i];
				param += '&' + elem.name + '=' + blkopen + " " + encodeURIComponent(elem.value) + blkclose;
			}
			document.postform.message.value = '';
		}
		else if (mode == 'add' && document.postform.message.value == '')

		{
			alert(chat_empty);
			return false;
		}

		else if (mode == 'delete')
		{
			type = 'delete';
			param += '&chat_id=' + f;
		}
		xmlHttp.open("POST", query_url, true);
		xmlHttp.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
		xmlHttp.onreadystatechange = handle_return;
		xmlHttp.send(param);
	}
}

function handle_return()
{
	if (xmlHttp.readyState == 4)
	{
		if (type != 'delete')
		{

			results = xmlHttp.responseText.split('--!--');
			if (results[1])
			{
				if (last_id == 0)
				{
					document.getElementById(fieldname).innerHTML = results[0];
				}
				else
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
			}
		}
		indicator_switch('off');
	}
}

function delete_post(chatid)
{
	document.getElementById('p' + chatid).style.display = 'none';
	handle_send('delete', chatid);
}

function indicator_switch(mode)
{
	if (document.getElementById("act_indicator"))
	{
		var img = document.getElementById("act_indicator");
		if (img.style.visibility == "hidden" && mode == 'on')
		{
			img.style.visibility = "visible";
		}
		else if (mode == 'off')
		{
			img.style.visibility = "hidden";
		}
	}

	if (document.getElementById("check_indicator"))
	{
		var img = document.getElementById("check_indicator");
		if (img.style.visibility == "hidden" && mode == 'off')
		{
			img.style.visibility = "visible";
		}
		else if (mode == 'on')
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
	}
	else if (window.ActiveXObject)
	{
		try
		{
			return new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch (e)
		{
			try
			{
				return new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch (e)
			{
				document.getElementById('p_status').innerHTML = (ie_no_ajax);
			}
		}
	}
	else
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
	}
	else
	{
		mess.value += instext;
		mess.focus();
	}
}
//END;Whatever
window.onload = function () {
	for (var i = 0, l = document.getElementsByTagName('input').length; i < l; i++) {
		if (document.getElementsByTagName('input').item(i).type == 'text') {
			document.getElementsByTagName('input').item(i).setAttribute('autocomplete', 'off');
		}
	}
};
