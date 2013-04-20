<div id="search" class="container">
    <div class='input-append'>
      <input id="search-field" type="text" autocomplete="off" data-provide="typeahead" placeholder="Search friend..." />
      <button id="search-button" class='btn add-on'>
        <i class="icon-search"></i>
      </button>
    </div>
  </div>
    
  <div id="results" class="container">
    <div class="row">
      <!-- Images -->
      <div class="span8">
        <div class="images">
          <img src="a" class="largepic" alt=""><br>
          <img src="a" class="thumb" alt="">
          <img src="a" class="thumb" alt="">
          <img src="a" class="thumb" alt="">
        </div>
        <!-- Mutual Friend list -->
        <!-- <div class="row"> -->
          <h3>Mutual Friends</h3>
        <?php
        foreach ($PAGE_VARS['types']['mutualFriends'] as $friend) {
        	?>
        	<div class="mutualfriend">
	            <img src="<?=$friend->picture->data->url?>"/>;
          	</div>
        	<?php	
        }
        ?>
        <!-- </div> -->
      </div>
      <!-- Status feeds -->
      <div class="span4">
        <div class="status">
          <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
          <div class="statusnums">No likes, loser!</div>
        </div>
        <div class="status">
          <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
          <div class="statusnums">No likes, loser!</div>
        </div>
        <div class="status">
          <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
          <div class="statusnums">No likes, loser!</div>
        </div>
        <div class="status">
          <p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>
          <div class="statusnums">No likes, loser!</div>
        </div>
      </div>  
    </div>
    <div class="row">
    </div>
  </div>