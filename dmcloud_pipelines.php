<?php
/**
 * Utilisations de pipelines par dmcloud
 *
 * @plugin     d3js
 * @copyright  2013
 * @author     vincent
 * @licence    GNU/GPL
 * @package    SPIP\dmcloud\Pipelines
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Taches periodiques de dmcloud 
 *
 * @param array $taches_generales
 * @return array
 */
function dmcloud_taches_generales_cron($taches_generales){

    $taches_generales['dmcloud'] = 90;
        
    return $taches_generales;
}