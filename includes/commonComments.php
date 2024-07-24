<!-- BEGIN: divSpace15 -->
<div class="divSpace15"></div>
<!-- END: divSpace15 -->
<div class="divCommentsHeader">
	<div id="divCommentStatus"><a href="#">[Comment Calls]</a> <a href="#">[Comment Calls]</a></div>
</div>
<!-- BEGIN: Normal Comment -->
<?= ${'Comments'}; ?>
<!-- END: Comment -->
<!-- BEGIN: divSpace15 -->
<div class="divSpace15"></div>
<!-- END: divSpace15 -->
<!-- BEGIN: Post a Comment -->
<div class="divPostAComment">
	<img src="../assets/images/postacomment.png" /><br />
    <form onsubmit="return false;" name="comments_form" id="comments_form">
    <textarea id="new_comment" name="new_comment"></textarea>
    <input type="hidden" name="type" id="type" value="<?= ${'Comment Type'}; ?>" />
    <input type="hidden" name="owner" id="owner" value="<?= $OwnerID; ?>" />
    <input type="hidden" name="username" id="username" value="<?= ${'First Name'}.' '.${'Last Name'}; ?>" />
    <input type="hidden" name="<?= ${'Comment Type'}; ?>_id" id="<?= ${'Comment Type'}; ?>_id" value="<?= ${'Item ID'}; ?>" />
    </form><br />
    <img src="../assets/images/comment_postcomment.png" id="Post_Comment" /><br />
	 <script type="text/javascript">
		$(function() {
			$('#Post_Comment').click(function () {
				
					showLoading();
				
					$.ajax({
						type: 'POST', // create a post when clicked
						url: '../includes/inc.Comments.php', // post to the page with the update query
						data: {'type': $('#type').val(), '<?= ${'Comment Type'}; ?>_id': $('#<?= ${'Comment Type'}; ?>_id').val(), 'owner': $('#owner').val(), 'new_comment': $('#new_comment').val(), 'username': $('#username').val() }, // set the post variables
						success: function(){ window.location.reload(); } // reload the page to reflect the new ratings
					});
			});
		});
	</script>
</div>
<!-- END: Post a Comment -->