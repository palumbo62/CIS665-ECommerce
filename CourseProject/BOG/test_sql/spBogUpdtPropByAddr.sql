USE [Team115DB]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

-- ==================================================================================
-- Filename:    spBogUpdtPropByAddr.sql
-- Author:		Team115
-- Create date: 02/24/2019
-- Description:	Stored procedure used to update a property from the BOG database by
--  specific property address.
-- 
-- ==================================================================================
CREATE OR ALTER PROCEDURE [dbo].[spBogUpdtPropById]
(
    @propId int = 0,
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
    IF ((@propId < 0)
        OR (@propertyType < 1 OR @propertyType > 3)
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
    UPDATE [dbo].[Property.Tbl]
       SET [PropertyTypeID.FK] = @propertyType
          ,[Address] = @address
          ,[City] = @city
          ,[State] = @state
          ,[Zipcode] = @zipcode
          ,[DailyPrice] = @dailyPrice
          ,[NumBedrooms] = @numBedrooms
          ,[NumBathrooms] = @numBathrooms
          ,[SqFt] = @sqft
          ,[GuestCnt] = @guestCnt
     WHERE 
        [Property.Tbl].[PropertyID.PK] = @propId;
    
    -- Error check the insert
    IF (@@ERROR <> 0)
        BEGIN
            RETURN 2700;
        END    
   
   RETURN 0;
END
GO
