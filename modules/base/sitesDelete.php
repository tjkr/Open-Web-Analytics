<?php

//
// Open Web Analytics - An Open Source Web Analytics Framework
//
// Copyright 2006 Peter Adams. All rights reserved.
//
// Licensed under GPL v2.0 http://www.gnu.org/copyleft/gpl.html
//
// Unless required by applicable law or agreed to in writing, software
// distributed under the License is distributed on an "AS IS" BASIS,
// WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
// See the License for the specific language governing permissions and
// limitations under the License.
//
// $Id$
//

require_once(OWA_BASE_DIR.'/owa_controller.php');
require_once(OWA_BASE_DIR.'/owa_user.php');

/**
 * Delete Site Controller
 * 
 * @author      Peter Adams <peter@openwebanalytics.com>
 * @copyright   Copyright &copy; 2006 Peter Adams <peter@openwebanalytics.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GPL v2.0
 * @category    owa
 * @package     owa
 * @version		$Revision$	      
 * @since		owa 1.0.0
 */

class owa_sitesDeleteController extends owa_controller {
	
	function owa_siteDeleteController($params) {
		$this->owa_controller($params);
		$this->priviledge_level = 'admin';
	}
	
	function action() {
		
		$site = owa_coreAPI::entityFactory('base.site');
		$site->delete($this->params['site_id'], 'site_id');
		
		$data['view_method'] = 'redirect';
		$data['view'] = 'base.options';
		$data['subview'] = 'base.sites';
		$data['status_code'] = 3204;
		
		return $data;
	}
	
}


?>