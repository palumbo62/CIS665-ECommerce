USE [BOG]
GO

--ALTER TABLE [dbo].[User.Account] DROP CONSTRAINT [DF_User.Account_User.State]
--GO

/****** Object:  Table [dbo].[User.Account]    Script Date: 2/14/2019 3:13:10 PM ******/
DROP TABLE [dbo].[User.Account]
GO

/****** Object:  Table [dbo].[User.Account]    Script Date: 2/14/2019 3:13:10 PM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[User.Account](
	[User.AccountID] [int] NOT NULL,
	[User.Email] [nvarchar](50) NOT NULL,
	[User.Password] [nvarchar](20) NOT NULL,
	[User.FirstName] [nvarchar](30) NOT NULL,
	[User.LastName] [nvarchar](30) NOT NULL,
	[User.City] [nvarchar](30) NOT NULL,
	[User.State] [nchar](2) NOT NULL,
	[User.ZipCode] [numeric](5, 0) NOT NULL,
	[User.PhoneNumber] [numeric](10, 0) NOT NULL,
 CONSTRAINT [PK_User.Account] PRIMARY KEY CLUSTERED 
(
	[User.AccountID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

