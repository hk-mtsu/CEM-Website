# <span style="color:blue">NEW CEM WEBSITE</span>




# <span style="color:green">HELP GETTING STARTED</span>

- start AMP stack
- copy cem_new directory to AMP stack public http directory
- open php my admin or mysql command prompt
	- run the sql found in `sql/tables.sql` in order to generate tables that are required
	- run the sql found in `sql/test_users.sql` in order to inser the test users
- navigate to directory in web browser
	- e.g. localhost/cem_new



# <span style="color:green">CREDENTIALS</span>
some credentials that might be helpful to get started.<br/>
*please make sure readme.md and readme.html are in a safe place.*

- reports page
	- pass: `L8}qC)gg4:>EZ&Y7`
- php my admin
	- cem server
		- http://cem.mtsu.edu/phpmyadmin/
		- user: `cem`
		- pass: `cem3212019`
	- localhost
		- http://localhost/phpmyadmin/
		- user: 'root'
		- pass: None/Empty
- centerforedmedia@gmail.com
	- pass: `cem272019`
- test users from `sql/users.sql`
	- user
		- user: `TestUser`
		- pass: `1234567a`
	- admin
		- user: `TestAdmin`
		- pass: `1234567a`	




# <span style="color:green">TO DO</span>

- please consider this a work in progress / rough draft
	- anything / everything can and should be improved
- finish certificate pdf generation
- implement video search form, and certificate earning / video watch time tracking
- suggest some sort of 3-4 question quiz for certificates instead of only relying on video watch time
	- make some sort of quiz / grader
- copy cem database containing certificates
- use more bootstrap elements for design
- update css / style
	- make sure its suitable for mobile use
- favico
- meta header stuff for sharing etc
- improve user registration process
	- verify email accts
	- enforce more secure passwords
- improve method of storing encrypted user passwords
- lots of other stuff...
- testing / consider edge cases




# <span style="color:green">PAGE / SCRIPT DESCRIPTIONS</span>

## <span style="color:purple">PAGES</span>
directory: cem_new/

#### av_services.php
- Audio/Visual Services page
- this page is basically copy and pasted from the current cem website
- http://cem.mtsu.edu/audiovisual-services

#### confirmation.php
- this page is displayed after someone has successfully registered for an event

#### equipment_checkout.php
- this page is basically copy and pasted from the current cem website
- http://cem.mtsu.edu/audiovisual-services-engineering-and-check-out-services-audiovisual-equipment

#### erc.php
- education resource channel / education resource channel tab
- this was leftover from John Boyer, not sure where it should be used

#### index.php
- main landing page
- home tab

#### login.php
- login form for both users and admins
- registration form for users
	- in order to register a new admin, complete the user registration and adjust the Permission_Level to "admin" through mysql / phpmyadmin

#### professional_dev.php
- Professional Development tab
- http://cem.mtsu.edu/k-12/about
- http://cem.mtsu.edu/k-12/webcasts/archive
- currently the video search / browse is not implemented yet
	- the form on the video section of the Professional Development tab is currently just a placeholder.

#### register.php
- registration form for all of the events
- only events that are currently open for registration and are under the maximum number of registrants are available to select on the form

#### admin_panel.php
- this is where administrators are able to create events, remove event attendees, and update event settings
- dashboard tab when logged in as an admin
- currently 

#### user_panel.php
- dashboard tab when logged in as a user
- allows a user to view / update their stored information including certificates earned
- updateable information
	- Username 
	- Password
	- E-mail Address 
- to do
	- more information needs to be stored and updateable for each user
		- address / country location
		- primary teaching roles
		- etc.
- certificate earning needs to be implemented (as well as browsing / searching for webcasts)
	- browse_video_form.php
	- see directory: ```cem_new/certificate```

#### video_production.php
- Video Production Services
- linked to from av_services.php / AV Services tab
- http://cem.mtsu.edu/video-production-services




## <span style="color:purple">FORMS</span>
directory: cem_new/forms

#### browse_video_form.php
- rough draft of the video search / browse feature
- should be generated dynamically based on the videos that are in the current database, this is just a place holder basically
- basically copy and pasted from
	- http://cem.mtsu.edu/k-12/webcasts/archive
