USE [CTM_TeaM]
GO

if exists (select * from dbo.sysobjects where id = object_id(N'[dbo].[CTM_CreateCharacter]') and OBJECTPROPERTY(id, N'IsProcedure') = 1)
drop procedure [dbo].[CTM_CreateCharacter]
GO

SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS ON 
GO

-----------------------------------------------------------
-- Effect Web MuOnline
-- CTM_CreateCharacter
-- Release 30/06/2011
-- Powered by Erick-Master
-- Base in WZ_CreateCharacter
-----------------------------------------------------------

CREATE  Procedure CTM_CreateCharacter 
	@AccountID		varchar(10),	-- // Account Character
	@Name			varchar(10),	-- // Name Character
	@Class			tinyint,	-- // Class Character
	@Level			int,		-- // Level Character
	@Points			int,		-- // Points Character
	@Strength		int,		-- // Strength Character
	@Dexterity		int,		-- // Dexterity Character
	@Vitality		int,		-- // Vitality Character
	@Energy			int,		-- // Energy Character
	@Money			int,		-- // Money Character
	@CtlCode		int,		-- // CtlCode Character
	@Version		int		-- // Mu Version [Old=0] [New=1]
AS
Begin

	SET NOCOUNT ON
	SET	XACT_ABORT ON
	DECLARE		@Result		tinyint

	/***********************************************************************
	//	@ Check Name Exists
	***********************************************************************/
	If EXISTS ( SELECT  Name  FROM  MuOnline.dbo.Character WHERE Name = @Name )
	begin
		SET @Result	= 0x01		-- // Error Binarry
		GOTO ProcEnd						
	end 

	BEGIN TRAN
	/***********************************************************************
	//	@ Procedure AccountCharacter
	***********************************************************************/
	If NOT EXISTS ( SELECT  Id  FROM  MuOnline.dbo.AccountCharacter WHERE Id = @AccountID )
		begin
			INSERT INTO MuOnline.dbo.AccountCharacter(Id, GameID1, GameID2, GameID3, GameID4, GameID5, GameIDC) 
			VALUES(@AccountID, @Name, NULL, NULL, NULL, NULL, NULL)

			SET @Result  = @@Error
		end 
	else
		begin
			-- // Select Game ID From AccountID
			Declare @GameID1 varchar(10), @GameID2 varchar(10), @GameID3 varchar(10), @GameID4 varchar(10), @GameID5 varchar(10)						
			SELECT @GameID1=GameID1, @GameID2=GameID2, @GameID3=GameID3, @GameID4=GameID4, @GameID5=GameID5 FROM MuOnline.dbo.AccountCharacter WHERE Id = @AccountID 			

			if( ( @GameID1 Is NULL) OR (Len(@GameID1) = 0))
				begin
					UPDATE MuOnline.dbo.AccountCharacter SET  GameID1 = @Name
					WHERE Id = @AccountID
										
					SET @Result  = @@Error
				end 
			else	 if( @GameID2  Is NULL OR Len(@GameID2) = 0)
				begin
					UPDATE MuOnline.dbo.AccountCharacter SET  GameID2 = @Name
					WHERE Id = @AccountID

					SET @Result  = @@Error
				end 
			else	 if( @GameID3  Is NULL OR Len(@GameID3) = 0)
				begin			
					UPDATE MuOnline.dbo.AccountCharacter SET  GameID3 = @Name
					WHERE Id = @AccountID

					SET @Result  = @@Error
				end 
			else	 if( @GameID4 Is NULL OR Len(@GameID4) = 0)
				begin
					UPDATE MuOnline.dbo.AccountCharacter SET  GameID4 = @Name
					WHERE Id = @AccountID

					SET @Result  = @@Error
				end 
			else	 if( @GameID5 Is NULL OR Len(@GameID5) = 0)
				begin
					UPDATE MuOnline.dbo.AccountCharacter SET  GameID5 = @Name
					WHERE Id = @AccountID

					SET @Result  = @@Error
				end 		
			else 
				begin					
					SET @Result	= 0x03	-- // Error Binarry						
					GOTO TranProcEnd								
				end 			 
		end 

	
	/***********************************************************************
	//	@ Procedure Mu Version
	***********************************************************************/
	DECLARE @DbVersion int;

	if(@Version = 0)
	BEGIN
		SET @DbVersion = 1;
	END
	else
	BEGIN
		SET @DbVersion = 3;
	END

	/***********************************************************************
	//	@ Procedure Character Class
	***********************************************************************/
	DECLARE @MapNumber int;
	DECLARE @MapPosX int;
	DECLARE @MapPosY int;
	
	if(@Class = 32 or @Class = 33 or @Class = 34 or @Class = 35)
	BEGIN
		SET @MapNumber = 3;
		SET @MapPosY = 174;
		SET @MapPosY = 111;
	END
	else
	BEGIN
		SET @MapNumber = 0;
		SET @MapPosY = 125;
		SET @MapPosY = 125;
	END

	/***********************************************************************
	//	@ Procedure Character
	***********************************************************************/
	if( @Result <> 0 )
		begin
			GOTO TranProcEnd		
		end 
	else
		begin
			INSERT INTO MuOnline.dbo.Character(AccountID, Name, cLevel, LevelUpPoint, Class, Strength, Dexterity, Vitality, Energy, Inventory,MagicList, 
					Life, MaxLife, Mana, MaxMana, MapNumber, MapPosX, MapPosY,  MDate, LDate, Quest, DbVersion, Money, CtlCode ) VALUES
				
			(@AccountID,@Name,@Level,@Points,@Class,@Strength,@Dexterity,@Vitality,@Energy,NULL,NULL,
			'80.0','80.0','30.0','30.0',@MapNumber,@MapPosX,@MapPosY,getdate(),getdate(),NULL,@DbVersion,@Money,@CtlCode)

			SET @Result  = @@Error
		end 

TranProcEnd:	-- GOTO
	IF ( @Result  <> 0 )
		ROLLBACK TRAN
	ELSE
		COMMIT	TRAN

ProcEnd:
	SET NOCOUNT OFF
	SET	XACT_ABORT OFF

	/***********************************************************************
	//	@ Finish Procedure
	***********************************************************************/
	SELECT
	   CASE @Result
	      WHEN 0x00 THEN 0x01		-- // Character Exists
	      WHEN 0x01 THEN 0x00		-- // Success
	      WHEN 0x03 THEN 0x03		-- // GameID Not Empty
	      ELSE 0x02
	   END AS Result 
End
GO
SET QUOTED_IDENTIFIER OFF 
GO
SET ANSI_NULLS ON 
GO

