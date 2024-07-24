<div class="divHeader">
        </div>
        <div class="divContainer">
        	<div class="divSearch">
            </div>
            <div class="divTopmenu">
            	<img src="/images/profile_photo_icon.png" width="28" height="28" alt="" border="0">
				<?php echo $Profile->Record['firstname']; ?>
				<?php echo $Profile->Record['lastname']; ?>
				
				
				
				
				<form method="get" action="/search/" id="sitesearch">
		<input type="text" name="search" onfocus="this.value=''" value="SEARCH" class="sitesearch" style="position:relative; top:-7px;">
		<input type="image" src="/assets/images/sitesearch.png" class="sitesearchGo" style="position:relative; left:5px; onmouseover="javascript:this.src='/assets/images/sitesearch_o.png';" onmouseout="javascript:this.src='/assets/images/sitesearch.png';" width="25" height="23" border="0" value="Submit" onclick="return cap_valid(event);">
	</form>
				

				
				
				
				
            </div>
        </div>
        <div class="divMenu">
        </div>