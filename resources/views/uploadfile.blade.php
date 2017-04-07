<html>
<body>
    <form name="image" id="image" method="post" enctype="multipart/form-data" 
                action="/util/uploadfile" > 
         <?php echo method_field('POST'); ?>
         <?php echo csrf_field(); ?>
        <p style="margin:10px 0;">上传图片: 
            <input type="file" name="image" ID="image"/>
            <input type="text" name="brand" ID="brand" />
            <input type="submit" id="fileSubmit" name="Submit" value="上传" />
        </p> 
</form>

</body>
</html>