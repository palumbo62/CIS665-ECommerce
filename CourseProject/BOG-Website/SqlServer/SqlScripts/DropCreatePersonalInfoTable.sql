USE [BOG]
GO

ALTER TABLE [dbo].[User.PersonalInfo] DROP CONSTRAINT [FK_User.PersonalInfo_User.Account]
GO

/****** Object:  Table [dbo].[User.PersonalInfo]    Script Date: 1/24/2019 9:09:16 AM ******/
DROP TABLE [dbo].[User.PersonalInfo]
GO

/****** Object:  Table [dbo].[User.PersonalInfo]    Script Date: 1/24/2019 9:09:16 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[User.PersonalInfo](
	[User.PersonalInfoID] [int] NOT NULL,
	[User.AccountID] [int] NOT NULL,
	[User.FirstName] [nchar](15) NOT NULL,
	[User.LastName] [nvarchar](30) NOT NULL,
	[User.Address] [nvarchar](50) NOT NULL,
	[User.City] [nvarchar](30) NOT NULL,
	[User.State] [nchar](2) NOT NULL,
	[User.ZipCode] [numeric](5, 0) NOT NULL,
	[User.PhoneNumber] [numeric](10, 0) NOT NULL,
 CONSTRAINT [PK_User.PersonalInfo] PRIMARY KEY CLUSTERED 
(
	[User.PersonalInfoID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

ALTER TABLE [dbo].[User.PersonalInfo]  WITH CHECK ADD  CONSTRAINT [FK_User.PersonalInfo_User.Account] FOREIGN KEY([User.AccountID])
REFERENCES [dbo].[User.Account] ([User.AccountID])
GO

ALTER TABLE [dbo].[User.PersonalInfo] CHECK CONSTRAINT [FK_User.PersonalInfo_User.Account]
GO


