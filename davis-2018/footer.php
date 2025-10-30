<?php global $qode_options_passage; ?>
				
		</div>
	</div>
		<footer>
			<div class="footer_holder clearfix">
				
					
						<?php	
						$display_footer_widget = false;
						if ($qode_options_passage['footer_widget_area'] == "yes") $display_footer_widget = true;
						if($display_footer_widget): ?> 
						<div class="footer_top_holder">
							<div class="footer_top">
								
								
									<?php
										$header_in_grid = false;
										if ($qode_options_passage['header_in_grid'] == "yes") $header_in_grid = true;

									?>
									
									<?php if($header_in_grid){ ?>
										<div class="container">
											<div class="container_inner clearfix">
									<?php } ?>
									<div class="footer_top_inner">
										<div class="four_columns clearfix">
											<div class="column1">
												<div class="column_inner">
													<?php dynamic_sidebar( 'footer_column_1' ); ?>
												</div>
											</div>
											<div class="column2">
												<div class="column_inner">
													<?php dynamic_sidebar( 'footer_column_2' ); ?>
												</div>
											</div>
											<div class="column3">
												<div class="column_inner">
													<?php dynamic_sidebar( 'footer_column_3' ); ?>
												</div>
											</div>
										</div>
									</div>
									<?php if($header_in_grid){ ?>
										</div>
									</div>
								<?php } ?>
								
							</div>
						</div>
						<?php endif; ?>
						
						<?php
						$display_footer_text = false;
						if (isset($qode_options_passage['footer_text'])) {
							if ($qode_options_passage['footer_text'] == "yes") $display_footer_text = true;
						}
						if($display_footer_text): ?>
						<div class="footer_bottom_holder">
							<div class="footer_bottom">
                                <div class="container_inner">
                                <div class="two_columns_50_50 clearfix">
                                    <div class="column1">
                                        <div class="column_inner">
											<?php dynamic_sidebar( 'utility-menu' ); ?>
                                        </div>
                                    </div>
                                    <div class="column2">
                                        <div class="column_inner">
											<div class="spacer-15"></div>
											<?php dynamic_sidebar( 'footer_text' ); ?>
                                        </div>
                                    </div>
                                </div>  
                                <?php if(is_page(5)) { ?>
                                <a href="https://www.postali.com" title="Site design and development by Postali" target="blank"><img src="https://www.postali.com/wp-content/themes/postali-site/img/postali-tag.png" alt="Postali | Results Driven Marketing" style="display:block; max-width:250px; margin:10px auto 20px;"></a>
                                <?php } ?>
                                </div>
							</div>
						</div>
						<?php endif; ?>
			</div>
		</footer>
</div>
<!-- Call Rail --> 
<script type="text/javascript" src="//cdn.callrail.com/companies/929410491/c8541467377f528e95ac/12/swap.js"></script>
<!-- Intaker Chat -->
<script>(function (w,d,s,v,odl){(w[v]=w[v]||{})['odl']=odl;;
var f=d.getElementsByTagName(s)[0],j=d.createElement(s);j.async=true;
j.src='https://intaker.azureedge.net/widget/chat.min.js';
f.parentNode.insertBefore(j,f);
})(window, document, 'script','Intaker', 'davislawgroup');
</script>
<?php
global $qode_toolbar;
if(isset($qode_toolbar)) include("toolbar.php");

wp_footer(); ?>
</body>
</html>