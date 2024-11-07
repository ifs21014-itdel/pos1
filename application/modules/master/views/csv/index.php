<div class="easyui-layout" data-options="fit:true">
<h3>Import CSV</h3>
    <form action="<?php echo site_url('master/csv/uploadcsv') ?>" id="excel_input_form" method="post" enctype="multipart/form-data">
        <input type="file" name="file"/>
        <br/>
        <br/>
        <input type="submit" value="Upload file" class="btn btn-primary"/>
    </form>    
</div>
