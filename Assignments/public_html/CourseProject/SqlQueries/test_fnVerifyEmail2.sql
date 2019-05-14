declare @res int = -1;
if exists (SELECT email from [UserT] u where u.Email = N'test@bog.com')
begin
	set @res = 1;
end;

select @res as RES;