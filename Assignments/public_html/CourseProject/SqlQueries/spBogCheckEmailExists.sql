USE [Team115DB]
GO
/****** Object:  StoredProcedure [dbo].[spBogDoLogin]    Script Date: 3/12/2019 9:35:32 AM ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
-- =============================================
-- Author:		Team115
-- Create date: 02/20/2019
-- Description:	Queries the datbase to see if
--  the specified email already exists
--
-- =============================================
CREATE OR ALTER     PROCEDURE [dbo].[spBogCheckEmailExists]
(
    @email nvarchar(50) = null
)
AS
BEGIN
	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	SELECT * from [UserT] u
        where u.Email = @email;

    RETURN @@ROWCOUNT;
END

