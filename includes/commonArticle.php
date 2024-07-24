<div class="div2col670left">
	<?php include("../includes/commonHeader.php"); ?>
    <!-- BEGIN: divSpace15 -->
    <div class="divSpace15"></div>
    <!-- END: divSpace15 -->
    
    <div class="divContainer">
    	<img src="<?= ${'Article Image'}; ?>" class="margin10" align="left" style="border: 1px solid #a9afb0;" />
        <!-- BEGIN: quote -->
        <div style="margin-top:30px;">
        	<span id="quotation" style="margin-left: 30px;">"</span>
            <span id="quote"><?= ${'Article Top Quote'}; ?></span>
            <span id="quotation">"</span>
        </div>
        <!-- END: quote -->
        <img src="../assets/images/article_bar.png" class="center" />
        <!-- BEGIN: Article -->
        <div class="body14">
        	<?= ${'Article Body'}; ?>
			<?= ${'Article Resources'}; ?>            
        </div>
        <!-- END: Article -->
    </div>
    
    
    <!-- BEGIN: divSpace15 -->
    <div class="divSpace15"></div>
    <!-- END: divSpace15 -->
    <?php include("../includes/commonBottom.php"); ?>
    <!-- BEGIN: divSpace15 -->
    <div class="divSpace15"></div>
    <!-- END: divSpace15 -->
    <?php include("../includes/commonComments.php"); ?>
</div>
<div class="div2col230right" id="pushDownAndRight" align="center">
    <?php include("../includes/alsoLike.php"); ?>
</div>	