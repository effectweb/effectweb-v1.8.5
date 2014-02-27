//**********************************************//
// -> Effect Web                                //
// -> Powered By: Erick-Master                  //
// -> CTM TeaM Softwares                        //
// -> www.ctmts.com.br                          //
//**********************************************//

function AutoLoad()
{
	CTM_Load('?ajax=panel','Panel','GET');
	CTM_Load('?ajax=check&cmd=servers', 'ServerRefresh', 'GET');
	CTM_Load('?ajax=poll','Web_Poll','GET');
}

function count()
{
	if(document.getElementById("time").innerHTML != 0)
	{
		document.getElementById("time").innerHTML = document.getElementById("time").innerHTML - 1;
		setTimeout("count()", 1500);
	}
	else
	{
		window.location = '?';
	}
}

function VerifyDatas(div, divResult, Message, Color, ImageName)
{
	document.getElementById(div).style.border = '1px solid '+Color;
	document.getElementById(div).style.color = Color;
	document.getElementById(divResult).innerHTML = '<img src="images/icons/'+ImageName+'.png" align="absmiddle">&nbsp;<font color="'+Color+'">'+Message+'</font>';
}

function PasswordLevel(Pwd)
{
	var Password = document.getElementById(Pwd).value;
	var Command = 0;

	if(Password.length < 4)
	{
		Command = Command - 1;
	}

	if(!Password.match(/[a-z_]/i) || !Password.match(/[0-9]/))
	{
		Command = Command - 1;
	}

	if(!Password.match(/\W/))
	{
		Command = Command - 1;
	}

	if(Password == '')
	{
		VerifyDatas('Password', 'PasswordResult', 'Campo em branco', '#efdc75', 'warning');
	}

	else if(Command == 0)
	{
		VerifyDatas('Password', 'PasswordResult', 'Forte', 'green', 'success');
	}
	else if(Command == -1)
	{
		VerifyDatas('Password', 'PasswordResult', 'M&eacute;dia', 'green', 'success');
	}
	else if(Command == -2)
	{
		VerifyDatas('Password', 'PasswordResult', 'Fraca', '#FF0000', 'error');
	}
	else if(Command == -3)
	{
		VerifyDatas('Password', 'PasswordResult', 'Muita fraca', '#FF0000', 'error');
	}
}
function NumbersOnly(Send)
{       
	if (window.event)
	{
		Key = Send.keyCode;
	}

	else if (Send.which)
	{
		Key = Send.which;
	}

	if ((Key >= 48 && Key <= 57) || (Key == 8))
	{
		return true;
	}
	else
	{
		return false;
	}
}

$(function()
{
	var VIPName_1 = $("span#VIP_1").text();
	var VIPName_2 = $("span#VIP_2").text();
	
	$("a[rel*=panel]").each(function()
	{
		var Privilegy = $(this).attr("title").split(',');
		var Text = "<span class=\"h1\">" + $(this).attr("str") + "</span><br />";
		var Yes = "<b><span style=\"color: green\">Sim</span></b>";
		var No = "<b><span style=\"color: red\">N&atilde;o</span></b>";
		
		Text += "Free: ";
		Text += (Privilegy[0] == 1) ? Yes  : No;
		Text += "<br />";
		Text += VIPName_1 + ": ";
		Text += (Privilegy[1] == 1) ? Yes  : No;
		Text += "<br />";
		Text += VIPName_2 + ": ";
		Text += (Privilegy[2] == 1) ? Yes  : No;
		Text += "<br />";
		
		$(this).tooltip (Text, 
		{
			width: 200
		});
	});
	$("a[rel*=tooltip]").each(function()
	{
		var Text = $(this).attr("title");
		var Sub = $(this).attr("sub");
		$(this).tooltip (Text);
	});
	jQuery('.lightbox').lightbox();
});
function Delete_Warning()
{
	var Check = confirm('Atencao\r\nTem certeza que deseja deletar o Aviso Importante?');
	if (Check == true)
	{
		CTM_Load('?pag=paneladmin&cmd=warning', 'Panel_Nav', 'GET');
		return true;
	}
}
function New_License()
{
	var Check = confirm('Atencao\r\nO Comando a seguir irar desativar o serial atual.\r\nFazendo com que a Effect Web esteja desativada pedindo um novo serial.\r\nTem certeza que deseja continuar?');
	if (Check == true)
	{
		window.location="?exec=new_license";
		return true;
	}
}
function selecao(obj, def_texto_padrao)
{
	if(obj.constructor == String)
	{
		obj = document.getElementById(obj);
	}

	var def_texto = (def_texto_padrao) ? function(text) { obj.value += text; } : function() { return false; };
	var selecao = { text: "", defTexto: def_texto };

	if(document.selection)
	{
		var faixa = document.selection.createRange().text;
		if(faixa.text)
		{
			selecao.text = faixa.text;
			selecao.defTexto = function(text)
			{
				faixa.text = text.replace(/\r?\n/g, "\r\n");
			}
		}
	}

	else if(typeof(obj.selectionStart) != "undefined")
	{
		selecao.text = obj.value.substring(obj.selectionStart, obj.selectionEnd);
		selecao.defTexto = function(text)
		{
			obj.value = obj.value.substring(0, obj.selectionStart) + text + obj.value.substring(obj.selectionEnd);
			return false;
		}
	}

	else if(window.getSelection)
	{
		selecao.text = window.getSelection().toString();
	}
	return selecao;
}

function selTexto(obj, antes, depois)
{
	var selecionado = selecao(obj, true);
	selecionado.defTexto(antes + selecionado.text + depois);
}

function clearText(thefield)
{
	if (thefield.defaultValue == thefield.value)
	{
		thefield.value = "";
	}
}

function highlight(field)
{
	field.focus();
	field.select();
}