# calendarAPI
Laravel REST Calendar

**User Register Request**<br>

Headers<br>
 Content-type: application/json<br>
 
Body<br>
{"email": "test@test5.com", "password": "test@123", "password_confirmation": "test@123"}
<br>-----------------------------------------

**User Login Request**<br>

Headers<br>
 Content-type: application/json<br>
 
Body<br>
{"email": "test@test5.com", "password": "test@123"}
<br>-----------------------------------------
 
 **User Logout Request**<br>
 
 Headers<br>
  Content-type: application/json<br>
  
 Body<br>
 {"api_token": "<api-token>"}
 <br>-----------------------------------------
 
 **User Logout Request**<br>
 
 Headers<br>
  Content-type: application/json<br>
  
 Body<br>
 {"api_token": "<api-token>"}
 <br>-----------------------------------------
 
 **Events List Request**<br>
 
 Headers<br>
  Content-type: application/json<br>
  
 Body (all for user)<br>
 {
 	"user_id": "<user_id>",
 	"sort_option": "none"
 }
 <br>
 
  Body (sorted by date)<br>
  {
   	"user_id": "<user_id>",
   	"sort_option": "date"
   }<br>
  
  Body (sorted chronologically)<br>
    {
     	"user_id": "<user_id>",
     	"sort_option": "chronologically"
     }
 <br>-----------------------------------------
 
**Event Create Request**<br>

Headers<br>
  Content-type: application/json<br>
  
 Body<br>
{
	"method":"create",
	"user_id":<user_id>,
	"description": "<description>",
	"location": "<location>",
	"from_date": "<from_date>",
	"to_date": "<to_date>"
}
<br>-----------------------------------------
 
**Event Update Request**<br>

Headers<br>
  Content-type: application/json<br>
  
 Body<br>
{
	"method":"update",
	"event_id":<event_id>,
	"user_id":<user_id>,
	"description": "<description>",
	"location": "<location>",
	"from_date": "<from_date>",
	"to_date": "<to_date>"
}
<br>-----------------------------------------
 
**Event Delete Request**<br>

Headers<br>
  Content-type: application/json<br>
  
 Body<br>
{
	"method":"delete",
	"event_id":<event_id>
}
