<!-- //! Description Images -->
<h5 class="text-danger mt-5">Description Images</h5>
<div class="row border-bottom py-3">
    <div class="col-md-2">Image Count</div>
    <div class="col-md-5">Images</div>
    <div class="col-md-3">Select Image</div>
    <div class="col-md-2">Change</div>
</div>
<?php if (isset(unserialize($row["desc_img"])[0])) {
    $i = 1;
    foreach (unserialize($row["desc_img"]) as $desc_img) { ?>
        <div class="row border-bottom py-4">
            <div class="col-md-2"><?php echo $i;
                                    $i++; ?></div>
            <div class="col-md-5">
                <img class="desc-img" src="http://localhost/php/medicine_website/user_panel/shop/desc_imgs/<?php echo $desc_img; ?>" />
            </div>
            <div class="col-md-3"><input type="file" value="<?php echo $desc_img; ?>" /></div>
            <div class="col-md-2">
                <button class="btn btn-light">Change</button>
            </div>
        </div>
<?php }
} ?>