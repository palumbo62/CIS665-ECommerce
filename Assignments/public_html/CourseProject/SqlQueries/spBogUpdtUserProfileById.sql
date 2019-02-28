USE [Team115DB]
GO

SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

-- ==================================================================================
-- Filename:    spBogUpdtProfile.sql
-- Author:		Team115
-- Create date: 02/24/2019
-- Description:	Stored procedure used to update a user profile from the BOG database 
--  by user id.
-- 
-- ==================================================================================
CREATE OR ALTER PROCEDURE [dbo].[spBogUpdtUserProfileById]
(
    @userId int = 0,
    @email nvarchar(50) = null,
    @password nvarchar(20) = null,
    @firstName nvarchar(30) = null,
    @lastName nvarchar(20) = null,
    @address nvarchar(30) = null,
    @city nvarchar(30) = null,
    @state nchar(2) = null,
    @zipcode numeric(5,0) = 0,
    @phoneNumber numeric(10,0) = 0,
    @ccNumber numeric(15,0) = 0,
    @ccExpDate date = null,
    @ccCvc numeric(3,0) = 0
)
AS
BEGIN
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
    IF ((@userId < 0)
        OR (@email IS NULL)
        OR (@password IS NULL)
        OR (@firstName IS NULL)
        OR (@lastName IS NULL)
        OR (@address IS NULL)
        OR (@city IS NULL) 
        OR (@state IS NULL)
        OR (@zipcode < 0) 
        OR (@phoneNumber < 0)
        OR (@ccNumber < 0)
        OR (@ccExpDate IS NULL)
        OR (@ccCvc < 0))
        BEGIN   
            RETURN 1000;
        END

    -- Update the user profile
    UPDATE [dbo].[User.Tbl]
       SET [Email] = @email
          ,[Password] = @password
          ,[FirstName] = @firstName
          ,[LastName] = @lastName
          ,[Address] = @address
          ,[City] = @city
          ,[State] = @state
          ,[Zipcode] = @zipcode
          ,[PhoneNumber] = @phoneNumber
          ,[CC.Number] = @ccNumber
          ,[CC.ExpDate] = @ccExpDate
          ,[CC.Cvc] = @ccCvc
     WHERE 
        [User.Tbl].[UserID.PK] = @userId;

    -- Error check the insert
    IF (@@ERROR <> 0)
        BEGIN
            RETURN 2800;
        END    
   
   RETURN 0;
END
GO
