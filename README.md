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

To see a sample of how to configure you plugin to call your webservice take a look at https://github.com/danielneis/moodle-auth_ws/blob/master/moodle-auth_ws_settings.png

Dev Info
--------

Please, report issues at: https://github.com/danielneis/moodle-auth_ws/issues

Feel free to send pull requests at: https://github.com/danielneis/moodle-auth_ws/pulls
