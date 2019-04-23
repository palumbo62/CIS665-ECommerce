USE [BOG]
GO

EXEC sys.sp_dropextendedproperty @name=N'MS_Description' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Rental.Property', @level2type=N'COLUMN',@level2name=N'Rental.PropertyType'

GO

/****** Object:  Table [dbo].[Rental.Property]    Script Date: 1/24/2019 10:03:49 AM ******/
DROP TABLE [dbo].[Rental.Property]
GO

/****** Object:  Table [dbo].[Rental.Property]    Script Date: 1/24/2019 10:03:49 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Rental.Property](
	[Rental.PropertyID] [int] NOT NULL,
    [User.AccountID] [int] NOT NULL,
	[Rental.PropertyType] [smallint] NOT NULL,
	[Rental.DailyPrice] [smallmoney] NOT NULL,
	[Rental.NumBedroom] [smallint] NOT NULL,
	[Rental.NumBathrooms] [smallint] NOT NULL,
	[Rental.SqFt] [smallint] NOT NULL,
	[Rental.SleepCnt] [smallint] NOT NULL,
 CONSTRAINT [PK_Rental.Property] PRIMARY KEY CLUSTERED 
(
	[Rental.PropertyID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]

GO

EXEC sys.sp_addextendedproperty @name=N'MS_Description', @value=N'Home = 0, Condo = 1, Apartment = 2, Cabin = 3' , @level0type=N'SCHEMA',@level0name=N'dbo', @level1type=N'TABLE',@level1name=N'Rental.Property', @level2type=N'COLUMN',@level2name=N'Rental.PropertyType'
GO


