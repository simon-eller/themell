   <?php
    $site_url = get_site_url( $blog_id = null, $path = '', $scheme = null );
   ?>

   <!--End of container-->
		</div>
	<!--End of container fluid-->
	</div>
    
    <!--Footer-->
    <div class="container-fluid themell-bg1 pt-3 pb-3">
        <div class="container">
            <?php dynamic_sidebar('footer-1'); ?>
            <div class="row">
            <div class="col-12 col-md-6">
                <p><a class="a-tx" href="<?php echo $site_url ?>/imprint">imprint</a><br>
                <a class="a-tx" href="<?php echo $site_url ?>/privacy">privacy policy</a></p>
            </div>

            <div class="col-12 col-md-6 text-end">
                <a class="a-tx" href="https://github.com/simon-eller/themell">© Themell 2021</a>
                
            </div>

            </div>
        </div>
    </div>
    <!--End of Footer-->

<!-- Add Javascript -->  
<?php
    wp_footer();
?>

</body>
</html> 
