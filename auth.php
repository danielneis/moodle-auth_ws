<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Authentication Plugin: External Webservice Authentication
 *
 * Checks against an external webservice.
 *
 * @package    auth_ws
 * @author     Daniel Neis Araujo
 * @license    http://www.gnu.org/copyleft/gpl.html GNU Public License
 */

defined('MOODLE_INTERNAL') || die();

require_once($CFG->libdir.'/authlib.php');

/**
 * External webservice authentication plugin.
 */
class auth_plugin_ws extends auth_plugin_base {

    /**
     * Constructor.
     */
    function __construct() {
        $this->authtype = 'ws';
        $this->config = get_config('auth/ws');

        if (isset($this->config->default_params) && !empty($this->config->default_params)) {
            $params = explode(',', $this->config->default_params);
            $default_params = array();
            foreach ($params as $p) {
                list($paramname, $value) = explode(':', $p);
                $default_params[$paramname] = $value;
            }
            $this->config->ws_default_params = $default_params;
        } else {
            $this->config->ws_default_params = array();
        }
    }

    /**
     * Returns true if the username and password work and false if they are
     * wrong or don't exist.
     *
     * @param string $username The username
     * @param string $password The password
     * @return bool Authentication success or failure.
     */
    function user_login($username, $password) {

        $functionname = $this->config->auth_function;
        $params  = array($this->config->auth_function_username_paramname => $username,
                         $this->config->auth_function_password_paramname => $password);


        $result = $this->call_ws($this->config->auth_serverurl, $functionname, $params);

        return ($result->{$this->auth_function_resultClass}->{$this->auth_function_resultField});
    }

    /**
     * This plugin is intended only to authenticate users.
     * User synchronization must be done by external service,
     * using Moodle's webservices.
     *
     * @param progress_trace $trace
     * @param bool $do_updates  Optional: set to true to force an update of existing accounts
     * @return int 0 means success, 1 means failure
     */
    function sync_users(progress_trace $trace, $do_updates=false) {
        return true;
    }

    function get_userinfo($username) {
        return array();
    }

    private function call_ws($serverurl, $functionname, $params = array()) {

        $serverurl = $serverurl . '?wsdl';

        $params = array_merge($this->config->ws_default_params, $params);

        $client = new SoapClient($serverurl);
        try {
            $resp = $client->__soapCall($functionname, array($params));

            return $resp;
        } catch (Exception $e) {
            echo "Exception:\n";
            echo $e->getMessage();
            echo "===\n";
            return false;
        }
    }

    /**
     * A chance to validate form data, and last chance to
     * do stuff before it is inserted in config_plugin
     *
     * @param stfdClass $form
     * @param array $err errors
     * @return void
     */
    function validate_form($form, &$err) {
    }

    function prevent_local_passwords() {
        return true;
    }

    /**
     * Returns true if this authentication plugin is "internal".
     *
     * Internal plugins use password hashes from Moodle user table for authentication.
     *
     * @return bool
     */
    function is_internal() {
        return false;
    }

    /**
     * Indicates if moodle should automatically update internal user
     * records with data from external sources using the information
     * from auth_plugin_base::get_userinfo().
     * The external service is responsible to update user records.
     *
     * @return bool true means automatically copy data from ext to user table
     */
    function is_synchronised_with_external() {
        return false;
    }

    /**
     * Returns true if this authentication plugin can change the user's
     * password.
     *
     * @return bool
     */
    function can_change_password() {
        return false;
    }

    /**
     * Returns the URL for changing the user's pw, or empty if the default can
     * be used.
     *
     * @return moodle_url
     */
    function change_password_url() {
        if (isset($this->config->changepasswordurl) && !empty($this->config->changepasswordurl)) {
            return new moodle_url($this->config->changepasswordurl);
        } else {
            return null;
        }
    }

    /**
     * Returns true if plugin allows resetting of internal password.
     *
     * @return bool
     */
    function can_reset_password() {
        return false;
    }

    /**
     * Prints a form for configuring this authentication plugin.
     *
     * This function is called from admin/auth.php, and outputs a full page with
     * a form for configuring this plugin.
     *
     * @param stdClass $config
     * @param array $err errors
     * @param array $user_fields
     * @return void
     */
    function config_form($config, $err, $user_fields) {
        include 'config.html';
    }

    /**
     * Processes and stores configuration data for this authentication plugin.
     *
     * @param srdClass $config
     * @return bool always true or exception
     */
    function process_config($config) {
        // set to defaults if undefined
        if (!isset($config->protocol)) {
            $config->protocol = 'soap';
        }
        if (!isset($config->auth_serverurl)) {
            $config->auth_serverurl = '';
        }
        if (!isset($config->default_params)) {
            $config->default_params = '';
        }
        if (!isset($config->auth_function)) {
            $config->auth_function = '';
        }
        if (!isset($config->auth_function_username_paramname)) {
            $config->auth_function_username_paramname = '';
        }
        if (!isset($config->auth_function_password_paramname)) {
            $config->auth_function_password_paramname = '';
        }
        if (!isset($config->auth_function_resultClass)) {
            $config->auth_function_resultClass = '';
        }
        if (!isset($config->auth_function_resultField)) {
            $config->auth_function_resultField = '';
        }
        if (!isset($config->removeuser)) {
            $config->removeuser = AUTH_REMOVEUSER_KEEP;
        }
        if (!isset($config->changepasswordurl)) {
            $config->changepasswordurl = '';
        }

        // Save settings.
        set_config('protocol',                         $config->protocol,                         'auth/ws');
        set_config('auth_serverurl',                   $config->auth_serverurl,                   'auth/ws');
        set_config('default_params',                   $config->default_params,                   'auth/ws');
        set_config('auth_function',                    $config->auth_function,                    'auth/ws');
        set_config('auth_function_username_paramname', $config->auth_function_username_paramname, 'auth/ws');
        set_config('auth_function_password_paramname', $config->auth_function_password_paramname, 'auth/ws');
        set_config('auth_function_resultClass',        $config->auth_function_resultClass,        'auth/ws');
        set_config('auth_function_resultField',        $config->auth_function_resultField,        'auth/ws');
        set_config('removeuser',                       $config->removeuser,                       'auth/ws');
        set_config('changepasswordurl',                $config->changepasswordurl,                'auth/ws');

        return true;
    }
}
