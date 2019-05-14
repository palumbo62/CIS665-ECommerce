DECLARE @cid date = '2019/03/27';
DECLARE @cod date = '2019/03/28';

SELECT * FROM ReservationT r
WHERE [PropertyIdFK] = 44
   AND 
 		((@cid < r.CheckIn AND @cod <= r.CheckIn)
		OR
		 (@cid >= r.CheckOut AND @cod <= r.CheckOut));
									
              