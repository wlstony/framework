	</div><!-- #main -->
	
    <div id="footer">
	<footer id="colophon" class="site-footer" role="contentinfo"<?php kotenhanagara_wp_add_custom_footer_style(); ?>>

	<div class="fotterWidgetArea">

    <aside id="aboutme" class="widget">
	<?php if(dynamic_sidebar("Aboutme") ) ;?>
    </aside>
    
    <aside id="link" class="widget">
	<?php if(dynamic_sidebar("Links") ) ;?>
    </aside>
    
    </div>
    
		<div class="site-info">
			<?php do_action( 'kotenhanagara_credits' ); ?>
			Copyright &copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?> All Rights Reserved.
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->
</div>
<?php wp_footer(); ?>
</body>
</html>