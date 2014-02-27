/*
//##############################################//
// -> Effect Web                                //
// -> Powered by Erick-Master                   //
// -> CTM TEAM Softwares                        //
// -> www.ctmts.com.br                          //
//##############################################//
*/

USE [master]
GO
sp_addextendedproc 'XP_MD5_EncodeKeyVal', 'WZ_MD5_MOD.dll'
GO
sp_addextendedproc 'XP_MD5_CheckValue', 'WZ_MD5_MOD.dll'
GO

/* Os dados do Site serão Armazenados nessa DataBase */
CREATE DATABASE [CTM_TeaM]
GO

USE [CTM_TeaM]
GO

CREATE TABLE [dbo].[CTM_WebAccBan] (
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Responsible] [varchar] (50) COLLATE Latin1_General_CI_AS NULL ,
	[Reason] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Time] [int] NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebChangeMail] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Mail] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[HashCode] [varbinary] (1000) NOT NULL ,
	[Expiration] [int] NOT NULL ,
	[Status] [varbinary] (6) NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebCharBan] (
	[Character] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Responsible] [varchar] (50) COLLATE Latin1_General_CI_AS NULL ,
	[Reason] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Time] [int] NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebCronJob] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[CronTab] [int] NOT NULL ,
	[Cron_Time] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Cron_Next] [int] NOT NULL ,
	[Coin] [int] NOT NULL ,
	[Number] [int] NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebFiles] (
	[id] [int] IDENTITY (1, 1) NOT NULL ,
	[name] [varchar] (50) COLLATE Latin1_General_CI_AS NULL ,
	[link] [varchar] (300) COLLATE Latin1_General_CI_AS NULL ,
	[description] [varchar] (50) COLLATE Latin1_General_CI_AS NULL ,
	[file_size] [varchar] (50) COLLATE Latin1_General_CI_AS NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebNews] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Title] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Date] [int] NOT NULL ,
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Text] [text] COLLATE Latin1_General_CI_AS NOT NULL ,
	[Comment] [int] NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebNewsComments] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[NoticeID] [int] NOT NULL ,
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[User_Char] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Comment_Date] [int] NOT NULL ,
	[Text] [text] COLLATE Latin1_General_CI_AS NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebPaymentRes] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Date] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Character] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[PaymentID] [int] NOT NULL ,
	[Text] [text] COLLATE Latin1_General_CI_AS NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebPayments] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Character] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Status] [int] NOT NULL ,
	[Time] [int] NOT NULL ,
	[Golds] [int] NOT NULL ,
	[Price] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Date] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Bank] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Payment] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Master] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Document] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Text] [text] COLLATE Latin1_General_CI_AS NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebPoll] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Question] [varchar] (100) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Time_] [int] NOT NULL ,
	[Expiration] [int] NOT NULL ,
	[Status] [varbinary] (6) NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebPollAnswers] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Poll_ID] [int] NOT NULL ,
	[Answer] [varchar] (100) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Votes] [int] NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebPollVotes] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Poll_ID] [int] NOT NULL ,
	[Expiration] [int] NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebProfile] (
	[Character] [varchar] (50) COLLATE Latin1_General_CI_AS NULL ,
	[Status] [int] NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebRaffles] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[MuCharacter] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Coin] [int] NOT NULL ,
	[Award] [int] NOT NULL ,
	[Raffle_Date] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Raffle_Time] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebRecord] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Record] [int] NOT NULL ,
	[Data] [int] NOT NULL ,
	[Type] [int] NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebRecovery] (
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Mail] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[HashCode] [varbinary] (2000) NOT NULL ,
	[Time_] [int] NOT NULL ,
	[Expiration] [int] NOT NULL ,
	[Status] [varbinary] (6) NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebReference] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[AccessCount] [int] NOT NULL ,
	[RegisterCount] [int] NOT NULL ,
	[Points] [int] NOT NULL ,
	[EventCurrentResult] [int] NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebReferenceData] (
	[Reference] [int] NOT NULL ,
	[RefLogin] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[IPAddress] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebRegister] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Temp_Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[HashCode] [varbinary] (1000) NOT NULL ,
	[Status] [varbinary] (50) NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebScreenComments] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[ScreenID] [int] NOT NULL ,
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[User_Char] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Comment_Date] [int] NOT NULL ,
	[Text] [text] COLLATE Latin1_General_CI_AS NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebScreenShots] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[User_Char] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Votes] [int] NOT NULL ,
	[Up_Date] [int] NOT NULL ,
	[Description] [text] COLLATE Latin1_General_CI_AS NOT NULL ,
	[ScreenShot] [varchar] (1000) COLLATE Latin1_General_CI_AS NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebScreenVotes] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Vote] [int] NOT NULL ,
	[ScreenID] [int] NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebStaff] (
	[id] [int] IDENTITY (1, 1) NOT NULL ,
	[account] [varchar] (50) COLLATE Latin1_General_CI_AS NULL ,
	[name] [varchar] (50) COLLATE Latin1_General_CI_AS NULL ,
	[type] [int] NOT NULL ,
	[contact] [varchar] (50) COLLATE Latin1_General_CI_AS NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebTicketRes] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Date] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Character] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[TicketID] [int] NOT NULL ,
	[Text] [text] COLLATE Latin1_General_CI_AS NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebTickets] (
	[Id] [int] IDENTITY (1, 1) NOT NULL ,
	[Protocol] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Title] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Subject] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Date] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Status] [int] NOT NULL ,
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Character] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Text] [text] COLLATE Latin1_General_CI_AS NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebVIP] (
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[VIP_Type] [int] NOT NULL ,
	[VIP_Begin] [int] NOT NULL ,
	[VIP_Time] [int] NOT NULL ,
	[VIP_Credits] [int] NOT NULL 
) ON [PRIMARY]
GO

