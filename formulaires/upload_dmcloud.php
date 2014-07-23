<?php

/***************************************************************************\
 *  SPIP, Systeme de publication pour l'internet                           *
 *                                                                         *
 *  Copyright (c) 2001-2014                                                *
 *  Arnaud Martin, Antoine Pitrou, Philippe Riviere, Emmanuel Saint-James  *
 *                                                                         *
 *  Ce programme est un logiciel libre distribue sous licence GNU/GPL.     *
 *  Pour plus de details voir le fichier COPYING.txt ou l'aide en ligne.   *
\***************************************************************************/

/**
 * Gestion du formulaire pour dmcloud
 *
 * @package SPIP\Formulaires
**/
if (!defined('_ECRIRE_INC_VERSION')) return;

/**
 * Chargement du formulaire pour dmcloud
 *
 * @return array
 *     Environnement du formulaire
**/
function formulaires_upload_dmcloud_charger_dist(){

    $valeurs = array();

    return $valeurs;
    
}

/**
 * Vérifications du formulaire pour dmcloud
 *
 * @return array
 *     Tableau des erreurs
**/
function formulaires_upload_dmcloud_verifier_dist(){
    $erreurs = array();
            
    return $erreurs;
}

/**
 * Traitement du formulaire pour dmcloud
 *
 * @return array
 *     Retours du traitement
**/
function formulaires_upload_dmcloud_traiter_dist(){

    include_spip('inc/config');
    $user_id = lire_config('dmcloud/user_id_dmcloud');
    $api_key = lire_config('dmcloud/api_key_dmcloud');
    include_once(_DIR_PLUGIN_DMCLOUD."lib/cloudkey-php/CloudKey.php");

    $cloudkey = new CloudKey($user_id, $api_key);

    if (isset($_FILES['fichier']) AND $_FILES['fichier']['tmp_name']) {
        include_spip('action/ajouter_documents');
        include_spip('inc/joindre_document');

        $doc = &$_FILES['fichier'];

        if (!deplacer_fichier_upload($doc['tmp_name'], _DIR_TMP . $doc['name']))
            $erreurs['message_erreur'] = _T('copie_document_impossible');

        if (isset($erreurs['message_erreur'])){
            spip_unlink(_DIR_TMP . $doc['name']);
            unset ($_FILES['fichier']);
        }

        $file = $cloudkey->file->upload_file(_DIR_TMP . $doc['name']);
        $assets = array('mp4_h264_aac', 'mp4_h264_aac_hq', 'jpeg_thumbnail_medium', 'jpeg_thumbnail_source');
        $meta = array('title' => _request('titre'), 'author' => _request('auteur'));
        $media = $cloudkey->media->create(array('assets_names' => $assets, 'meta' => $meta, 'url' => $file->url));
        spip_unlink(_DIR_TMP . $doc['name']);
    }
        
    return array('editable' => true, 'message_ok'=>_T('upload_info_enregistree'));
}

?>
