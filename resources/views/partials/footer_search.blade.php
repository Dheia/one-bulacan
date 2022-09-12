<div class="footer_search">
	<div class="search-wrapper">
		<form action="search" class="form_search" method="POST" >
            @csrf
		    <input type="searchfield" class="search_key" placeholder="What are you looking for?" name="searchkey">
		    <button type="submit" class="searchButton">
                <i class="icon-search"></i>
             </button>
		</form>
	</div>
	
</div>

<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

<style>
.footer_search {
   position: fixed;
   z-index: 999;
   left: 0;
   bottom: 0;
   width: 100%;
   /* background-color: #5851BC; */
   background-color: #e73827;
   color: white;
   height: 50px;
   text-align: center;
}
</style>


<style>
    .search-wrapper {
        padding: 7px;
        margin: 0;
    }

    .search_key{
        margin-left: -25px;
        background-color: rgba(255,255,255,.8);
        border-radius: 25px;
        border-color: rgba(0,0,0,.1);
        font-family: 'Lato', sans-serif;
        text-align: center;
        width: 50%;
        height: 30px;
        font-size: 20px;
    }

    .searchButton {
        padding: 0px;
        position: absolute;
        margin-left: -25px;
        /*left: 20px;*/
        width: 50px;
        height: 36px;
        border-color: rgba(0,0,0,.1);
        background: #FCA70B;
        text-align: center;
        color: #fff;
        border-radius: 0 25px 25px 0;
        /*cursor: pointer;*/
        /*font-size: 20px;*/
    }

    .search_key:focus {
        border-color: rgba(255,255,255,.6);
    }

    .search_key:focus {
        border-color: rgba(255,255,255,.2);
    }

    .icon-search {

        font-size: 20px;
    }

    @media only screen and (max-width: 768px) {
        .search_key {
            width: 80%;
            height: 45px;
        }
        .searchButton {
            height: 51px;
        }
        .footer_search {
            height: 100px;
        }
    }

    @media only screen and (max-width: 768px) {
        .search_key {
            width: 80%;
            float: left;
            margin-left: 10px;
            height: 45px;
            font-size: 16px !important;
            margin-top: 17px;
        }
        .searchButton {
            height: 51px;
            margin-left: -90px;
            margin-top: 17px;
        }
        .footer_search {
            height: 100px;
        }
    }

    @media only screen and (max-width: 500px) {
        .search_key {
            width: 75%;
            float: left;
            margin-left: 10px;
            height: 45px;
            font-size: 16px !important;
            margin-top: 17px;
        }
        .searchButton {
            height: 51px;
            margin-left: -90px;
            margin-top: 17px;
        }
        .footer_search {
            height: 100px;
        }
    }
    
    @media only screen and (max-width: 380px) {
        .search_key {
            width: 63%;
            float: left;
            margin-left: 10px;
            height: 45px;
            font-size: 16px !important;
            margin-top: 17px;
        }
        .searchButton {
            height: 51px;
            margin-left: -82px;
            margin-top: 17px;
        }
        .footer_search {
            height: 100px;
        }
    }

    @media only screen and (max-width: 360px) {
        .search_key {
            width: 60%;
            float: left;
            margin-left: 10px;
            height: 45px;
            font-size: 15px !important;
            margin-top: 17px;
        }
        .searchButton {
            height: 51px;
            margin-left: -82px;
            margin-top: 17px;
        }
        .footer_search {
            height: 100px;
        }
    }

    @media only screen and (max-width: 320px) {
        .search_key {
            width: 60%;
            float: left;
            margin-left: 10px;
            height: 45px;
            font-size: 12px !important;
            margin-top: 17px;
        }
        .searchButton {
            height: 51px;
            margin-left: -82px;
            margin-top: 17px;
        }
        .footer_search {
            height: 100px;
        }
    }

    

/*.form_search:hover{
    width: 200px;
    cursor: pointer;
}

.form_search:hover input{
    display: block;
}

.form_search:hover .fa{
    background: #07051a;
    color: white;
}*/
</style>

<script>
    
</script>
