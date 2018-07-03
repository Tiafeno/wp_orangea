<?php
/**
 * Created by IntelliJ IDEA.
 * User: Tiafeno
 * Date: 09/05/2018
 * Time: 09:20
 */

?>
						<footer>
							<div class="__org_footer">
								<div class="uk-padding-small" uk-grid>
									<div class="uk-width-1-6@m uk-width-1-3">
										<a href="#logo" title="Nosy Be Communication">
											<img src="<?= get_template_directory_uri() . '/img/SVG/nb-communication.svg' ?>" class="uk-logo" width="80"
											     onerror="this.onerror=null; this.src='<?= get_template_directory_uri() . '/img/2x/nb-communication@2x.png' ?>'">
										</a>
									</div>
									<div class="uk-width-5-6@m uk-width-2-3">
										<div class="uk-margin-large-right">
											<p style="text-align: right; color: #fff;">
												<a href="http://www.falicrea.com" title="FALICREA" target="_blank"
												   style="color: #858585; font-size: 9px; font-weight: 700; letter-spacing: 1px">
													<?= pll_e( "STRATÉGIE, CONCEPTION SOUTENU PAR" ) ?> <b>FALICREA</b>
												</a>
											</p>
										</div>
									</div>
								</div>
							</div>
						</footer>
					</div> <!-- .uk-section -->

				</div> <!-- .primary-content -->
			</div> <!-- #primary -->

		</div> <!-- .uk-offcanvas-content -->
  <?php
    wp_footer();
  ?>
	</body>
</html>
