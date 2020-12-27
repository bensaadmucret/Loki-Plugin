
<style>

 /*
 *
 * ==========================================
 * CUSTOM UTIL CLASSES
 * ==========================================
 */
    .nav-pills-custom .nav-link-cdn {
        color: #aaa;
       background: #fff
        position: relative;
    }

    .nav-pills-custom .nav-link-cdn.active {
        color: #ffffff;
        background: background-color: rgba(239, 246, 255, .5);
    }


    /* Add indicator arrow for the active tab */
    @media (min-width: 992px) {
        .nav-pills-custom .nav-link-cdn::before {
            content: '';
            display: block;
            border-top: 8px solid transparent;
            border-left: 10px solid #fff;
            border-bottom: 8px solid transparent;
            position: absolute;
            top: 50%;
            right: -10px;
            transform: translateY(-50%);
            opacity: 0;
        }
    }

    .nav-pills-custom .nav-link-cdn.active::before {
        opacity: 1;
    }

    #countdown{
        padding:15px;
        margin:15px 15px 15px 15px;
        background-color:tomato;
        color:#fff;
        text-align:center;
        border: 5px solid #fff;
        -moz-box-shadow: 8px 8px 12px #aaa;
        -webkit-box-shadow: 8px 8px 12px #aaa;
        box-shadow: 8px 8px 12px #555;
        font-weight: bold;
        font-size: 1.2em;
        font-family: cursive;


    }




</style>

<?php $arr = get_option('loki_option_dashboard');

foreach ($arr['loki_group'] as $key => $value):
$meta = $value['title'];
$meta_author = get_the_author_meta($meta, get_current_user_id());

    if ( $meta_author == $value['title']. " CONFIRMEE "):		
        $key++;
        $arr['loki_group'][$key]['lock_radio']="0";
        $id = get_the_ID();
    endif;
endforeach;
?>



<section class="py-5 header">
    <div class="container py-4">
        <header class="text-center mb-5 pb-5 text-white">
            <h1 class="display-4"></h1>
            <p class="font-italic mb-1"></p>
        </header>
        <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link-cdn shadow-lg  mb-3 p-3  active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Informations personnelles</span></a>

                    <a class="nav-link-cdn mb-3 p-3 shadow-lg " id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                        <i class="fa fa-star mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Bienvenue</span></a>

                    <?php foreach ($arr['loki_group'] as  $value):?>
                        <?php if ( $value['lock_radio'] == false || get_the_author_meta( str_replace(' ', '', $value['title']) ) == str_replace(' ', '', $value['title']). " CONFIRMEE " ): ?>
                        <a class="nav-link-cdn mb-3 p-3 shadow-lg " id="v-pills-profile-tab" data-toggle="pill" href="#<?= str_replace(' ', '', $value['title']);?>" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            <i class="fa fa-check mr-2"></i>
                            <span class="font-weight-bold small text-uppercase"><?= $value['title'];  ?></span>
                        </a>
                            <?php else:

                            ob_start();?>
                            <a class=" disabled nav-link mb-3 p-3 shadow-lg " id="v-pills-profile-tab" data-toggle="pill" href="#<?= str_replace(' ', '', $value['title']);?>" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            <i class="fa fa-lock mr-2"></i>
                            <span class="font-weight-bold small text-uppercase"><?= str_replace(' ', '', $value['title']); ?></span>
                            </a>
                           <?php $content = ob_get_contents();
                            ob_end_clean();
                            echo $content; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <a class="nav-link-cdn mb-3 p-3 shadow-lg " id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
						<i class="fab fa-product-hunt mr-2"></i>                      
                        <span class="font-weight-bold small text-uppercase">OFFRE</span></a>
                </div>
            </div>

            <div class="col-md-9">
               <div class="float-right" style="margin-top: -15px;"> <span id="countdown">01:30:10</span> </div>
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade shadow-lg rounded bg-white show active p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h4 class="text-3xl mb-4">Informations personnelles</h4>
                        <p class="mb-2"> <?php echo do_shortcode( '[gravityform id="10" title="false" description="false" ajax="true"]' ); ?> </p>
                    </div>

                    <div class="tab-pane fade shadow-lg  rounded bg-white p-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <h4 class="font-italic mb-4"><?php echo $arr['id_gros_titre_dashboard'] ?></h4>
						<div class="grid grid-cols-1 gap-4">
                        <div><p class=" text-muted mb-2"><?php echo $arr['id_introduction'] ?></p></div>
						 <p class="mb-2"><?php if(is_array($arr['id_shortcode'])){?>
                                <?php  for ($i = 0, $iMax = count($arr['id_shortcode']); $i < $iMax; $i++ ): ?>
                                    <?php echo do_shortcode($arr['id_shortcode'][$i]); ?>
                                <?php endfor;?> </p>
                            <?php }?>	
						</div>	
                    </div>

                    <?php foreach ($arr['loki_group'] as $value):?>
                        <div class="tab-pane fade shadow-lg rounded bg-white p-5" id="<?= str_replace(' ', '', $value['title']);?>" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <h4 class=" text-3xl mb-4"><?= $value['title'] ?></h4>
                            <p class="text-muted mb-2"> <?= $value['id_contenu'] ?> </p>
                            <?php if(is_array($value['description'])){?>
                            <?php  for ($i = 0, $iMax = count($value['description']); $i < $iMax; $i++ ): ?>
                                <?php echo do_shortcode($value['description'][$i]); ?>
                            <?php endfor;?>
                            <?php }
                            if($value['validation_radio']): ?>
                                <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
                                    <div class="form-check">
                                        <input class="rounded text-pink-500" type="checkbox" value="" >
                                        <label class="inline-flex items-center" for="defaultCheck1">
                                            <?php echo $value['texte_de_validation']; ?>
                                        </label>
                                    </div>
                                    <input class="prodId" name="prodId" type="hidden" value="<?php echo str_replace(' ', '', $value['title']);?>">
                                    <input type="hidden" name="action" value="my-action">
                                    <?php wp_nonce_field( 'update-user', 'validation' ); ?>
                                    <button type="submit" class="btn btn-primary go">validation</button>
                                </form>
                            <?php endif; ?>
                        </div>


                    <?php endforeach; ?>

                    <div class="tab-pane fade shadow-lg rounded bg-white p-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
						<div class="flex justify-between">  
						<div><h2 class=" text-3xl mb-4">OFFRE</h2></div>
						</div>	
						
						<div class="grid grid-cols-1 md:grid-cols-1"> 
						
						<div><h3 class="mb-2">L'OFFRE DIAGINBOX</h3>
                        <p class="mb-2">.</p></div>
						<div><h3 class="mb-2"></h3>
                        <p class="mb-2"></p></div>
						
						<div><h3 class="mb-2"></h3>
                        <p class="mb-2"></p></div>
						 </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>

    (function(){
        jQuery(document).ready(function($) {
            let time = "08:30:10",
                parts = time.split(':'),
                hours = +parts[0],
                minutes = +parts[1],
                seconds = +parts[2],
                span = $('#countdown');

            function correctNum(num) {
                return (num<10)? ("0"+num):num;
            }

            let timer = setInterval(function(){
                seconds--;
                if(seconds == -1) {
                    seconds = 59;
                    minutes--;

                    if(minutes == -1) {
                        minutes = 59;
                        hours--;

                        if(hours==-1) {
                            alert("timer finished");
                            clearInterval(timer);
                            return;
                        }
                    }
                }
                span.text(correctNum(hours) + ":" + correctNum(minutes) + ":" + correctNum(seconds));
            }, 1000);
        });
    })()
</script>