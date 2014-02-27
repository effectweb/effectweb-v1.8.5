$(function()
{
	
	$('#sidebar h3').attr('title', 'Clique aqui para abrir/fechar o bloco abaixo.').click(function()
	{
		$(this).next().toggle('slow');
	});
	
	$('.openPanel').css('cursor', 'pointer').click(function()
	{
		var next = $(this).next();
		if(next.is(':visible'))
		{
			next.fadeOut('normal');
		}
		else
		{
			next.fadeIn('slow');
		}
	});
});