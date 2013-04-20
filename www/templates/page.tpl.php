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
        <?php
        $i = 0; 
        foreach ($PAGE_VARS['types']['photos'] as $photo) {
        	if($i == 0): ?>
        	<img src="<?= $photo['original']->picture?>" class="largepic" />
        	<div class="bottomImage">
            <div class="caption">
              <?php if(property_exists($photo['original'], "message")): ?>
          		  <span><?= Truncate($photo['original']->message, 65) ?></span>
              <?php endif ?>
          	</div>
          	<div class="statusnums">
          		<img src="img/facebook-thumbs-up.png" />
          		<span class="likes"><?= $photo['likes'] ?></span>
          	</div>
          </div>
        	<?php else: ?>
        	<img src="<?= $photo['original']->picture?>" class="thumb" / >
        	<?php
        	endif;
        	$i++;
        }
        ?>
        </div>
        <!-- Mutual Friend list -->
        <!-- <div class="row"> -->
          <h3>Mutual Friends</h3>
        <?php
        foreach ($PAGE_VARS['types']['mutualFriends'] as $friend) {
        	?>
        	<div class="mutualfriend">
	            <img src="<?=$friend->picture->data->url?>"/>
          	</div>
        	<?php	
        }
        ?>
        <!-- </div> -->
      </div>
      <!-- Status feeds -->
      <div class="span4">
      	<?php
      	foreach ($PAGE_VARS['types']['status'] as $status) {
      		?>
  		<div class="status">
          <p><?=$status["original"]->message ?></p>
          <div class="statusnums">No likes, loser!</div>
        </div>
      		<?php
      	}
      	?>
      </div>  
    </div>
    <div class="row">
    </div>
  </div>