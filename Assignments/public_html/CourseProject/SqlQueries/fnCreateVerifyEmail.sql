-- ================================================
-- Template generated from Template Explorer using:
-- Create Scalar Function (New Menu).SQL
--
-- Use the Specify Values for Template Parameters 
-- command (Ctrl-Shift-M) to fill in the parameter 
-- values below.
--
-- This block of comments will not be included in
-- the definition of the function.
-- ================================================
USE Team115DB
GO

SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Team115
-- Create date: 02/20/2019
-- Description: verifies pre-existence of the
--  specified email address. To be used for
--  registering a new user
--
-- =============================================
CREATE OR ALTER FUNCTION dbo.fnBogVerifyEmail
(
    @email nvarchar(50) = null
)
RETURNS int
--WITH EXECUTE AS CALLER
AS
BEGIN
    DECLARE @result int = -1;

	-- Add the T-SQL statements to compute the return value here
	IF EXISTS (SELECT * from [User.Tbl] u
                    where u.Email = @email) 
    BEGIN 
        SET @result = 1;
    END;

	-- Return the result of the function
	RETURN @result;
END

