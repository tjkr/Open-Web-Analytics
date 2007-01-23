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
 * Top Refering Keywords Metric
 * 
 * @author      Peter Adams <peter@openwebanalytics.com>
 * @copyright   Copyright &copy; 2006 Peter Adams <peter@openwebanalytics.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GPL v2.0
 * @category    owa
 * @package     owa
 * @version		$Revision$	      
 * @since		owa 1.0.0
 */

class owa_topReferingKeywords extends owa_metric {
	
	function owa_topReferingKeywords($params = null) {
		
		$this->params = $params;
		
		$this->owa_metric();
		
		return;
		
	}
	
	function generate() {
		
		$this->params['select'] = "count(session.id) as count, referer.query_terms";
		
		$this->setTimePeriod($this->params['period']);
		
		$s = owa_coreAPI::entityFactory('base.session');
		$r = owa_coreAPI::entityFactory('base.referer');
		
		$this->params['related_objs'] = array('referer_id' => $r);
		$this->params['groupby'] = array('referer.query_terms');
		$this->params['orderby'] = array('count');
		$this->params['order'] = 'DESC';
		
		$this->params['constraints']['referer.id'] = array('operator' => '!=', 'value' => 0);
		$this->params['constraints']['referer.query_terms'] = array('operator' => '!=', 'value' => '');	
		
		return $s->query($this->params);
		
		/*
		 
		 SELECT 
			count(sessions.session_id) as count,
			referers.query_terms
		FROM 
			%s as referers,
			%s as sessions 
		WHERE 
			referers.id != 0
			and query_terms != ''
			AND referers.id = sessions.referer_id
			%s
			%s
		GROUP BY
			referers.query_terms
		ORDER BY
			count DESC
		LIMIT 
			%s",
			$this->setTable($this->config['referers_table']),
			$this->setTable($this->config['sessions_table']),
			$this->time_period($this->params['period']),
			$this->add_constraints($this->params['constraints']),
			$this->params['limit']
		);
		 
		 */
		
	}
	
	
}


?>