   <?php foreach($comments as $comment) : ?>
    <?php if($comments) : ?>
          <div class="media d-block d-md-flex mt-4" id="commentbox">
            <div class="media-body text-center text-md-left ml-md-3 ml-0">
                <h5 class="mt-0 font-weight-bold"><?= $comment['writer'] ?>
                    <a class="pull-right">
                        <i class="fa fa-reply" id="reply"></i>
                    </a>
                </h5>
                <?= $comment['contents'] ?>
                <br>
                <span style="font-size:12px; float:right; color:#999;">작성 시간 : <?= passing_time($comment['regtime']); ?> <a style="color:black;">☒</a> </span> 
                <hr>
            </div>
          </div>
    <?php endif ?>
    <?php endforeach ?>