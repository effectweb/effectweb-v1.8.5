/*
//##############################################//
// -> Effect Web                                //
// -> Powered By: Erick-Master                  //
// -> CTM TeaM Softwares                        //
// -> www.ctmts.com.br                          //
//##############################################//
*/

/* DataBase do Web Site (Padrão -> CTM_TeaM) */
USE [CTM_TeaM]
GO

/***************************************
	@ Type 1 = Game Master
	@ Type 2 = Sub-Administrador
	@ Type 3 = Administrador
****************************************/

INSERT INTO dbo.CTM_WebStaff (account,name,type,contact) VALUES ('Conta','Nome_do_Char',Type,'Contato')
GO