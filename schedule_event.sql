--Create MySQL event

CREATE EVENT  Get_Price_Daily  
ON SCHEDULE 
EVERY 1 DAY     
ON COMPLETION PRESERVE          
DO       
--Check if the scheduler is activated


insert into graph(ean, avg_price) select ean, round(avg(price),2) avg_price from pt_products group by ean;

--Check if the event has been executed

SHOW EVENTS;

--Find all daily prices from an ean, grouped by day of the entry.
--Database query for a concrete ean
SELECT * FROM graph WHERE ean IN ('00000000271686') group by DAY(created_at);
--PHP, using variable for the ean
 SELECT * FROM graph WHERE ean IN ('$product_main["ean"]') group by DAY(created_at);
