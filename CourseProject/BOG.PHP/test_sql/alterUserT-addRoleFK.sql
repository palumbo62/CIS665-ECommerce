USE [Team115DB]
GO

ALTER TABLE [dbo].[UserT] DROP CONSTRAINT [DF_User.Account_User.State]
GO

/****** Object:  Table [dbo].[UserT]    Script Date: 3/10/2019 9:57:15 AM ******/
DROP TABLE [dbo].[UserT]
GO

/****** Object:  Table [dbo].[UserT]    Script Date: 3/10/2019 9:57:15 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[UserT](
	[UserID.PK] [int] IDENTITY(1,1) NOT NULL,
	[UserRole.FK] [int] NOT NULL,
	[Email] [nvarchar](50) NOT NULL,
	[Password] [nvarchar](20) NOT NULL,
	[FirstName] [nvarchar](30) NOT NULL,
	[LastName] [nvarchar](30) NOT NULL,
	[Address] [nvarchar](50) NOT NULL,
	[City] [nvarchar](30) NOT NULL,
	[State] [nchar](2) NOT NULL,
	[Zipcode] [int] NOT NULL,
	[PhoneNumber] [bigint] NOT NULL,
	[CCNumber] [bigint] NULL,
	[CCExpDate] [date] NULL,
	[CCCvc] [smallint] NULL,
 CONSTRAINT [PK_UserID] PRIMARY KEY CLUSTERED 
(
	[UserID.PK] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY],
 CONSTRAINT [UniqueEmailIdx] UNIQUE NONCLUSTERED 
(
	[Email] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[UserT] ADD  CONSTRAINT [DF_User.Account_User.State]  DEFAULT (N'UPPER') FOR [State]
GO


