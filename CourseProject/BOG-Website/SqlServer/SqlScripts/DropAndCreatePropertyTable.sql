USE [BOG]
GO

ALTER TABLE [dbo].[Property.Tbl] DROP CONSTRAINT [FK_Property.Tbl_User.Tbl]
GO

ALTER TABLE [dbo].[Property.Tbl] DROP CONSTRAINT [FK_Property.Tbl_PropertyType.Tbl]
GO

/****** Object:  Table [dbo].[Property.Tbl]    Script Date: 2/15/2019 10:56:34 AM ******/
DROP TABLE [dbo].[Property.Tbl]
GO

/****** Object:  Table [dbo].[Property.Tbl]    Script Date: 2/15/2019 10:56:34 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Property.Tbl](
	[PropertyID.PK] [int] IDENTITY(1,1) NOT NULL,
	[PropertyTypeID.FK] [int] NOT NULL,
	[UserID.FK] [int] NOT NULL,
	[Address] [nvarchar](30) NOT NULL,
	[City] [nvarchar](30) NOT NULL,
	[State] [nchar](2) NOT NULL,
	[Zipcode] [numeric](5, 0) NOT NULL,
	[DailyPrice] [smallmoney] NOT NULL,
	[NumBedrooms] [smallint] NOT NULL,
	[NumBathrooms] [smallint] NOT NULL,
	[SqFt] [smallint] NULL,
	[GuestCnt] [smallint] NULL,
 CONSTRAINT [PK_Rental.Property] PRIMARY KEY CLUSTERED 
(
	[PropertyID.PK] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[Property.Tbl]  WITH CHECK ADD  CONSTRAINT [FK_Property.Tbl_PropertyType.Tbl] FOREIGN KEY([PropertyTypeID.FK])
REFERENCES [dbo].[PropertyType.Tbl] ([PropertyTypeID.PK])
GO

ALTER TABLE [dbo].[Property.Tbl] CHECK CONSTRAINT [FK_Property.Tbl_PropertyType.Tbl]
GO

ALTER TABLE [dbo].[Property.Tbl]  WITH CHECK ADD  CONSTRAINT [FK_Property.Tbl_User.Tbl] FOREIGN KEY([UserID.FK])
REFERENCES [dbo].[User.Tbl] ([UserID.PK])
GO

ALTER TABLE [dbo].[Property.Tbl] CHECK CONSTRAINT [FK_Property.Tbl_User.Tbl]
GO


