<style>

    /*
 *
 * ==========================================
 * CUSTOM UTIL CLASSES
 * ==========================================
 */
    .nav-pills-custom .nav-link {
        color: #aaa;
        background: #fff;
        position: relative;
    }

    .nav-pills-custom .nav-link.active {
        color: #45b649;
        background: #fff;
    }


    /* Add indicator arrow for the active tab */
    @media (min-width: 992px) {
        .nav-pills-custom .nav-link::before {
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

    .nav-pills-custom .nav-link.active::before {
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
    if ( get_the_author_meta( $value['title']) == $value['title']. " CONFIRMEE "):
        $key++;
        $arr['loki_group'][$key]['lock_radio']="0";
        $id = get_the_ID();
    endif;
endforeach;
?>

<?php dump($arr['loki_group']); ?>
<?php  ?>
<?php //dump($value['lock_radio']); //dump($arr['loki_group'][1]['validation_radio']); ?>

<section class="py-5 header">
    <div class="container py-4">
        <header class="text-center mb-5 pb-5 text-white">
            <h1 class="display-4">Bootstrap vertical tabs</h1>
            <p class="font-italic mb-1">Making advantage of Bootstrap 4 components, easily build an awesome tabbed interface.</p>
            <p class="font-italic">Snippet by
                <a class="text-white" href="https://bootstrapious.com/">
                    <u>Bootstrapious</u>
                </a>
            </p>
        </header>


        <div class="row">
            <div class="col-md-3">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <a class="nav-link mb-3 p-3 shadow active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="fa fa-user-circle-o mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Personal information</span></a>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab" aria-controls="v-pills-messages" aria-selected="false">
                        <i class="fa fa-star mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Reviews</span></a>
                        <?php //get_the_author_meta( $value['title'] )== $value['title']. " CONFIRMEE " ?>
                    <?php foreach ($arr['loki_group'] as  $value):?>

                            <?php //dump($value['lock_radio']); ?>

                        <?php if ( $value['lock_radio'] == false || get_the_author_meta( str_replace(' ', '', $value['title']) ) == str_replace(' ', '', $value['title']). " CONFIRMEE " ): ?>

                        <a class="nav-link mb-3 p-3 shadow" id="v-pills-profile-tab" data-toggle="pill" href="#<?= str_replace(' ', '', $value['title']);?>" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            <i class="fa fa-check mr-2"></i>
                            <span class="font-weight-bold small text-uppercase"><?= $value['title'];  ?></span>
                        </a>
                            <?php else:

                            ob_start();?>
                            <a class=" disabled nav-link mb-3 p-3 shadow" id="v-pills-profile-tab" data-toggle="pill" href="#<?= str_replace(' ', '', $value['title']);?>" role="tab" aria-controls="v-pills-profile" aria-selected="false">
                            <i class="fa fa-lock mr-2"></i>
                            <span class="font-weight-bold small text-uppercase"><?= str_replace(' ', '', $value['title']); ?></span>
                            </a>
                           <?php $content = ob_get_contents();
                            ob_end_clean();
                            echo $content; ?>
                        <?php endif; ?>
                    <?php endforeach; ?>

                    <a class="nav-link mb-3 p-3 shadow" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab" aria-controls="v-pills-settings" aria-selected="false">
                        <i class="fa fa-check mr-2"></i>
                        <span class="font-weight-bold small text-uppercase">Confirm booking</span></a>
                </div>
            </div>


            <div class="col-md-9">
               <div class="float-right" style="margin-top: -15px;"> <span id="countdown">01:30:10</span> </div>
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade shadow rounded bg-white show active p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                        <h4 class="font-italic mb-4">Personal information</h4>
                        <p class="font-italic text-muted mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>

                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                        <h4 class="font-italic mb-4">Reviews</h4>
                        <p class="font-italic text-muted mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    </div>

                    <?php foreach ($arr['loki_group'] as $value):?>

                        <div class="tab-pane fade shadow rounded bg-white p-5" id="<?= str_replace(' ', '', $value['title']);?>" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                            <h4 class="font-italic mb-4">Bookings</h4>
                            <p class="font-italic text-muted mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            <?php if($value['validation_radio']): ?>
                                <form action="<?php echo esc_url( admin_url('admin-post.php') ); ?>" method="post">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" >
                                        <label class="form-check-label" for="defaultCheck1">
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

                    <div class="tab-pane fade shadow rounded bg-white p-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                        <h4 class="font-italic mb-4">Confirm booking</h4>
                        <p class="font-italic text-muted mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <p class="font-italic text-muted mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                        <p class="font-italic text-muted mb-2">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<script>

    (function(){
        jQuery(document).ready(function($) {
            var time = "08:30:10",
                parts = time.split(':'),
                hours = +parts[0],
                minutes = +parts[1],
                seconds = +parts[2],
                span = $('#countdown');

            function correctNum(num) {
                return (num<10)? ("0"+num):num;
            }

            var timer = setInterval(function(){
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