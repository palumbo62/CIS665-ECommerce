USE [Team115DB]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

-- ==================================================================================
-- Filename:    spBogAddProp.sql
-- Author:		Team115
-- Create date: 02/24/2019
-- Description:	Stored procedure used to add a new property to the BOG database.
-- 
-- Constraint:  Will only allow 1 property for the same address (i.e. no duplicates)
-- ==================================================================================
CREATE OR ALTER PROCEDURE [dbo].[spBogAddProp]
(
    @propertyType smallint = 1,
    @address nvarchar(30) = null,
    @city nvarchar(30) = null,
    @state nchar(2) = null,
    @zipcode numeric(5,0) = null,
    @dailyPrice smallmoney = 0,
    @numBedrooms smallint = 0,
    @numBathrooms smallint = 0,
    @sqft smallint = 0,
    @guestCnt smallint = 0
)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    SET @address = LTRIM(RTRIM(@address));
    SET @city = LTRIM(RTRIM(@city));
    SET @state = LTRIM(RTRIM(@state));

    -- Make sure parameters are valid
    IF ((@propertyType < 1 OR @propertyType > 3)
        OR (@address IS NULL)
        OR (@city IS NULL) 
        OR (@state IS NULL)
        OR (@zipcode <= 0) 
        OR (@dailyPrice < 0)
        OR (@numBedrooms < 0)
        OR (@numBathrooms < 0)
        OR (@sqft < 0) 
        OR (@guestCnt < 0))
        BEGIN   
            RETURN 1000;
        END

    -- Check for duplicates and return null if found
    SELECT 1 FROM [PROPERTY.TBL] P
        WHERE P.ADDRESS = @ADDRESS
            AND P.CITY = @CITY
            AND P.STATE = @STATE
            AND P.ZIPCODE = @ZIPCODE;

    -- Check if record was found
    IF (@@ROWCOUNT = 1)
        BEGIN
            -- Address already exists in the DB so return and error code
            RETURN 2000;
        END

    INSERT INTO [Property.Tbl]
        VALUES (@propertyType, @address, @city, @state, @zipcode, @dailyPrice, 
            @numBedrooms, @numBathrooms, @sqft, @guestCnt);

    -- Error check the insert
    IF (@@ERROR <> 0)
        BEGIN
            RETURN 2500;
        END    
   
   RETURN 0;
END
GO


