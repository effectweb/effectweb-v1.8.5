/*
//##############################################//
// -> Effect Web                                //
// -> Powered by Erick-Master                   //
// -> CTM TEAM Softwares                        //
// -> www.ctmts.com.br                          //
//##############################################//
*/

USE [MuOnline]
GO

------------- Table: MEMB_INFO -------------
ALTER TABLE dbo.MEMB_INFO ADD Gold int NOT NULL DEFAULT 0 
GO

ALTER TABLE dbo.MEMB_INFO ADD Cash int NOT NULL DEFAULT 0 
GO

ALTER TABLE dbo.MEMB_INFO ADD Points int NOT NULL DEFAULT 0 
GO

ALTER TABLE dbo.MEMB_INFO ADD CTM_Date varchar(50) NULL
GO

ALTER TABLE dbo.MEMB_INFO ADD CTM_Birth varchar(50) NULL
GO

ALTER TABLE dbo.MEMB_INFO ADD CTM_Sex varchar(50) NULL
GO

ALTER TABLE dbo.MEMB_INFO ADD vip int NOT NULL DEFAULT 0 
GO

ALTER TABLE dbo.MEMB_INFO ADD VIP_Time int NOT NULL DEFAULT 0 
GO

ALTER TABLE dbo.MEMB_INFO ADD VIP_Begin int NOT NULL DEFAULT 0 
GO

ALTER TABLE dbo.MEMB_INFO ADD VIP_Integer int NOT NULL DEFAULT 0 
GO

------------- Table: Character -------------
ALTER TABLE dbo.Character ADD CTM_Image varchar(50) NULL
GO

ALTER TABLE dbo.Character ADD Resets int NOT NULL DEFAULT 0 
GO

ALTER TABLE dbo.Character ADD resetsDay int NOT NULL DEFAULT 0 
GO

ALTER TABLE dbo.Character ADD resetsWeek int NOT NULL DEFAULT 0 
GO

ALTER TABLE dbo.Character ADD resetsMonth int NOT NULL DEFAULT 0 
GO

ALTER TABLE dbo.Character ADD MResets int NOT NULL DEFAULT 0 
GO

ALTER TABLE dbo.Character ADD PkCountWeb int NOT NULL DEFAULT 0 
GO

ALTER TABLE dbo.Character ADD HeroCountWeb int NOT NULL DEFAULT 0 
GO