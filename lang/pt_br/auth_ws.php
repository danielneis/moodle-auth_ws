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
 * Strings for component 'auth_ws', language 'pt_br'.
 *
 * @package   auth_ws
 * @copyright Daniel Neis Araujo
 * @license   http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

$string['pluginname'] = 'Autenticação via webservice externo';
$string['auth_function'] = 'Função de autenticação';
$string['auth_function_desc'] = 'O nome da função que será invocada para autenticar os usuários.';
$string['auth_function_password_paramname'] = 'Parâmetro para senha';
$string['auth_function_password_paramname_desc'] = 'Nome do parâmetro esperado pelo webservice para receber a senha.';
$string['auth_function_resultClass'] = 'Classe do resultado';
$string['auth_function_resultClass_desc'] = 'O nome da classe contendo o resultado do webservice.';
$string['auth_function_resultField'] = 'Campo do resultado';
$string['auth_function_resultField_desc'] = 'O campo (ou atributo) da classe contendo o resultado booleano do webservice.';
$string['auth_function_username_paramname'] = 'Parâmetro para identificação do usuário)';
$string['auth_function_username_paramname_desc'] = 'Nome do parâmetro esperado pelo webservice para receber a identificação do usuário (username).';
$string['auth_serverurl'] = 'URL do webservice';
$string['auth_serverurl_desc'] = 'A URL completa para o webservice para executar a autenticação.';
$string['auth_wsdescription'] = 'Este plugin permite autenticar usuários com base em um webservice externo.';
$string['changepasswordurl'] = 'URL para trocar a senha';
$string['default_params'] = 'Parâmetros padrão';
$string['default_params_desc'] = 'Parâmetros fixos para serem enviados nas chamadas de webservice. Exemplo: a:b,c:d,e:f';
$string['protocol'] = 'Protocolo';
$string['protocol_desc'] = 'Protocolo utilizado pelo webservice. Atualmente apenas SOAP.';
