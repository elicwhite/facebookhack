
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
          <a href="<?= $photo['original']->link?>">
            <div class="bannerImage">
              <div class="banneroverflowwrapper">
                <img src="<?= $photo['original']->picture?>" class="largepic" />
              </div>
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
      	<div class="statuses">
          <?php
        	foreach ($PAGE_VARS['types']['status'] as $status) {
        		?>
    		  <div class="status">
            <div class="statusContent">
              <div class="statusTop">
                <div class="avatar">
                  <img src="http://graph.facebook.com/<?=$_GET['friend']?>/picture" />
                </div>
                <p><?=$status["original"]->message ?></p>
              </div>
              <div class="statusbottom">
                <div class="datestamp pull-left">
                  <span><?= $status['original']->created_time ?></span>
                </div>
                <div class="statusnums">      
                  <img src="img/facebook-thumbs-up.png" >     
                  <?= $status['likes'] ?>     
                </div>
              </div>
            </div>
          </div>
        		<?php
        	}
          ?>
        </div>
        <div class="mutualFriends">
          <?php
          foreach ($PAGE_VARS['types']['mutualFriends'] as $friend) {
          ?>
            <a href="http://facebook.com/<?=$friend->id?>" data-toggle="tooltip" title="<?=$friend->name?>">
              <div class="mutualfriend">
                <img src="<?=$friend->picture->data->url?>"/>
              </div>
            </a>
            <?php 
            }
          ?>
        </div>
      </div>  
    </div>
    <div class="row">
    </div>
  </div>