USE [Team115DB]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

-- ==================================================================================
-- Filename:    spBogAddUserProf.sql
-- Author:		Team115
-- Create date: 02/24/2019
-- Description:	Stored procedure used to add a user profile to the BOG database.
--
-- ==================================================================================
CREATE OR ALTER PROCEDURE [dbo].[spBogAddUserProf]
(
    @email nvarchar(50),
    @password nvarchar(20),
    @firstName nvarchar(30),
    @lastName nvarchar(20),
    @address nvarchar(30),
    @city nvarchar(30),
    @state nchar(2),
    @zipcode numeric(5,0),
    @phoneNumber numeric(10,0),
    @ccNumber numeric(15,0) = 0,
    @ccExpDate date = NULL,
    @ccCvc numeric(3,0) = 0
)
AS
BEGIN
    DECLARE @result int = -1;

    -- SET NOCOUNT ON added to prevent extra result sets from
    -- interfering with SELECT statements.
    SET NOCOUNT ON;

    SET @email = LTRIM(RTRIM(@email));
    SET @password = LTRIM(RTRIM(@password));
    SET @firstName = LTRIM(RTRIM(@firstName));
    SET @lastName = LTRIM(RTRIM(@lastName));
    SET @city = LTRIM(RTRIM(@city));
    SET @state = LTRIM(RTRIM(@state));
    
    -- Make sure parameters are valid
    IF ((@email IS NOT NULL)
        AND (@password IS NOT NULL)
        AND (@firstName IS NOT NULL)
        AND (@lastName IS NOT NULL)
        AND (@address IS NOT NULL)
        AND (@city IS NOT NULL) 
        AND (@state IS NOT NULL)
        AND (@zipcode > 0) 
        AND (@phoneNumber > 0))
        BEGIN   
            -- Update the user profile
            INSERT INTO [dbo].[UserT] 
                VALUES (@email
                    ,@password
                    ,@firstName
                    ,@lastName
                    ,@address
                    ,@city
                    ,@state
                    ,@zipcode
                    ,@phoneNumber
                    ,@ccNumber
                    ,@ccExpDate
                    ,@ccCvc
                    );

            SET @result = SCOPE_IDENTITY();
        END
 
    -- Return the results
    RETURN @result;
END
GO
