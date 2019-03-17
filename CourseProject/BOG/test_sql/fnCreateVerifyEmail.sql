USE [Team115DB]
GO

/****** Object:  UserDefinedFunction [dbo].[fnBogVerifyEmail]    Script Date: 3/4/2019 12:25:15 PM ******/
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
CREATE OR ALTER   FUNCTION [dbo].[fnBogVerifyEmail]
(
    @email nvarchar(50) = null
)
RETURNS int
WITH EXECUTE AS CALLER
AS
BEGIN
    DECLARE @result int = -1;

    --PRINT N'VerifyEmail: ' + @email;

	-- Add the T-SQL statements to compute the return value here
	IF EXISTS (SELECT * from [UserT] u
                    where u.Email = @email) 
    BEGIN 
        SET @result = 1;
    END;

	-- Return the result of the function
	RETURN @result;

END
GO


