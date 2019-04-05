USE Team115DB
GO

DECLARE @result int = -1;


SET @result = [dbo].[fnBogVerifyEmail]('robert@gmail.com');
PRINT  N'robert-RESULT:' + STR(@result);

SET @result = [dbo].[fnBogVerifyEmail]('admin@bogg.com');
PRINT  N'admin-RESULT:' + STR(@result);

SET @result = [dbo].[fnBogVerifyEmail]('foo@gmail.com');
PRINT  N'foo-RESULT:' + STR(@result);

SET @result = dbo.fnBogVerifyEmail('kiana@gmail.com');
PRINT  N'kiana-RESULT:' + STR(@result);
