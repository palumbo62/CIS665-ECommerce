USE [BOG]
GO

UPDATE [dbo].[User.PersonalInfo]
   SET [User.PersonalInfoID] = <User.PersonalInfoID, int,>
      ,[User.AccountID] = <User.AccountID, int,>
      ,[User.FirstName] = <User.FirstName, nchar(15),>
      ,[User.LastName] = <User.LastName, nvarchar(30),>
      ,[User.Address] = <User.Address, nvarchar(50),>
      ,[User.City] = <User.City, nvarchar(30),>
      ,[User.State] = <User.State, nchar(2),>
      ,[User.ZipCode] = <User.ZipCode, numeric(5,0),>
      ,[User.PhoneNumber] = <User.PhoneNumber, numeric(10,0),>
 WHERE <Search Conditions,,>
GO


