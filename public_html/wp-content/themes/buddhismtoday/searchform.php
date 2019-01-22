<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
  <label>
    <span class="screen-reader-text">Search for:</span>
    <input type="search" class="search-field" placeholder="Search …" value="" name="s" title="Search for:" autocomplete="off" />
    <input type="hidden" value="1" name="sentence" />
    <input type="hidden" value="post" name="post_type" id="post_type" />
  </label>
  <input type="submit" class="search-submit" value="Search" />
</form>

<!--

<form role="search" method="get" id="searchform" action="<?php echo home_url( '/' ); ?>">
    <div>
      <label class="screen-reader-text" for="s">Search for:</label>
      <input type="text" value="" name="s" id="s" placeholder="<?php the_search_query(); ?>" />
      <input type="submit" id="searchsubmit" value="Search" />
    </div>
</form>


-->