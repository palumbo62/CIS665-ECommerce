USE [Team115DB]
GO
/****** Object:  StoredProcedure [dbo].[spBogAddReservProf]    Script Date: 3/23/2019 9:27:05 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO


-- ==================================================================================
-- Filename:    spBogAddCommentsProf.sql
-- Author:		Team115
-- Create date: 03/05/2019
-- Description:	Stored procedure used to add a new property comment (review) to
-- the BOG database.
-- 
-- Constraint:  Checks to ensure dates are valid for the specified property.
-- ==================================================================================
CREATE OR ALTER             PROCEDURE [dbo].spBogAddCommentsProfByProfIdUserId
(
    @propId int = 0,
	@userId int = 0,
	@rating tinyint = 0,
	@mmyyVisit date = '',
	@comments nvarchar(500) =''
)
AS
BEGIN
    DECLARE @result int = -1;

	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    IF ((@propId > 0)
		AND (@userId > 0)
		AND ((@rating >= 1) AND (@rating <=5)))
        BEGIN
            INSERT INTO CommentsT 
                VALUES (@userId, @propId, @rating, GETDATE(), @mmyyVisit, @comments); 
--            INSERT INTO CommentsT (UserIdFK, PropertyIdFK, Rating, MonthYearVisit, CommentIdPK)
--                VALUES (@propId, @userId, @rating, @mmyyVisit, @comments); 
	
            -- Return the unique key for this new record
            SET @result = SCOPE_IDENTITY();
        END

    -- Return the result of this operation
    RETURN @result;
END
