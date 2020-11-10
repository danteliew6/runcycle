# Runcycle


Github Link:
  https://github.com/danteliew6/runcycle

Deployed Web App Link:
  http://runcycle-wad2.000webhostapp.com/

# Setting up the Application:

  1. Import database.sql to PHPMyAdmin to create the database for runcycle.
  2. Open the app by accessing localhost/app and you’ll be directed to the login page.
  3. Create an account by clicking on the registration link below the login page.
  4. Log in using the account created.
  5. You’ve set up the application and can freely roam the website now.

# Running the Application:

Creating an event:
  1. Click on the “Create New Event” button on the homepage to go to the create events page.
  2. Fill in the details of your event
  3. Fill the start and end point with a general address/area (e.g seng kang). 
  4. Click generate route to run the google maps API and obtain your planned route.
  5. Click “Create Event”

Joining an event:
  1. Click on the “Join Event” button on any of the event cards
  2. Confirm the alert

Cancelling an event:
  1. Click on the “Cancel” button on the event you wish to cancel.
      a. If you’re the creator of the event, a prompt will appear asking you if you wish to remove this event entirely. This is because the event will not continue if the host             wishes to cancel it.
  2. Confirm the prompt if you wish to cancel, or click “Cancel” to go back
      a. If you’re not the host, then cancelling the event will simply remove you from the participants list
      b. Confirm the alert

Event details:
  1. Click on any event card’s “Detail” button.

Participants list:
  1. Navigate to the Event details page
  2. Click on the “Participants” button.
	
Finding events:
  1. Discover new events by navigating the home page


# Page Details

Registration

	This page is where users will register for an account in order to login to the RunCycle website.

Login

	This page is where users key in their login details and login to the RunCycle website.

Home

	The RunCycle homepage is the default page that users will be directed to once they log into their account. It shows all the upcoming events that are available for them to participate in via Cards on the screen, as well as the events the user has signed up for.

Weather

	At the top of the page, a Weather Data API is implemented to show the users the current weather. This is to facilitate in the planning of events and to monitor what the current weather is like. It is especially useful for our website due to the outdoor activity nature.

Cards

	The cards will show a summarised description of the Event title, as well as buttons to quickly Join/Exit the event.

My Events

	This section will show all the events that the user has signed up for

Event Detail Page

	This page shows the various details of the specific event that has been selected. Users are able to view what the event is about, who are the participants of the event, what is the activity route, access comments for the event as well as to join the event.
	Details include:
		Event Title
		Event Type (Run/Cycle)
		Date
		Time
		Duration
		No. of Participants
		Description of event
		Activity Route (Google Maps API)


Join/Cancel:
	Users can join the event directly, or cancel joining the event if they are already inside
	The event creator is able to delete the event directly from the page


Create Event
	Users will access the Create Events page via the Navigation Bar on the top right hand corner of the webpage.
	User will key in their event details based on the form given
		Event Title
		Event Type (Run/Cycle)
		Date
		Time
		Duration
		No. of Participants allowed
		Description of event
	User will then generate the desired activity route using the Google Maps API by keying in their Start and End location
	Users will then click on the create event button and the event will be submitted into the database and can be viewed and accessed via the Homepage.

About Us
	This page shows an overview of the developers of the website as well as a brief description on what the website is about.
	
	
	
# Authors and acknowledgment

Group Members:
	1. Dante Liew Zhen Ting
	2. Bryan Koh Qi Yan
	3. Wang Wei Min
	4. Remus Chan Koon Hong
	5. Lim Wei Zhi

API Acknowledgment:
	1. Google Maps API
	2. Google Directions API
	3. Weather Forecast API from Data.gov.sg


