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
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Make sure parameters are valid
    IF (@propId < 0)
        BEGIN   
            RETURN 1000;
        END

    -- Check for duplicates and return null if found
    DELETE FROM [Property.Tbl]
        WHERE [PropertyID.PK] = @propId;
    
    -- Error check the insert
    IF (@@ERROR <> 0)
        BEGIN
            RETURN 2600;
        END    
   
   RETURN 0;
END
GO
