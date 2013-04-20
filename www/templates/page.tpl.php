
  </div>
    
  <div id="results" class="container">
    <div class="row">
      <!-- Images -->
      <div class="span8">
        <div class="images">
          <?php
            $photos = $PAGE_VARS['types']['photos'];
            $photo = array_shift($photos);
          ?>
          <div class="bannerImage">
            <a href="<?= $photo['original']->link?>">
              <img src="<?= $photo['original']->picture?>" class="largepic" />
              <div class="bottomImage">
                <div class="caption shiddy">
                  <?php if(property_exists($photo['original'], "message")): ?>
                    <span><?= Truncate($photo['original']->message, 65) ?></span>
                  <?php endif; ?>
                </div>
                <div class="statusnums">
                  <img src="img/facebook-thumbs-up.png" />
                  <span class="likes shiddy"><?= $photo['likes'] ?></span>
                </div>
              </div>
            </a>
          </div>

          <div class="smallImages">
            <?php
            foreach ($photos as $photo) { ?>
            <a href="<?= $photo['original']->link?>">
              <div class="thumbwrapper">
                <div class="thumboverflowwrapper">
                  <img src="<?= $photo['original']->picture?>" class="thumb" />
                </div>
                <div class="bottomImage">
                  <div class="statusnums">
                    <img src="img/facebook-thumbs-up.png" />
                    <span class="likes shiddy"><?= $photo['likes'] ?></span>
                  </div>
                </div>
              </div>
            </a>
            <?php
            }
            ?>
          </div>

        </div>
      </div>
      <!-- Status feeds -->
      <div class="span4">
<<<<<<< HEAD
        <h3>Popular Statuses</h3>
      	<?php
      	foreach ($PAGE_VARS['types']['status'] as $status) {
      		?>
  		  <div class="status">
          <p><img src="https://graph.facebook.com/<?= $_GET['friend']?>/picture">
            <?=$status["original"]->message ?></p>
          <div class="statusnums">      
            <img src="img/facebook-thumbs-up.png" >     
            <?= $status['likes'] ?>     
=======
      	<div class="statuses">
          <?php
        	foreach ($PAGE_VARS['types']['status'] as $status) {
        		?>
    		  <div class="status">
            <p><?=$status["original"]->message ?></p>
            <div class="statusnums">      
              <img src="img/facebook-thumbs-up.png" >     
              <?= $status['likes'] ?>     
            </div>
>>>>>>> a48f2193c325a2515a0ec62520e5ff9695ec3865
          </div>
        		<?php
         
        	}
          ?>
        </div>
        <div class="mutualFriends">
          <?php
          foreach ($PAGE_VARS['types']['mutualFriends'] as $friend) {
            for ($i = 0; $i < 2; $i++) {
          ?>
            <div class="mutualfriend">
              <img src="<?=$friend->picture->data->url?>"/>
            </div>
            <?php 
             }
          }
          ?>
        </div>
      </div>  
    </div>
    <div class="row">
    </div>
  </div>