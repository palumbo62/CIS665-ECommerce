USE [Team115DB]
GO

/****** Object:  StoredProcedure [dbo].[spBogGetReservProfById]    Script Date: 2/28/2019 3:30:05 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

-- =============================================
-- Author:		<Author,,Name>
-- Create date: <Create Date,,>
-- Description:	<Description,,>
-- =============================================
CREATE OR ALTER    PROCEDURE [dbo].[spBogGetReservProfByPropId] 
(
	-- Add the parameters for the stored procedure here
    @propId int = 0 
)
AS
BEGIN
    DECLARE @result int = 0;

	-- SET NOCOUNT ON added to prevent extra result sets from
	-- interfering with SELECT statements.
	SET NOCOUNT ON;

    -- Insert statements for procedure here
	SELECT u.LastName, u.FirstName, p.Address, p.City, p.State, p.Zipcode, r.CheckIn, r.CheckOut, r.TotalPayment, r.GuestCnt
	FROM ReservationT r
        INNER JOIN PropertyT p
            ON p.[PropertyID.PK] = r.[PropertyID.FK] 
		INNER JOIN UserT u
			ON r.[UserID.FK] = u.[UserID.PK] 
    WHERE p.[PropertyID.PK] = @propId;

    IF (@@ROWCOUNT != 1)
        BEGIN
            SET @result = -1;
        END

    RETURN @result;
END
GO


