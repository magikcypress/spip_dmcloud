<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

// http://doc.spip.org/@genie_dmcloud_dist
function genie_dmcloud_dist($t) {

    include_spip('inc/config');
    $user_id = lire_config('dmcloud/user_id_dmcloud');
    $api_key = lire_config('dmcloud/api_key_dmcloud');
    include_once(_DIR_PLUGIN_DMCLOUD."lib/cloudkey-php/CloudKey.php");

    return 0;
}