<?php $user->id ?>

<div class="modal-body clearfix general-form">

<?php if(count($logs) > 0 ){ ?>

<?php 
  foreach($logs as $log){
    
  $timestamp = strtotime($log['time_aut']);
?>
<div class="d-flex b-b p10 m0 text-break bg-white ticket-comment-container">
  <div class="flex-shrink-0 mr10">
    <span class="avatar avatar-sm">
      <?php if (empty($user->image)) { ?>
          <img src="<?php echo get_avatar("system_bot"); ?>" alt="..." />
      <?php } else { ?>
          <img src="<?php echo get_avatar($user->image); ?>" alt="..." />
      <?php
        }
      ?>
    </span>
  </div>
  
  <div>
    <div>
      <span class='dark strong'><?php echo $user->first_name.' '. $user->last_name?></span>;
    </div>
      <p>Acessou o sistema em <?php echo date("d-m-Y", $timestamp);?> às <?php echo date("H:i:s", $timestamp); ?></p>
      <div class="comment-image-box clearfix">
      </div>
    </div>

</div>
<?php
  }
?>

<?php } else { ?>
  <div>
    <h3>Não tem nenhum log para <?php echo $user->first_name.' '. $user->last_name?></h3>
  </div>
<?php } ?>

<div class="modal-footer">
    <button type="button" class="btn btn-default" data-bs-dismiss="modal"><span data-feather="x" class="icon-16"></span> <?php echo app_lang('close'); ?></button>
</div>
