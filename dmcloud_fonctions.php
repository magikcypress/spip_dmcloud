<?php

if (!defined("_ECRIRE_INC_VERSION")) return;

function dmcloud_recup_video($page=1) {

    include_spip('inc/config');
    $user_id = lire_config('dmcloud/user_id_dmcloud');
    $api_key = lire_config('dmcloud/api_key_dmcloud');
    include_once(_DIR_PLUGIN_DMCLOUD."lib/cloudkey-php/CloudKey.php");

    $cloudkey = new CloudKey($user_id, $api_key);

    # List some video and display the media_id and title:
    $res = $cloudkey->media->list(array('fields' => array('id', 'meta.title', 'meta.author', 'meta.url'), 'per_page' => 20, 'page' => 1));
    foreach($res->list as $media) {
        $url_vid = $cloudkey->media->get_stream_url(array('id' => $media->id));
        // $info = $cloudkey->media->info(array('id' => $media->id, 'fields' => array('id', 'assets.flv_h263_mp3.download_url')));
        // spip_log($info, 'test.' . _LOG_ERREUR);
        //$author_vid = $cloudkey->media->set_meta(array('id' => $media->id,  'keys' => array('title' => $media->keys->title)));
        // $assets = $author_vid = $cloudkey->media->get_assets(array('id' =>$media->id));
        spip_log($author_vid, 'test.' . _LOG_ERREUR);
        // spip_log($assets, 'test.' . _LOG_ERREUR);
        $list_dmcloud[] = array(
                'id' => $media->id, 
                'title' => $media->meta->title,
                'author' => 'null',
                'url' => $url_vid);
    }
    // spip_log($list_dmcloud, 'test.' . _LOG_ERREUR);
    return $list_dmcloud;

}