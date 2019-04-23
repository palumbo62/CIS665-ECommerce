use BOG
go

select * from [User.Account] as u1
    inner join [User.PersonalInfo] as u2
    on u1.[User.AccountID] = u2.[User.AccountID]

