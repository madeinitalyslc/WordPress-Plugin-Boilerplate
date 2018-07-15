<?php

/**
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
trait Plugin_Name_i18n_Trait
{
    /**
     * Use WordPress translation with text-domain
     *
     * @since 1.0.0
     *
     * @param string $id
     * @param mixed ...$args
     * @return string
     */
    public function trans( string $id, ...$args ) : string
    {
        $plugin_name = $this->get_plugin_name() ?: '';

        return __( sprintf( $id, $args ), $plugin_name );
    }
}