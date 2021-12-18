<?php

namespace PixelYourSite;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

<div class="wrap" id="pys">
	<h1><?php _e( 'PixelYourSite Pro', 'pys' ); ?></h1>
	<div class="container">
		<div class="row">
			<div class="col">
				<h2 class="section-title">Licenses</h2>

				<form method="post" enctype="multipart/form-data">

					<?php wp_nonce_field( 'pys_save_settings' ); ?>

                    <div class="card card-static">
                        <div class="card-header">
                            PixelYourSite PRO
                        </div>
                        <div class="card-body">
                            <?php renderLicenseControls( PYS() ); ?>
                        </div>
                    </div>

					<?php foreach ( PYS()->getRegisteredPlugins() as $plugin ) : /** @var Plugin|Settings $plugin */ ?>

                        <?php if ( $plugin->getSlug() == 'head_footer' ) { continue; } ?>

                        <div class="card card-static">
                            <div class="card-header">
                                <?php esc_html_e( $plugin->getPluginName() ); ?>
                            </div>
                            <div class="card-body">
                                <?php renderLicenseControls( $plugin ); ?>
                            </div>
                        </div>

                    <?php endforeach; ?>

					<hr>
					<div class="row justify-content-center">
						<div class="col-4">
							<button class="btn btn-block btn-sm btn-save">Save Settings</button>
						</div>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>
