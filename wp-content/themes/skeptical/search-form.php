<div class="search_main widget">
    <form method="get" class="searchform" action="<?php echo home_url( '/' ); ?>" >
        <input type="text" class="field s" name="s" value="<?php _e( 'Search...', 'woothemes' ) ?>" onfocus="if (this.value == '<?php _e( 'Search...', 'woothemes' ) ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e( 'Search...', 'woothemes' ) ?>';}" />
        <input type="submit" class="submit button" name="submit" value="<?php _e( 'Search', 'woothemes' ); ?>" />
    </form>
    <div class="fix"></div>
</div>