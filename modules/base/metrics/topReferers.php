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

require_once(OWA_BASE_DIR.DIRECTORY_SEPARATOR.'owa_metric.php');

/**
 * Top Referers Metric
 * 
 * @author      Peter Adams <peter@openwebanalytics.com>
 * @copyright   Copyright &copy; 2006 Peter Adams <peter@openwebanalytics.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GPL v2.0
 * @category    owa
 * @package     owa
 * @version		$Revision$	      
 * @since		owa 1.0.0
 */

class owa_topReferers extends owa_metric {
	
	function owa_topReferers($params = null) {
		
		$this->params = $params;
		
		$this->owa_metric();
		
		return;
		
	}
	
	function generate() {
		
		$s = owa_coreAPI::entityFactory('base.session');
		
		$r = owa_coreAPI::entityFactory('base.referer');
		
		$this->params['related_objs'] = array('referer_id' => $r);
		
		$this->setTimePeriod($this->params['period']);
		
		$this->params['select'] = "count(referer.id) as count,
									sum(session.num_pageviews) as page_views,
									url,
									page_title,
									site_name,
									query_terms,
									snippet,
									refering_anchortext,
									is_searchengine";
								
		$this->params['groupby'] = array('referer.url');
		
		$this->params['orderby'] = array('count');
	
		return $s->query($this->params);
		
		
	}
	
	
}


?>