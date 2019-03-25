<?php

namespace tiFy\Plugins\Multisites;

/**
 * Class Multisites
 *
 * @desc Extension PresstiFy de gestion de Wordpress multisites.
 * @author Jordy Manner <jordy@tigreblanc.fr>
 * @package tiFy\Plugins\Multisites
 * @version 2.0.2
 */
final class Multisites
{
    /**
     * CONSTRUCTEUR.
     *
     * @return void
     */
    public function __construct()
    {
        add_action('admin_enqueue_scripts', function () {
            wp_enqueue_script(
                'multisites',
                class_info($this)->getUrl() . '/Resources/assets/js/scripts.js',
                ['jquery'],
                171106
            );
        });

        add_action('user_new_form', function ($context) {
            if (!is_multisite()|| !current_user_can('manage_network_users')) :
                return;
            elseif (!in_array($context, ['add-existing-user', 'add-new-user'])) :
                return;
            endif;

            //Force la création d'un nouvel utilisateur sans demande de confirmation par email.
            ?><input type="hidden" name="noconfirmation" value="1" /><?php
        });
    }
}
