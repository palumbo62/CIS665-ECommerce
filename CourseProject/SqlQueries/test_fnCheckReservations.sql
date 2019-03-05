USE Team115DB
GO

DECLARE @result int = -1;

SET @result = [dbo].[fnBogCheckReservationDates](31, GETDATE(), GETDATE() + 1);
PRINT  N'CurrDate, CurrDate + 1::RESULT:' + STR(@result);

SET @result = [dbo].[fnBogCheckReservationDates](31, GETDATE(), GETDATE() + 12);
PRINT  N'CurrDate, CurrDate + 12::RESULT:' + STR(@result);

SET @result = [dbo].[fnBogCheckReservationDates](31, GETDATE() + 30, GETDATE() + 37);
PRINT  N'CurrDate + 30, CurrDate + 37::RESULT:' + STR(@result);

SET @result = [dbo].[fnBogCheckReservationDates](31, GETDATE(), GETDATE());
PRINT  N'CurrDate, CurrDate::RESULT:' + STR(@result);

SET @result = [dbo].[fnBogCheckReservationDates](31, GETDATE() - 1, GETDATE());
PRINT  N'CurrDate - 1, CurrDate::RESULT:' + STR(@result);

SET @result = [dbo].[fnBogCheckReservationDates](31, GETDATE() + 7, GETDATE() + 5);
PRINT  N'CurrDate + 7, CurrDate + 5::RESULT:' + STR(@result);

SET @result = [dbo].[fnBogCheckReservationDates](31, GETDATE(), GETDATE() + 1);
PRINT  N'CurrDate, CurrDate + 1::RESULT:' + STR(@result);

