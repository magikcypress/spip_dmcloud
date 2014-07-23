<?php

/**
 * Pipeline pour Monitor
 *
 * @plugin     Dmcloud
 * @copyright  2014
 * @author     Vincent
 * @licence    GNU/GPL
 * @package    SPIP\Dmcloud\administrations
 */

if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Installation/maj des tables dmcloud
 *
 * @param string $nom_meta_base_version
 * @param string $version_cible
 */
function dmcloud_upgrade($nom_meta_base_version,$version_cible){
    
    $maj = array();

    include_spip('base/upgrade');
    maj_plugin($nom_meta_base_version, $version_cible, $maj);
}

/**
 * Desinstallation/suppression des tables dmcloud
 *
 * @param string $nom_meta_base_version
 */
function dmcloud_vider_tables($nom_meta_base_version) {

    effacer_meta("dmcloud");
    effacer_meta($nom_meta_base_version);
}

?>