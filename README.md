::: Database Design :::
(Everyone read this before implementing the project) 

Shorthands: pk = primary key, U= unique, AI = auto increment, FK = foreign key

Tables:

User => id (pk, AI), username (U), password, email (U), full_name
[[[[ Username and email must be unique, because we want to send request to particular user and many more functionalities, id is auto incremented, you don't need to worry about that when you are performing any types of query (insert, delete) ]]]]

Organization => id (pk, AI), name (U)

Organizer => organizer_id (pk, FK), user_id (pk, FK)
[[[[ Both are primary keys because we want to add multiple users to multiple organizations and vice verse. It is a convenient way to implement many to many relationship ]]]]

{{ Organizations can have multiple users, Users can be part of multiple organizations, two tables needed }}

Competition => id (pk, AI), name, venue, date, registration_deadline, description, catagory_id (FK), organization_id (FK), latest_updates_id (FK)
[[[[ competition has organization_id to identify why organization organizes the competition, by which we can also find out who are the organizers (join organizer table), this table will also contain the latest post from the updates table. every time there is a new post, competition table updates the latest_post_id ]]]]

Catagory => id (pk, AI), name, description

participated_competition => id (pk, AI), user_id (FK), competition_id (FK), isCompleted

Query => id (pk, AI), competition_id (FK), user_id (FK), details, response
[[[[ any user can ask for a query. competition_id has a corresponding organization_id which also has organizers who only can response to the query. So there will be a complex query. (join query, competition, organization, organizer) ]]]]

Updates => id (pk, AI), competition_id (FK), post_details (FK), post_date
[[[[ Every time a new update is given by an organizer, competition_id checks whether the organizer is in the organization or not, also updates the competition's latest_update_id with the update_id ]]]]

# Database is given here. Please check all the specifications above, and recheck the database implementation in the SQL file.

... If needed::
- run mysql and apache server
- go to http://localhost/phpmyadmin/
- create a new database "competitionhub_db
- Import the sql file