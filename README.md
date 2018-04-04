# Moodle External Webservice Authentication Plugin

Moodle plugin to authenticate users against external webservice.

This plugin let you configure a SOAP webservice
to authenticate users against it.

Install
-------

* Put these files at moodle/auth/ws/
 * You may use composer
 * or git clone
 * or download the latest version from https://github.com/danielneis/moodle-auth_ws/archive/master.zip
* Log in your Moodle as Admin and go to "Notifications" page
* Follow the instructions to install the plugin

Usage
-----

You configure the web service URL, the name of the function to be called, the returned Class and attribute to get the boolean result from.

This plugins does not create users, and also does not update users records.

Users are suposed to be created and updated by external service using the Moodle's webservices.

Users should have "auth = ws" for this plugin to authenticate users.

The screenshot below shows an example of how to configure you plugin to call your webservice

![Config Example](https://github.com/danielneis/moodle-auth_ws/blob/master/moodle-auth_ws_settings.png)

Create new user account on login
-----------------------------------

For this to happen you must change the "is_synchronised_with_external" function at
https://github.com/danielneis/moodle-auth_ws/blob/master/auth.php#L134 to return true.

Then you must implement the "get_userinfo" function at https://github.com/danielneis/moodle-auth_ws/blob/master/auth.php#L88 to return the information for the user. See the fields on user table that Moodle may use to check if user is confirmed/complete.

Dev Info
--------

Please, report issues at: https://github.com/danielneis/moodle-auth_ws/issues

Feel free to send pull requests at: https://github.com/danielneis/moodle-auth_ws/pulls

[![Build Status](https://travis-ci.org/danielneis/moodle-auth_ws.svg?branch=master)](https://travis-ci.org/danielneis/moodle-auth_ws)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/danielneis/moodle-auth_ws/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/danielneis/moodle-auth_ws/?branch=master)
