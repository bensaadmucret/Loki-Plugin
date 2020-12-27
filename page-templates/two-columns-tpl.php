<?php

/* 
Template Name: Two Columns Layout
*/

get_header();

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>




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
            overflow: auto;
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
        .grid {
            display: grid;
            grid-template-areas: "one one two two" "three three four four";
            grid-template-rows: auto;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 0px;
        }
        .one {
            grid-area: one;
        }
        .two {
            grid-area: two;
        }
        .three {
            grid-area: three;
        }
        .four {
            grid-area: four;
        }
        .grid > div {
            border: 1px solid rgba(100, 100, 100, 0.6);
            background-color: rgba(100, 100, 100, 0.3);
            position: relative;
            height: 0;
            padding-top: 56.25%;
            overflow: hidden;
        }
        iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
    </style>
<div class="container">
		<header class="header">
			<h1>Dashboard</h1>
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
                <?php
                ob_start();

                //require_once  DIRECTORY_SEPARATOR . 'projet.php';
                include  'projet.php';

              ob_end_flush();

                ?>

				</section>
				<section class="tab-item-2">
					<h1>Two</h1>
                </section>
				<section class="tab-item-3">
					<h1>Three</h1>
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
	</div>
	<footer class="footer">
		<div class="container">
			<div class="copyright">

			</div>
		</div>
	</footer>
<?php




 get_footer();

