USE [Team115DB]
GO

/****** Object:  StoredProcedure [dbo].[spBogAddPropProf]    Script Date: 2/28/2019 9:43:06 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO


-- ==================================================================================
-- Filename:    spBogAddPropProf.sql
-- Author:		Team115
-- Create date: 02/24/2019
-- Description:	Stored procedure used to add a new property to the BOG database.
-- 
-- Constraint:  Will only allow 1 property for the same address (i.e. no duplicates)
-- ==================================================================================
CREATE OR ALTER     PROCEDURE [dbo].[spBogAddPropProf]
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
    @guestCnt smallint = 0,
    @pic image = null
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
        OR ((ISNUMERIC(@zipcode) = 0) OR @zipcode <= 0) 
        OR ((ISNUMERIC(@dailyPrice) = 0) OR @dailyPrice < 0)
        OR ((ISNUMERIC(@numBedrooms) = 0) OR @numBedrooms < 0)
        OR ((ISNUMERIC(@numBathrooms) = 0) OR @numBathrooms < 0)
        OR ((ISNUMERIC(@sqft) = 0) OR @sqft < 0) 
        OR ((ISNUMERIC(@guestCnt) = 0) OR @guestCnt < 0))
        BEGIN   
            RETURN -1;
        END

    -- Check for duplicates and return null if found
    IF NOT EXISTS(SELECT * FROM [PropertyT] p
                    WHERE p.Address = @address
                        AND p.City = @city
                        AND p.State = @state
                        AND p.Zipcode = @zipcode)
        BEGIN
            -- Record does not exist so go ahead and insert it
            INSERT INTO [PropertyT]
                VALUES (@propertyType, @address, @city, @state, @zipcode, @dailyPrice, 
                @numBedrooms, @numBathrooms, @sqft, @guestCnt, @pic);

            -- Return the unique key for this new record
            RETURN SCOPE_IDENTITY();
        END
     ELSE
        BEGIN
            -- indicate an error since the property address already exists in the database
            RETURN -1;
        END
END
GO


