<?php
/**
 * Created by PhpStorm.
 * User: mzb
 * Date: 17/11/2020
 * Time: 10:41
 */

namespace Inc\Base;


class DashboardShorcode
{
    /**
     * DashboardShorcode constructor.
     */
    public function __construct ()
    {
        add_shortcode( 'dashboard', [$this, 'tabs_dashboard']);
    }


    public function tabs_dashboard(){ ?>

    <style>
        * {
            padding: 0;
            margin: 0;
            list-style: none;
            box-sizing: border-box;
            outline: none;
            font-weight: normal;
        }

        body {
            background: #1ABC9C;
            font-family: lato,"Segoe UI","Microsoft YaHei";
        }

        a {
            color: #000;
            text-decoration: none;
        }

        header {
            color: #fff;
            text-align: center;
            min-height: 140px;
            margin-bottom: 60px;
        }

        header h1{
            margin-top: 100px;
            font-size: 50px;
            margin-bottom: 20px;
            font-weight: 100;
        }

        header a{
            font-size: 18px;
            margin-left: 20px;
        }

        .copyright {
            font-size: 25px;
            font-weight: 100;
            color: #fff;
            text-align: center;
            margin: 100px 0;
        }

        .copyright a {
            color: #fff;
        }

        .fl {
            float: left
        }

        .fr {
            float: right
        }

        .ease {
            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            -ms-transition: all .5s;
            -o-transition: all .5s;
            transition: all .5s;
        }

        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Backend Panel Start */

        .clear-backend {
            background: #fff;
            width: 100%;
            height: 800px;
            position: relative;
        }

        .avatar {
            background: #f0f0f0;
            width: 200px;
            height: 200px;
        }

        .avatar div {
            width: 150px;
            height: 150px;
            overflow: hidden;
            position: relative;
            top: 25px;
            left: 25px;
        }

        .avatar div img {
            width: 100%;
            height: auto;
            border-radius: 50%;
        }

        .avatar div img:hover  {
            transform: rotate(360deg);
        }

        .clear-backend > input {
            position: absolute;
            filter: alpha(opacity=0);
            opacity: 0;
        }

        .clear-backend > input:hover {
            cursor: pointer;
        }

        .clear-backend > input:hover + span,
        .clear-backend > input:checked + span {
            background: #fff;
            color: #1ABC9C;
        }
        .clear-backend > input:checked + span + i {
            color: #1ABC9C;
        }

        .clear-backend > i {
            position: absolute;
            margin-top: -40px;
            padding: 0 20px;
            font-size: 20px;
        }

        .clear-backend > span,
        .clear-backend > i {
            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            -o-transition: all .5s;
            transition: all .5s;
        }

        .clear-backend > input,
        .clear-backend > span {
            background: #f0f0f0;
            display: block;
            width: 200px;
            height: 60px;
            line-height: 60px;
            text-align: center;
            z-index: 9;
        }

        .top-bar {
            background: #f0f0f0;
            color: #000;
            position: absolute;
            top: 0;
            right: 0;
            width: calc(100% - 200px);
            height: 60px;
            line-height: 60px;
            font-size: 20px;
            z-index: 9;
        }

        .top-bar li {
            float: right;
        }

        .top-bar a {
            display: block;
            padding: 0 20px;
            -webkit-transition: all .5s;
            -moz-transition: all .5s;
            -o-transition: all .5s;
            transition: all .5s;
        }

        .top-bar a:hover {
            color: #1ABC9C;
        }

        .top-bar li:hover {
            background: #fff;
        }

        .tab-content {
            position: absolute;
            top: 0;
            right: 0;
            width: calc(100% - 200px);
            height: 100%;
            padding-top: 60px;
            overflow: hidden;
        }

        .tab-content section {
            position: absolute;
            width: 100%;
            height: 100%;
            padding: 20px;
            display: none;
        }

        .clear-backend > input.tab-1:checked ~ .tab-content .tab-item-1 {
            display: block;
        }

        .clear-backend > input.tab-2:checked ~ .tab-content .tab-item-2 {
            display: block;
        }

        .clear-backend > input.tab-3:checked ~ .tab-content .tab-item-3 {
            display: block;
        }

        .clear-backend > input.tab-4:checked ~ .tab-content .tab-item-4 {
            display: block;
        }

        .clear-backend > input.tab-5:checked ~ .tab-content .tab-item-5 {
            display: block;
        }

        .clear-backend > input.tab-6:checked ~ .tab-content .tab-item-6 {
            display: block;
        }

        .clear-backend > input.tab-7:checked ~ .tab-content .tab-item-7 {
            display: block;
        }

        .clear-backend > input.tab-8:checked ~ .tab-content .tab-item-8 {
            display: block;
        }

        .clear-backend > input.tab-9:checked ~ .tab-content .tab-item-9 {
            display: block;
        }

        .clear-backend > input.tab-10:checked ~ .tab-content .tab-item-10 {
            display: block;
        }


        /* Responsive */
        @media only screen and (max-width: 641px) {
            .avatar,
            .clear-backend > input,
            .clear-backend > span {
                width: 60px;
                height: 60px;
            }
            .clear-backend > span {
                filter: alpha(opacity=0);
                opacity: 0;
            }
            .avatar div {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                top: 5px;
                left: 5px;
            }
            .top-bar,
            .tab-content {
                width: calc(100% - 60px);
            }
        }
    </style>

        <?php
          dump(get_option('loki_option_dashboard'));
           $data = get_option('loki_option_dashboard');
           $titre= $data['id_gros_titre_dashboard'];
           $introduction = $data['id_introduction'];

           ?>



        <header class="header">
        <h1><?= $titre  ?></h1>
        </header>
        <div class="clear-backend">
            <div class="avatar ease">
                <div>

                </div>
            </div>

            <!-- tab-menu -->
            <input type="radio" class="tab-1" name="tab" checked="checked">
            <span>Home</span><i class="fa fa-home"></i>

            <input type="radio" class="tab-2" name="tab">
            <span>Posts</span><i class="fa fa-medium"></i>

            <input type="radio" class="tab-3" name="tab">
            <span>Users</span><i class="fa fa-user"></i>

            <input type="radio" class="tab-4" name="tab">
            <span>Comments</span><i class="fa fa-comment"></i>

            <input type="radio" class="tab-5" name="tab">
            <span>Upload</span><i class="fa fa-cloud-upload"></i>

            <input type="radio" class="tab-6" name="tab">
            <span>Favorite</span><i class="fa fa-star"></i>

            <input type="radio" class="tab-7" name="tab">
            <span>Photos</span><i class="fa fa-photo"></i>

            <input type="radio" class="tab-8" name="tab">
            <span>Analysis</span><i class="fa fa-line-chart"></i>

            <input type="radio" class="tab-9" name="tab">
            <span>Links</span><i class="fa fa-link"></i>

            <input type="radio" class="tab-10" name="tab">
            <span>Settings</span><i class="fa fa-cog"></i>

            <!-- tab-top-bar -->
            <div class="top-bar">
                <ul>
                    <li>
                        <a href="" title="Log Out">
                            <i class="fa fa-sign-out"></i>
                        </a>
                    </li>
                    <li>
                        <a href="" title="Messages">
                            <i class="fa fa-envelope"></i>
                        </a>
                    </li>
                    <li>
                        <a href="" title="Edit">
                            <i class="fa fa-edit"></i>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- tab-content -->
            <div class="tab-content">
                <section class="tab-item-1">
                    <h1>One</h1>
                    <?= $introduction ?>
                </section>
                <section class="tab-item-2">
                    <h1>Two</h1>
                    <style>
                        /*
                 CSS for the main interaction
                */
                        .tabset > input[type="radio"] {
                            position: absolute;
                            left: -200vw;
                        }

                        .tabset .tab-panel {
                            display: none;
                        }

                        .tabset > input:first-child:checked ~ .tab-panels > .tab-panel:first-child,
                        .tabset > input:nth-child(3):checked ~ .tab-panels > .tab-panel:nth-child(2),
                        .tabset > input:nth-child(5):checked ~ .tab-panels > .tab-panel:nth-child(3),
                        .tabset > input:nth-child(7):checked ~ .tab-panels > .tab-panel:nth-child(4),
                        .tabset > input:nth-child(9):checked ~ .tab-panels > .tab-panel:nth-child(5),
                        .tabset > input:nth-child(11):checked ~ .tab-panels > .tab-panel:nth-child(6) {
                            display: block;
                        }

                        /*
                         Styling
                        */
                        body {
                            font: 16px/1.5em "Overpass", "Open Sans", Helvetica, sans-serif;
                            color: #333;
                            font-weight: 300;
                        }

                        .tabset > label {
                            position: relative;
                            display: inline-block;
                            padding: 15px 15px 25px;
                            border: 1px solid transparent;
                            border-bottom: 0;
                            cursor: pointer;
                            font-weight: 600;
                        }

                        .tabset > label::after {
                            content: "";
                            position: absolute;
                            left: 15px;
                            bottom: 10px;
                            width: 22px;
                            height: 4px;
                            background: #8d8d8d;
                        }

                        .tabset > label:hover,
                        .tabset > input:focus + label {
                            color: #06c;
                        }

                        .tabset > label:hover::after,
                        .tabset > input:focus + label::after,
                        .tabset > input:checked + label::after {
                            background: #06c;
                        }

                        .tabset > input:checked + label {
                            border-color: #ccc;
                            border-bottom: 1px solid #fff;
                            margin-bottom: -1px;
                        }

                        .tab-panel {
                            padding: 30px 0;
                            border-top: 1px solid #ccc;
                        }

                        /*
                         Demo purposes only
                        */
                        *,
                        *:before,
                        *:after {
                            box-sizing: border-box;
                        }

                        body {
                            padding: 30px;
                        }

                        .tabset {
                            max-width: 70em;
                        }
                    </style>
                    <div class="tabset">
                        <!-- Tab 1 -->
                        <input type="radio" name="tabset" id="tab1" aria-controls="marzen" checked>
                        <label for="tab1">Märzen</label>
                        <!-- Tab 2 -->
                        <input type="radio" name="tabset" id="tab2" aria-controls="rauchbier">
                        <label for="tab2">Rauchbier</label>
                        <!-- Tab 3 -->
                        <input type="radio" name="tabset" id="tab3" aria-controls="dunkles">
                        <label for="tab3">Dunkles Bock</label>

                        <div class="tab-panels">
                            <section id="marzen" class="tab-panel">
                                <h2>6A. Märzen</h2>
                                <p><strong>Overall Impression:</strong> An elegant, malty German amber lager with a clean, rich, toasty and bready malt flavor, restrained bitterness, and a dry finish that encourages another drink. The overall malt impression is soft, elegant, and complex, with a rich aftertaste that is never cloying or heavy.</p>
                                <p><strong>History:</strong> As the name suggests, brewed as a stronger “March beer” in March and lagered in cold caves over the summer. Modern versions trace back to the lager developed by Spaten in 1841, contemporaneous to the development of Vienna lager. However, the Märzen name is much older than 1841; the early ones were dark brown, and in Austria the name implied a strength band (14 °P) rather than a style. The German amber lager version (in the Viennese style of the time) was first served at Oktoberfest in 1872, a tradition that lasted until 1990 when the golden Festbier was adopted as the standard festival beer.</p>
                            </section>
                            <section id="rauchbier" class="tab-panel">
                                <h2>6B. Rauchbier</h2>
                                <p><strong>Overall Impression:</strong> An elegant, malty German amber lager with a balanced, complementary beechwood smoke character. Toasty-rich malt in aroma and flavor, restrained bitterness, low to high smoke flavor, clean fermentation profile, and an attenuated finish are characteristic.</p>
                                <p><strong>History:</strong> A historical specialty of the city of Bamberg, in the Franconian region of Bavaria in Germany. Beechwood-smoked malt is used to make a Märzen-style amber lager. The smoke character of the malt varies by maltster; some breweries produce their own smoked malt (rauchmalz).</p>
                            </section>
                            <section id="dunkles" class="tab-panel">
                                <h2>6C. Dunkles Bock</h2>
                                <p><strong>Overall Impression:</strong> A dark, strong, malty German lager beer that emphasizes the malty-rich and somewhat toasty qualities of continental malts without being sweet in the finish.</p>
                                <p><strong>History:</strong> Originated in the Northern German city of Einbeck, which was a brewing center and popular exporter in the days of the Hanseatic League (14th to 17th century). Recreated in Munich starting in the 17th century. The name “bock” is based on a corruption of the name “Einbeck” in the Bavarian dialect, and was thus only used after the beer came to Munich. “Bock” also means “Ram” in German, and is often used in logos and advertisements.</p>
                            </section>
                        </div>
                    </div>
                </section>
                <section class="tab-item-3">
                    <h1>Three</h1>
                    <?php
                    echo $data[ '_oembed_64500254a9ff1e49e2db726bee74940e'];
                    echo $data[ '_oembed_672f8ebe89b24cd26fda659dc3589501'];
                    echo $data[ '_oembed_a1a24027ee5a10e7d0fe84eb0e9381d4'];
                    ?>

                </section>
                <section class="tab-item-4">
                    <h1>Four</h1>
                </section>
                <section class="tab-item-5">
                    <h1>Five</h1>
                </section>
                <section class="tab-item-6">
                    <h1>Six</h1>
                </section>
                <section class="tab-item-7">
                    <h1>Sever</h1>
                </section>
                <section class="tab-item-8">
                    <h1>Eight</h1>
                </section>
                <section class="tab-item-9">
                    <h1>Nine</h1>
                </section>
                <section class="tab-item-10">
                    <h1>Ten</h1>
                </section>
            </div>
        </div>

       <?php


    }


}