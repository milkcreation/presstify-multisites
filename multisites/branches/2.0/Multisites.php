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

use tiFy\App\Dependency\AbstractAppDependency;

final class Multisites extends AbstractAppDependency
{
    /**
     * {@inheritdoc}
     */
    public function boot()
    {
        $this->app->appAddAction('admin_enqueue_scripts', [$this, 'admin_enqueue_scripts']);
        $this->app->appAddAction('user_new_form', [$this, 'user_new_form']);
    }

    /**
     * Mise en file de scripts de l'interface d'administration.
     *
     * @return void
     */
    public function admin_enqueue_scripts()
    {
        \wp_enqueue_script('tiFyMultisites', class_info($this)->getUrl() . '/assets/js/Multisites.js', ['jquery'], 171106);
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
