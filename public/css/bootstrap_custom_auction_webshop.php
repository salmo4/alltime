<?php header("Content-type: text/css; charset: UTF-8"); ?>
<?php   //var_dump($_COOKIE["application_type"]); ?>

body {
    color: #333;
    font-family:  "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 12px;
    line-height: 1.42857;
}


.navbar-inverse .navbar-header > a {
color: white;
}     
.navbar-inverse .navbar-header > a:hover, .navbar-inverse .navbar-header > a:focus {
color: #ec576b;
}     
                
            
            /* link */
.navbar-inverse .navbar-nav > li > a {
color: white;
}

.navbar-inverse .navbar-nav > li > a:hover, .navbar-inverse .navbar-nav > li > a:focus {
color: #ec576b;
}

.navbar-inverse{
   background-image: url(' ');
 /*background-image: url('../img/green.jpg');
   background-repeat: repeat-x;*/
  background-color: #1d2731;
  
  <?php if(isset($_COOKIE["application_type"]) && $_COOKIE["application_type"] ==2) {echo 'background-color: #0C476A;';} ?>
  
  <?php if(isset($_COOKIE["application_type"]) && $_COOKIE["application_type"] ==3) {echo 'background-color: #004346;';} ?>
   min-height: 50px;
   font-size: 18px;
}

.navbar-inverse .navbar-nav > .active{
    color: #000;
   background: #4ec5c1;
 }
 .navbar-inverse .navbar-nav > .active > a, 
 .navbar-inverse .navbar-nav > .active > a:hover, 
 .navbar-inverse .navbar-nav > .active > a:focus {
      color: #000;
      background: #e5e338;
 }



.btn-info {
    background: #ec576b none repeat scroll 0 0;
}
.btn {
    border: 0 none;
    border-radius: 2px;
    cursor: pointer;
    line-height: 31px;
    margin: 10px;
    outline: medium none !important;
    padding: 5px 22px;
    position: relative;
    text-decoration: none;
    text-transform: uppercase;
    transition: all 0.2s ease-out 0s;
}


.btn-primary{
   background: #ec576b; 
}

.btn-primary:hover{
   background: #4ec5c1; 
}

/***modal******/
.overlay { position:fixed; left:0; top:0; width:100%; height:100%; z-index:10000; background:black; background:rgba(0,0,0,.70); }
/*
.popup { position:absolute; left:50%; top:100px; width:615px; margin-left:-307px; background:black; border:1px solid #c90000; padding:25px 30px; z-index:10001; color:white; line-height:24px; }
*/


.popup { 
    /*position:absolute; */
    position: fixed;
    top:30%;
    left:50%;
    /*  top:100px; */
    width:615px;
    margin-left:-307px; 
  /*  background:black;*/
    background:#282828;
   /* border:1px solid #c90000;*/
    padding:25px 30px;
    /*z-index:10001; */
    /* login -layer fölé*/
    z-index:1000010;
    color:white; 
    line-height:24px;
}

.popup .btn-close { position:absolute; right:13px; top:13px; background:url(../img/icons.png) no-repeat -131px -114px; width:26px; height:26px; cursor:pointer; }
.popup h3 { font-size:17px;  border-bottom:1px solid white; padding-bottom:15px; margin:0 0 20px 0; text-transform:uppercase; text-align: center;}
.popup .cont { text-align: center;}
.popup .buttons { text-align:center; padding-top:50px; padding-bottom:10px; }
.popup .buttons .btn { margin:0 10px 10px 10px; min-width:135px; }



.add_shadow {
    box-shadow: 2px 2px 11px #cccbcb;
    padding: 1.5em 0 0;
}

a {
    color: #ec576b;
}


.pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {
    background-color: #ec576b;
}


.scrollable-menu {
    height: auto;
    max-height: 300px;
    overflow-x: hidden;
}