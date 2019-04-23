USE [BOG]
GO

ALTER TABLE [dbo].[Active.Rentals] DROP CONSTRAINT [FK_Active.Rentals_Renter.Account1]
GO

ALTER TABLE [dbo].[Active.Rentals] DROP CONSTRAINT [FK_Active.Rentals_Owner.Account]
GO

/****** Object:  Table [dbo].[Active.Rentals]    Script Date: 1/28/2019 8:32:01 AM ******/
DROP TABLE [dbo].[Active.Rentals]
GO

/****** Object:  Table [dbo].[Active.Rentals]    Script Date: 1/28/2019 8:32:01 AM ******/
SET ANSI_NULLS ON
GO

SET QUOTED_IDENTIFIER ON
GO

CREATE TABLE [dbo].[Active.Rentals](
	[Active.RentalID] [int] NOT NULL,
	[Owner.AccountID] [int] NOT NULL,
	[Renter.AccountID] [int] NOT NULL,
	[Active.Rental.CheckIn] [date] NOT NULL,
	[Active.Rental.CheckOut] [date] NOT NULL,
	[Active.Rental.TotalPayment] [money] NOT NULL,
	[Active.Rental.GuestCnt] [smallint] NULL,
 CONSTRAINT [PK_Active.Rentals] PRIMARY KEY CLUSTERED 
(
	[Active.RentalID] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON) ON [PRIMARY]
) ON [PRIMARY]
GO

ALTER TABLE [dbo].[Active.Rentals]  WITH CHECK ADD  CONSTRAINT [FK_Active.Rentals_Owner.Account] FOREIGN KEY([Owner.AccountID])
REFERENCES [dbo].[User.Account] ([User.AccountID])
GO

ALTER TABLE [dbo].[Active.Rentals] CHECK CONSTRAINT [FK_Active.Rentals_Owner.Account]
GO

ALTER TABLE [dbo].[Active.Rentals]  WITH CHECK ADD  CONSTRAINT [FK_Active.Rentals_Renter.Account1] FOREIGN KEY([Renter.AccountID])
REFERENCES [dbo].[User.Account] ([User.AccountID])
GO

ALTER TABLE [dbo].[Active.Rentals] CHECK CONSTRAINT [FK_Active.Rentals_Renter.Account1]
GO