- used by professional_dev.php / professional development tab

#### login_form.php
- embedded in login.php under the login section
- contains the form embeded by the login page for logging into user / admin accounts.

#### user_create_form.php
- embedded in login.php under the registration section
- this form is used to register new users / admins
	- note: there isnt currently a way to set the role as admin outside of phpmyadmin

#### user_edit_form.php
- embedded in user_panel.php
- it is used to edit / update user information

#### create_event_form.php
- embedded un admin_panel.php
- used for adding an event to the events table

#### edit_event_form.php
- embedded un admin_panel.php
- used for editting / updating event settings found in the events table

#### registration_form.php
- embedded in register.php
- this form is for event registration


## <span style="color:purple">PHP SCRIPTS / OTHER</span>
directory: cem_new/php

#### authenticate.php
- this script authenticates both users and admins/moderators and then sets the session variables accordingly

#### create_event.php
- this script is called by admin_panel.php and adds an event to the events table

#### db_connect.php
- this script connects to the database using credentials stored in vars.php

#### event_registration.php
- this script is called by register.php/registration_form.php
- responsible for adding a user to the registration table
- note:
	- when a user is added the `unregistered` flag is set to 'N'
	- when a user is "deleted" by an admin, this flag is flipped to 'Y' instead of actually removing them. this way its a little safer and no email addresses or other information is lost.

#### footer.php
- contains the footer that is found on all of the pages

#### funcs.php
- contains all the functions that are shared between files

#### load_event.php
- script to assist the admin panel in setting session variables for a "selected" event.

#### logout.php
- a script to kill a session and "logout" a user or admin

#### navbar.php
- contains the navigation menu that is found on all of the pages. 
- this is generated dynamically based on whether a user / admin is logged in or not.

#### passtools.php
- contains a php class to assist in salting and peppering passwords, as well as encrypting and decrypting
- this should be updated if the server is updated to a newer version of php
- not entirely sure if this is using best practice / how secure this is. 
- please ensure it is secure before using in production.

#### register_user.php
- script to insert a user into the users table

#### remove_client.php
- script to "remove" a suer from the registrations database by event name and email address.
- note: user is not actually deleted from table but instead an `unregistered` flag is flipped to 'Y'

#### update_event.php
- script to update an events settings.
- called by the admin panel page

#### vars.php
- contains variables that are used site wide




## <span style="color:purple">SQL SCRIPTS / OTHER</span>
directory: cem_new/sql
#### tables.sql
- this script is for building the required tables / database schema required

#### users.sql
- this script is for adding test users to the users table
- the credentials for these accounts can be found <a href="#credentials">here</a>





## <span style="color:purple">EMAIL</span>
directory: cem_new/email
#### emailer.php
- this script contains a php emailer class

#### test.php
- this script contains a driver program to test the emailer class

#### event_template_moderator.html
- this is a template file for the email that is sent to the moderator of an event after a user registers. 
- this is used by emailer.php compile function.

#### event_template_user.html
- this is a template file for the email that is sent to th user of an event after a user registers. 
- this is used by emailer.php compile function.




## <span style="color:purple">CERTIFICATE</span>
directory: cem_new/certificate

#### create_cert.php
- rough draft work in progress certificate generator.
- currently able to reproduce certificate from cem website in html form
- to do:
	- convert html certificates to pdf so user can download them

#### certificate_template.html
- html template file used by create_cert.php




## <span style="color:purple">FPDF</span>
directory: cem_new/fpdf

- this directory contains files for a free pdf generation library.
- FPDF is a PHP library which allows you to generate PDF files with pure PHP
- more information is available at http://www.fpdf.org/




## <span style="color:purple">JS SCRIPTS / OTHER</span>
directory: cem_new/js
#### script.js
- this file has site-wide general javascript

#### carousel.js
- this file has javascript related to the slideshow / carousel




## <span style="color:purple">CSS / Style Sheets</span>
directory: cem_new/css
#### style.css
- this style sheet is for general css styling

#### carousel.css
- this style sheet is for slideshow / carousel styling



## <span style="color:purple">ASSETS</span>
directory: cem_new/assets

- this directory holds all the image files.
- this would be where font faces and other similar things belong as well.