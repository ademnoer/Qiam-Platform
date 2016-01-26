<div class="container pad" style="width: 90%">

    <?php
        if (isset($_POST['submit'])){
            
            
            
         echo '<div class="callout callout-info"><h4>تم ارسال الرسال</h4></div>';
         
        }
        
        if (isset($_POST['submit_hidden'])){
         echo '<div class="callout callout-danger"><h4>تم ارسال الرسال</h4></div>';           
        }
        
        
    ?>

    
    <div class='box box-success box-solid'>
        <div class="box-header with-border">
            <h3 class="box-title">نافذ التواصل المباشر</h3>
        </div>
        <div class="box-body">
            <p class="margin">تستطيع استخدام هذه النافذ لارسال الاقتراحات او الرسائل الى منسق الموقع ، سنجيب على استفسارات خلال أقرب فرص متاح</p>
        </div>
        <div class="box-footer">
            <form method="POST" action="dashboard.php?contact">
                <div class="form-group">
                    <textarea name="message" class="form-control" rows="3" placeholder="Write your Message"></textarea>
                </div>
                <div class="form-group">
                    <input name="submit" type="submit" class="btn btn-success" value="Send">
                </div>
            </form>
        </div>
    </div>




    <div class='box box-danger box-solid collapsed-box'>
        <div class="box-header with-border">
            <h3 class="box-title" style="margin-right: 25px;">نافذ التواصل الخفي</h3>
            <div class="box-tools">
                <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <p class="margin">تستطيع استخدام هذه الخاصي اذا كنت لا تريد ان يعرف احد من هو المرسل</p>
        </div>
        <div class="box-footer">
            <form method="POST" action="dashboard.php?contact">
                <div class="form-group">
                    <textarea name="message" class="form-control" rows="3" placeholder="Write your Message"></textarea>
                </div>
                <div class="form-group">
                    <input name="submit_hidden" type="submit" class="btn btn-danger" value="Send">
                </div>
            </form>
        </div>
    </div>


</div>

