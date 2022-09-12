<div class="footer_search" style="background-color:transparent !important;backdrop-filter: blur(20px);">
	<div class="search-wrapper">
		<form action="search" class="form_search" method="POST" >
            @csrf
		    <input type="searchfield" class="search_key" placeholder="What are you looking for?" name="searchkey" style="background-color:white;">
		    <button type="submit" class="searchButton" style="border-radius: 0 25px 25px 0;">
                <i class="icon-search"></i>
			</button>
		</form>
	</div>
</div>



