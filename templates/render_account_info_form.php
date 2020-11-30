<?php ?>

<style>

    div.bhoechie-tab-container{
        z-index: 10;
        background-color: #ffffff;
        padding: 0 !important;
        border-radius: 4px;
        -moz-border-radius: 4px;
        border:1px solid #ddd;
        margin-top: 20px;
        margin-left: 50px;
        -webkit-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        box-shadow: 0 6px 12px rgba(0,0,0,.175);
        -moz-box-shadow: 0 6px 12px rgba(0,0,0,.175);
        background-clip: padding-box;
        opacity: 0.97;
        filter: alpha(opacity=97);
    }
    div.bhoechie-tab-menu{
        padding-right: 0;
        padding-left: 0;
        padding-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a{
        margin-bottom: 0;
    }
    div.bhoechie-tab-menu div.list-group>a .glyphicon,
    div.bhoechie-tab-menu div.list-group>a .fa {
        color: #5A55A3;
    }
    div.bhoechie-tab-menu div.list-group>a:first-child{
        border-top-right-radius: 0;
        -moz-border-top-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a:last-child{
        border-bottom-right-radius: 0;
        -moz-border-bottom-right-radius: 0;
    }
    div.bhoechie-tab-menu div.list-group>a.active,
    div.bhoechie-tab-menu div.list-group>a.active .glyphicon,
    div.bhoechie-tab-menu div.list-group>a.active .fa{
        background-color: #5A55A3;
        background-image: #5A55A3;
        color: #ffffff;
    }
    div.bhoechie-tab-menu div.list-group>a.active:after{
        content: '';
        position: absolute;
        left: 100%;
        top: 50%;
        margin-top: -13px;
        border-left: 0;
        border-bottom: 13px solid transparent;
        border-top: 13px solid transparent;
        border-left: 10px solid #5A55A3;
    }

    div.bhoechie-tab-content{
        background-color: #ffffff;
        /* border: 1px solid #eeeeee; */
        padding-left: 20px;
        padding-top: 10px;
    }

    div.bhoechie-tab div.bhoechie-tab-content:not(.active){
        display: none;
    }

</style>
<?php $arr = get_option('loki_option_dashboard'); ?>
<div class="tabs">
  <input type="radio" name="tabs" id="tabone" checked="checked">
  <label for="tabone">ACCUEIL</label>
  <div class="tab">
    <h1><?php echo  $arr['id_gros_titre_dashboard'];?></h1>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  </div>

  <?php //dump($arr['loki_group']); ?>

  <?php foreach ($arr['loki_group'] as $value):?>
  <input type="radio" name="tabs" id="<?= $value['title']; ?>">
  <label for="<?= $value['title']; ?>"><?php echo $value['lock_radio'] ? '<i class="fa fa-lock" aria-hidden="true" style="padding-right: 10px;"></i>' :  '<i class="fa fa-unlock-alt" aria-hidden="true"style="padding-right: 10px;"></i>';?> <?= $value['title']; ?> </label>
  <div class="tab">
   <?php if($value['lock_radio']):?>
       <div class="alert alert-danger" role="alert">
           This is a danger alert with <a href="#" class="alert-link">an example link</a>. Give it a click if you like.
       </div>
       <div class="alert alert-danger" role="alert">
           <h4 class="alert-heading">Well done!</h4>
           <p>Aww yeah, you successfully read this important alert message. This example text is going to run a bit longer so that you can see how spacing within an alert works with this kind of content.</p>
           <hr>
           <p class="mb-0">Whenever you need to, be sure to use margin utilities to keep things nice and tidy.</p>
       </div>
    <?php  else:
       echo $value['id_contenu'];
       if(is_array($value['description'])){?>
              <?php  for ($i = 0, $iMax = count($value['description']); $i < $iMax; $i++ ): ?>
                <?php echo do_shortcode($value['description'][$i]); ?>
              <?php endfor;?>
      <?php }
    if($value['validation_radio']): ?>
        <form>
          <div class="form-group">
              <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="gridCheck">
                  <label class="form-check-label" for="gridCheck">
                    <?php echo $value['texte_de_validation']; ?>
                  </label>
              </div>
          </div>
          <button type="submit" class="btn btn-primary">validation</button>
      </form>
    <?php endif; ?>

   ?>
    <?php endif; ?>

  </div>

 <?php
  endforeach;
  ?>

</div>
