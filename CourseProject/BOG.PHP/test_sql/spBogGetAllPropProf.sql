USE [Team115DB]
GO

/****** Object:  StoredProcedure [dbo].[spBogGetPropProfById]    Script Date: 2/28/2019 3:30:05 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE OR ALTER    PROCEDURE [dbo].[spBogGetAllPropProf] 
AS
BEGIN
    DECLARE @result int = 0;

	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	SELECT p.*, pt.PropertyTypeName FROM PropertyT p
        INNER JOIN PropertyTypeT pt
            ON p.[PropertyTypeID.FK] = pt.[PropertyTypeID.PK] ;
   
    RETURN @result;
END
GO


