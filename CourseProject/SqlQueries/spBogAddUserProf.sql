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
    DECLARE @result int = 0;

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
    IF ((@email IS NULL)
        OR (@password IS NULL)
        OR (@firstName IS NULL)
        OR (@lastName IS NULL)
        OR (@address IS NULL)
        OR (@city IS NULL) 
        OR (@state IS NULL)
        OR (@zipcode < 0) 
        OR (@phoneNumber < 0))
        BEGIN   
            RETURN -1;
        END

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
 
    -- Error check the insert
    IF (@@ERROR <> 0)
        BEGIN
            RETURN -1;
        END    
   
    RETURN SCOPE_IDENTITY();
END
GO
