<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

// http://doc.spip.org/@genie_dmcloud_dist
function genie_dmcloud_dist($t) {

    include_spip('inc/config');
    $user_id = lire_config('dmcloud/user_id_dmcloud');
    $api_key = lire_config('dmcloud/api_key_dmcloud');
    include_once(_DIR_PLUGIN_DMCLOUD."lib/cloudkey-php/CloudKey.php");

    $cloudkey = new CloudKey($user_id, $api_key);

    $result = $cloudkey->media->list(array('fields' => array('id'), 'per_page' => 20, 'page' => 2));


    # List some video and display the media_id and title:
    $res = $cloudkey->media->list(array('fields' => array('id', 'meta.title', 'meta.author', 'meta.url'), 'per_page' => 20, 'page' => 1));
    foreach($res->list as $media) {
        $url_vid = $cloudkey->media->get_stream_url(array('id' =>$media->id));
        //$author_vid = $cloudkey->user->get(array('id' =>$media->id));
        $list_dmcloud[] = array(
                'id' => $media->id, 
                'title' => $media->meta->title,
                'author' => $author_vid->username,
                'url' => $url_vid);
    }
    return $list_dmcloud;

    return 0;
}