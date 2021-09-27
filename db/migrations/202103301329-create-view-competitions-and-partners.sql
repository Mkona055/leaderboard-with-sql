CREATE VIEW partners_competition_view(partner_id,c_identifier,p_identifier, name,venue,start_time,start_date,end_date,
	number_events,max_athlete,email,phone_number) as
	(SELECT partner_id, competitions.identifier as c_identifier,partners.identifier as p_identifier, competitions.name as name,venue,start_time,start_date,
	end_date,number_events,max_athlete,
	competitions.email as email, competitions.phone_number as phone_number 
	FROM partners JOIN competitions ON competitions.partner_id = partners.id);