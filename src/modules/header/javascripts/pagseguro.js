function FormataValor(objeto,teclapres,tammax,decimais) 
{

	var tecla			= teclapres.keyCode;
	var tamanhoObjeto	= objeto.value.length;

	if ((tecla == 8) && (tamanhoObjeto == tammax))
	{
		tamanhoObjeto = tamanhoObjeto - 1 ;
	}



if (( tecla == 8 || tecla == 88 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 ) && ((tamanhoObjeto+1) <= tammax))
	{

		vr	= objeto.value;
		vr	= vr.replace( "/", "" );
		vr	= vr.replace( "/", "" );
		vr	= vr.replace( ",", "" );
		vr	= vr.replace( ".", "" );
		vr	= vr.replace( ".", "" );
		vr	= vr.replace( ".", "" );
		vr	= vr.replace( ".", "" );
		tam	= vr.length;
		
		if (tam < tammax && tecla != 8)
		{
			tam = vr.length + 1 ;
		}

		if ((tecla == 8) && (tam > 1))
		{
			tam = tam - 1 ;
			vr = objeto.value;
			vr = vr.replace( "/", "" );
			vr = vr.replace( "/", "" );
			vr = vr.replace( ",", "" );
			vr = vr.replace( ".", "" );
			vr = vr.replace( ".", "" );
			vr = vr.replace( ".", "" );
			vr = vr.replace( ".", "" );
		}
	
		//Cálculo para casas decimais setadas por parametro
		if ( tecla == 8 || tecla >= 48 && tecla <= 57 || tecla >= 96 && tecla <= 105 )
		{
			if (decimais > 0)
			{
				if ( (tam <= decimais) )
				{ 
					objeto.value = ("0," + vr) ;
				}
				if( (tam == (decimais + 1)) && (tecla == 8))
				{
					objeto.value = vr.substr( 0, (tam - decimais)) + ',' + vr.substr( tam - (decimais), tam ) ;	
				}
				if ( (tam > (decimais + 1)) && (tam <= (decimais + 3)) &&  ((vr.substr(0,1)) == "0"))
				{
					objeto.value = vr.substr( 1, (tam - (decimais+1))) + ',' + vr.substr( tam - (decimais), tam ) ;
				}
				if ( (tam > (decimais + 1)) && (tam <= (decimais + 3)) &&  ((vr.substr(0,1)) != "0"))
				{
				    objeto.value = vr.substr( 0, tam - decimais ) + ',' + vr.substr( tam - decimais, tam ) ; 
				}
				if ( (tam >= (decimais + 4)) && (tam <= (decimais + 6)) )
				{
			 		objeto.value = vr.substr( 0, tam - (decimais + 3) ) + '.' + vr.substr( tam - (decimais + 3), 3 ) + ',' + vr.substr( tam - decimais, tam ) ;
				}
			 	if ( (tam >= (decimais + 7)) && (tam <= (decimais + 9)) )
				{
			 		objeto.value = vr.substr( 0, tam - (decimais + 6) ) + '.' + vr.substr( tam - (decimais + 6), 3 ) + '.' + vr.substr( tam - (decimais + 3), 3 ) + ',' + vr.substr( tam - decimais, tam ) ;
				}
				if ( (tam >= (decimais + 10)) && (tam <= (decimais + 12)) )
				{
			 		objeto.value = vr.substr( 0, tam - (decimais + 9) ) + '.' + vr.substr( tam - (decimais + 9), 3 ) + '.' + vr.substr( tam - (decimais + 6), 3 ) + '.' + vr.substr( tam - (decimais + 3), 3 ) + ',' + vr.substr( tam - decimais, tam ) ;
				}
				if ( (tam >= (decimais + 13)) && (tam <= (decimais + 15)) )
				{
			 		objeto.value = vr.substr( 0, tam - (decimais + 12) ) + '.' + vr.substr( tam - (decimais + 12), 3 ) + '.' + vr.substr( tam - (decimais + 9), 3 ) + '.' + vr.substr( tam - (decimais + 6), 3 ) + '.' + vr.substr( tam - (decimais + 3), 3 ) + ',' + vr.substr( tam - decimais, tam ) ;
				}
			}
			else if(decimais == 0)
			{
				if ( tam <= 3 )
				{ 
			 		objeto.value = vr ;
				}
				if ( (tam >= 4) && (tam <= 6) )
				{
					if(tecla == 8)
					{
						objeto.value = vr.substr(0, tam);
						window.event.cancelBubble = true;
						window.event.returnValue = false;
					}
					objeto.value = vr.substr(0, tam - 3) + '.' + vr.substr( tam - 3, 3 ); 
				}
				if ( (tam >= 7) && (tam <= 9) )
				{
					if(tecla == 8)
					{
						objeto.value = vr.substr(0, tam);
						window.event.cancelBubble = true;
						window.event.returnValue = false;
					}
					objeto.value = vr.substr( 0, tam - 6 ) + '.' + vr.substr( tam - 6, 3 ) + '.' + vr.substr( tam - 3, 3 ); 
				}
				if ( (tam >= 10) && (tam <= 12) )
				{
			 		if(tecla == 8)
					{
						objeto.value = vr.substr(0, tam);
						window.event.cancelBubble = true;
						window.event.returnValue = false;
					}
					objeto.value = vr.substr( 0, tam - 9 ) + '.' + vr.substr( tam - 9, 3 ) + '.' + vr.substr( tam - 6, 3 ) + '.' + vr.substr( tam - 3, 3 ); 
				}





				if ( (tam >= 13) && (tam <= 15) )
				{
					if(tecla == 8)
					{
						objeto.value = vr.substr(0, tam);
						window.event.cancelBubble = true;
						window.event.returnValue = false;
					}
					objeto.value = vr.substr( 0, tam - 12 ) + '.' + vr.substr( tam - 12, 3 ) + '.' + vr.substr( tam - 9, 3 ) + '.' + vr.substr( tam - 6, 3 ) + '.' + vr.substr( tam - 3, 3 ) ;
				}			
			}
		}
	}
	else if((window.event.keyCode != 8) && (window.event.keyCode != 9) && (window.event.keyCode != 13) && (window.event.keyCode != 35) && (window.event.keyCode != 36) && (window.event.keyCode != 46))
		{
			window.event.cancelBubble = true;
			window.event.returnValue = false;
		}
}	
function retirar(id)
{
	document.getElementById(id).value = document.getElementById(id).value.split(",").join("");
}