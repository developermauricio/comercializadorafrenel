<?php exit; ?>
[2022-03-13 16:25:42] ERROR: Form 74 > Mailchimp API error: 400 Bad Request. Invalid Resource. isob****@ho*****.com has signed up to a lot of lists very recently; we're not allowing more signups for now

Request: 
POST https://us6.api.mailchimp.com/3.0/lists/119083ba7d/members

{"status":"pending","email_address":"isob****@ho*****.com","interests":{},"merge_fields":{},"email_type":"html","ip_signup":"198.7.56.234","tags":["Newsletter"]}

Response: 
400 Bad Request
{"type":"https://mailchimp.com/developer/marketing/docs/errors/","title":"Invalid Resource","status":400,"detail":"isob****@ho*****.com has signed up to a lot of lists very recently; we're not allowing more signups for now","instance":"bb166ae4-40e7-56b1-3437-c10566d6e30e"}