CREATE TABLE [dbo].[CTM_WebWarning] (
	[Date] [int] NOT NULL ,
	[Account] [varchar] (50) COLLATE Latin1_General_CI_AS NOT NULL ,
	[Text] [text] COLLATE Latin1_General_CI_AS NOT NULL 
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO

ALTER TABLE [dbo].[CTM_WebCronJob] ADD 
	CONSTRAINT [DF_CTM_WebCronJob_Cron_Next] DEFAULT (0) FOR [Cron_Next],
	CONSTRAINT [DF_CTM_WebCronJob_Coin] DEFAULT (1) FOR [Coin],
	CONSTRAINT [DF_CTM_WebCronJob_Number] DEFAULT (0) FOR [Number]
GO

ALTER TABLE [dbo].[CTM_WebNews] ADD 
	CONSTRAINT [DF_CTM_WebNews_Comment] DEFAULT (1) FOR [Comment]
GO

ALTER TABLE [dbo].[CTM_WebProfile] ADD 
	CONSTRAINT [DF_CTM_WebProfile_Status] DEFAULT (1) FOR [Status]
GO

ALTER TABLE [dbo].[CTM_WebRaffles] ADD 
	CONSTRAINT [DF_CTM_WebRaffles_Coin] DEFAULT (1) FOR [Coin]
GO

ALTER TABLE [dbo].[CTM_WebRecord] ADD 
	CONSTRAINT [DF_CTM_WebRecord_record] DEFAULT (0) FOR [Record],
	CONSTRAINT [DF_CTM_WebRecord_Type] DEFAULT (1) FOR [Type]
GO

ALTER TABLE [dbo].[CTM_WebReference] ADD 
	CONSTRAINT [DF_CTM_MuReference_LinkCount] DEFAULT (0) FOR [AccessCount],
	CONSTRAINT [DF_CTM_MuReference_RegisterCount] DEFAULT (0) FOR [RegisterCount],
	CONSTRAINT [DF_CTM_MuReference_Points] DEFAULT (0) FOR [Points],
	CONSTRAINT [DF_CTM_MuReference_EventCurrentResult] DEFAULT (0) FOR [EventCurrentResult]
GO

ALTER TABLE [dbo].[CTM_WebScreenShots] ADD 
	CONSTRAINT [DF_CTM_WebScreenShots_Votes] DEFAULT (0) FOR [Votes],
	CONSTRAINT [DF_CTM_WebScreenShots_Description] DEFAULT (null) FOR [Description]
GO

ALTER TABLE [dbo].[CTM_WebScreenVotes] ADD 
	CONSTRAINT [DF_CTM_WebScreenVotes_Votes] DEFAULT (0) FOR [Vote]
GO

ALTER TABLE [dbo].[CTM_WebStaff] ADD 
	CONSTRAINT [DF_CTM_WebStaff_type] DEFAULT (0) FOR [type]
GO

ALTER TABLE [dbo].[CTM_WebVIP] ADD 
	CONSTRAINT [DF_CTM_WebVIP_VIP_Type] DEFAULT (0) FOR [VIP_Type],
	CONSTRAINT [DF_CTM_WebVIP_VIP_Begin] DEFAULT (0) FOR [VIP_Begin],
	CONSTRAINT [DF_CTM_WebVIP_VIP_Time] DEFAULT (0) FOR [VIP_Time],
	CONSTRAINT [DF_CTM_WebVIP_VIP_Credits] DEFAULT (0) FOR [VIP_Credits]
GO