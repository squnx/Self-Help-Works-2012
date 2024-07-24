<!-- BEGIN: divHeader -->
<div class="divHeader">
</div>
<!-- END: divHeader -->
<div class="divContainer">
	<!-- BEGIN: divHeadercol1 -->
    <div class="divHeadercol1">
        <div class="divLogo"></div>
    </div>
    <!-- END: divHeadercol1 -->
    <!-- BEGIN: divHeadercol2 -->
    <div class="divHeadercol2">
    	<!-- BEGIN: div2col40left -->
        <div class="divMembercol" align="right">
			<ul id="memberNav">
				<li><a href="#"><img src="/images/profile/<?= ${'Profile Photo'}; ?>" style="width:28px; height:28px; vertical-align:middle; border: 1px solid #000;">&nbsp;
					<?= ${'First Name'}; ?>
					<?= ${'Last Name'}; ?>
					&nbsp;<img src="/assets/images/member_arrow.png" width="10" height="8" border="0" /></a>
					<ul>
						<li><a href="/community/profile.php">My Profile</a></li>
						<li><a href="/nutrition/favorites.php">Favorites</a></li>
						<li id="hr"><img src="/assets/images/shim_a3a3a3.gif" width="124" height="16" style="position: absolute; left: 18px;" /></li>
						<li><a href="#">Account Settings</a></li>
						<li><a href="#">Membership</a></li>
						<li id="hr"><img src="/assets/images/shim_a3a3a3.gif" width="124" height="16" style="position: absolute; left: 18px;" /></li>
						<li><a href="#3">Log Off</a></li>
						<li id="member_bottom"><img src="/assets/images/member_bottom.png" width="173" height="20" style="position: absolute; left: -5px;" /></li>
					</ul>
				</li>
			</ul>
		</div>
        <!-- END: div2col40left -->
        <!-- BEGIN: div2col60right -->
        <div class="divSearchcol" align="right">
        	<!-- BEGIN: divSearch -->
            <div class="divSearch">
                    <form method="get" action="/search/" id="sitesearch">
                    <input type="text" name="search" onfocus="this.value=''" value="SEARCH" class="sitesearch" style="position:relative; top:-7px;width:200px;">
                    <input type="image" src="/assets/images/sitesearch.png" class="sitesearchGo" style="position:relative;" onmouseover="javascript:this.src='/assets/images/sitesearch_o.png';" onmouseout="javascript:this.src='/assets/images/sitesearch.png';" width="25" height="23" border="0" value="Submit" onclick="return cap_valid(event);">
                    </form>
            </div>
            <!-- END: divSearch -->
        </div>
        <!-- END: div2col60right -->
        <!-- BEGIN: divSpace15 -->
        <div class="divClear"></div>
        <!-- END: divSpace15 -->
        <!-- BEGIN: divTopMenu -->
        <div class="divTopMenu">
        	<img src="/assets/images/menu_top__01.png" style="border:0px;" /><a href="/lifepoints/index.php"><img src="/assets/images/menu_top__02.png" style="border:0px;" /></a><img src="/assets/images/menu_top__03.png" style="border:0px;" /><a href="/index.php"><img src="/assets/images/menu_top__04.png" style="border:0px;" /></a><img src="/assets/images/menu_top__05.png" style="border:0px;" /><a href="/common/challenges.php"><img src="/assets/images/menu_top__06.png" style="border:0px;" /></a><img src="/assets/images/menu_top__07.png" style="border:0px;" />
        </div>
        <!-- END: divTopMenu -->
    </div>
    <!-- END: divHeadercol2 -->
</div>