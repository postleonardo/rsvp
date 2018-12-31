# RSVP
RSVP Drupal 8 module.

# Architecture
The RSVP module provides an Event content type that allows site administrators to create events adding a Title and Description.

It also provides a view page listing all of the Events, as well as a node detail page where logged in users can RSVP for that particular Event.

The site administrator also has the ability to check a report of all the users who RSVP'd for an Event.

The RSVP relation between the user and the event is set by a configuration entity that provides `uid` and `nid` fields. Whenever a user RSVPs for an Event, a new entity is created, saving the Event node ID and the user ID. That relation can then be listed in the canonical entity route for the RSVP relation entity.

# Assumptions
* Only logged-in users can RSVP for an event; anonymous users will see a message instead of the RSVP form
* User name and e-mail will be collected automatically
* Use Drupal's OOTB "Administrator" role as permission criteria for RSVP listings

# Build instructions
* Clone this repository's `development` branch
* Install "RSVP" module through the UI or Drush/Drupal Console clients
