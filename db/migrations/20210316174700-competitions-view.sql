CREATE VIEW competitions_view (competition,c_identifier,venue,start_date,end_date,start_time,max_athlete,number_events,representative,
	email,phone_number,company_name,p_identifier)AS 
(SELECT competitions.name as competition,competitions.identifier as c_identifier, venue,start_date,end_date,start_time,max_athlete,number_events,
competitions.representative,competitions.email,competitions.phone_number,company_name,partners.identifier as p_identifier
	FROM competitions
	JOIN partners ON partners.id = competitions.partner_id);