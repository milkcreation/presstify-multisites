<?php

/**
 * @name Multisites
 * @desc Extension PresstiFy de gestion de Wordpress multisites.
 * @author Jordy Manner <jordy@milkcreation.fr>
 * @package presstiFy
 * @namespace \tiFy\Plugins\Multisites
 * @version 2.0.0
 */

namespace tiFy\Plugins\Multisites;

use tiFy\Apps\AppController;

final class Multisites extends AppController
{
    /**
     * Initialisation du controleur.
     *
     * @return void
     */
    public function appBoot()
    {
        // Déclaration des événement de déclenchement
        $this->appAddAction('admin_enqueue_scripts');
        $this->appAddAction('user_new_form');
    }

    /**
     * Mise en file de scripts de l'interface d'administration.
     *
     * @return void
     */
    public function admin_enqueue_scripts()
    {
        \wp_enqueue_script('tiFyPluginsMultisites', $this->appUrl() . '/assets/js/Multisites.js', ['jquery'], 171106);
    }

    /**
     * Ajout de champs de pour la création de nouveaux utilisateurs.
     *
     * @param string $context
     *
     * @return string
     */
    public function user_new_form($context)
    {
        if (!is_multisite()|| !current_user_can('manage_network_users')) :
            return;
        endif;
        if (!in_array($context, ['add-existing-user', 'add-new-user'])) :
            return;
        endif;

        //Force la création d'un nouvel utilisateur sans demande de confirmation par email
?><input type="hidden" name="noconfirmation" value="1" /><?php
    }
}
