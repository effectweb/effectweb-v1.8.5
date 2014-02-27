/*
//##############################################//
// -> Effect Web                                //
// -> Powered By: Erick-Master                  //
// -> CTM TeaM Softwares                        //
// -> www.ctmts.com.br                          //
//##############################################//
*/

declare @memb___id varchar(10);
declare c cursor for select memb___id FROM MEMB_INFO
open c
FETCH NEXT FROM c INTO @memb___id
WHILE @@FETCH_STATUS = 0
BEGIN 
	IF NOT EXISTS (SELECT 1 FROM CTM_TeaM.dbo.CTM_WebVIP WHERE Account=@memb___id)
		INSERT INTO CTM_TeaM.dbo.CTM_WebVIP (Account, VIP_Type, VIP_Begin, VIP_Time) VALUES (@memb___id, 0, '0','0')
 FETCH NEXT FROM c INTO @memb___id
END
CLOSE c
DEALLOCATE c