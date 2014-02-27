/*
 Rodar esta query somente se os rankings não exibirem todos os personagens
*/

UPDATE [MuOnline].[dbo].[Character] SET [CtlCode] = 0
GO

ALTER TABLE [MuOnline].[dbo].[Character] ALTER COLUMN [CtlCode] tinyint NOT NULL
GO

ALTER TABLE [MuOnline].[dbo].[Character] ADD CONSTRAINT [DF_Character_CtlCode] DEFAULT (0) FOR [CtlCode]
GO
