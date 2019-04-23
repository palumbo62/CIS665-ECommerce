select * from [User.Tbl] u
	join [Property.Tbl]	p
		on u.[UserID.PK] = p.[UserID.FK]
	join [Comments.Tbl] c
		on u.[UserID.PK] = c.[UserID.FK]
	join [Reservation.Tbl] r
		on u.[UserID.PK] = r. [UserID.FK]
;

select * from [Reservation.Tbl]
	join [Property.Tbl]
		on [Reservation.Tbl].[PropertyID.FK] = [Property.Tbl].[PropertyID.PK]
	where [Reservation.Tbl].[UserID.FK] = 2
	
;

select * from [Comments.Tbl]
	join [Property.Tbl]
		on [Comments.Tbl].[PropertyID.FK] = [Property.Tbl].[PropertyID.PK]
