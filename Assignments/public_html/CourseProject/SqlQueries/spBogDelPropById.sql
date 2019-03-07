USE [Team115DB]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

-- ==================================================================================
-- Filename:    spBogDelPropById.sql
-- Author:		Team115
-- Create date: 02/24/2019
-- Description:	Stored procedure used to delete a property from the BOG database by
--  property ID.
-- 
-- ==================================================================================
CREATE OR ALTER PROCEDURE [dbo].[spBogDelPropById]
(
    @propId int
)
AS
BEGIN
    DECLARE @result int =-1;

	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Make sure parameters are valid
    IF (@propId > 0)
        BEGIN   
            -- Check for duplicates and return null if found
            DELETE FROM [PropertyT]
                WHERE [PropertyID.PK] = @propId;
            
            SET @result = @@ERROR;
        END
    
    RETURN @result;
END
GO

