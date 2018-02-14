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
 * WS authentication plugin upgrade code
 *
 * @package    auth_ws
 * @copyright  2018 Daniel Neis Araujo
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

defined('MOODLE_INTERNAL') || die();

/**
 * Function to upgrade auth_ws.
 * @param int $oldversion the version we are upgrading from
 * @return bool result
 */
function xmldb_auth_ws_upgrade($oldversion) {

    if ($oldversion < 2018021300) {
        // Convert info in config plugins from auth/ws to auth_ws.
        upgrade_fix_config_auth_plugin_names('ws');
        upgrade_fix_config_auth_plugin_defaults('ws');
        upgrade_plugin_savepoint(true, 2018021300, 'auth', 'ws');
    }
    return true;
}
