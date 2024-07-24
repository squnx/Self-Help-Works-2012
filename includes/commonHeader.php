<div class="divCommonHeader">
    <div class="divContainer">
        <div id="titleThrow"><?= ${'Title'}; ?></div>
    </div>
    <div class="divContainer" style="border-bottom: 1px solid #CCCCCC; margin: 0px; padding: 0px;">
        <div class="div2col1">
            <div id="commonAuthor">by <?= ${'Author'}; ?></div>
        </div>
        <div class="div2col2" align="right" style="top: 2px;">
            <img src="../assets/images/share_person_normal.png">
            <img src="../assets/images/share_pin_normal.png">
            <img src="../assets/images/share_print_normal.png">
        </div>
    </div>
    <div class="divContainer" style="margin-top: 10px;">
        <div id="divDate"><img src="../assets/images/share_calendar.png" /> <span id="date"><?= ${'Date Posted'}; ?></span></div>
        <div id="divComments"><img src="../assets/images/share_comments.png" /> <a href="#" id="comments">[Comments Call]</a></div>
        <div id="divTags"><img src="../assets/images/share_tags.png" /><?= ${'Tags'}; ?></div>
    
    </div>
</div>