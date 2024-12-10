<?php declare( strict_types = 1 );

namespace PiotrPress\Composer\WPML;

use Composer\Plugin\PluginInterface;
use Composer\Composer;
use Composer\IO\IOInterface;

class Plugin implements PluginInterface {
    // https://git.onthegosystems.com/installer/installer/-/blob/develop/repositories.xml?ref_type=heads
    const REPOSITORY = 'https://d2salfytceyqoe.cloudfront.net/wpml33-products.json';

    public function activate( Composer $composer, IOInterface $io ) : void {
        if( ! $subscription_key = $composer->getConfig()->get( 'http-basic' )[ 'wpml.org' ][ 'username' ] ?? '' ) return;
        if( ! $user_id = $composer->getConfig()->get( 'http-basic' )[ 'wpml.org' ][ 'password' ] ?? '' ) return;

        foreach( @\json_decode( @\file_get_contents( self::REPOSITORY ), true )[ 'downloads' ][ 'plugins' ] ?? [] as $package )
            $composer->getRepositoryManager()->addRepository( $composer->getRepositoryManager()->createRepository( 'package', [
                'type' => 'package',
                'package' => [
                    'name' => 'wpml/' . $package[ 'slug' ],
                    'version' => $package[ 'version' ],
                    'type' => 'wordpress-plugin',
                    'dist' => [
                        'url' => $package[ 'url' ] . '&subscription_key=' . $subscription_key . '&user_id=' . $user_id . '&t=' . \time(),
                        'type' => 'zip'
                    ]
                ]
            ] ) );
    }

    public function deactivate( Composer $composer, IOInterface $io ) : void {}
    public function uninstall( Composer $composer, IOInterface $io ) : void {}
}