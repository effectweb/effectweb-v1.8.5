/*
//##############################################//
// -> Effect Web                                //
// -> Powered By: Erick-Master                  //
// -> CTM TeaM Softwares                        //
// -> www.ctmts.com.br                          //
//##############################################//
*/

/* DataBase do Servidor (Padrão -> MuOnline) */
USE [MuOnline]
GO

/******************************************************
	@ Size: 1200 (Versões abaixo de 1.02N)
	@ Size: 1920 (Versões 1.02N ou Superior)
	@ Size: 3480 (Versães Season 6 EP2 ou EP3)
	@ Aletere "Size" para o número de sua Versão
*******************************************************/

ALTER TABLE dbo.warehouse ADD CTM_Vault varbinary(Size) NULL
GO