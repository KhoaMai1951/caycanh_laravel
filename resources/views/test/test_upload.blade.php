<head>
    <title>Multiple Image Upload</title>
    <script src="jquery/1.9.1/jquery.js"></script>
    <link rel="stylesheet" href="3.3.6/css/bootstrap.min.css">
</head>
<body>

<div class="container lst">
    <h3 class="well">Test Muliple Image Upload</h3>

    <form method="post" action="{{url('test_image_upload')}}" enctype="multipart/form-data">
        {{csrf_field()}}

        <div class="input-group hdtuto control-group lst increment" >
            <input type="file" name="filenames[]" class="myfrm form-control" multiple>
            <div class="input-group-btn">
                <button class="btn btn-success" type="button"><i class="fldemo glyphicon glyphicon-plus"></i>Add</button>
            </div>
        </div>

        <button type="submit" class="btn btn-success" style="margin-top:10px">Submit</button>
    </form>
</div>

<script type="text/javascript">
    $(document).ready(function() {
        $(".btn-success").click(function(){
            var lsthmtl = $(".clone").html();
            $(".increment").after(lsthmtl);
        });
        $("body").on("click",".btn-danger",function(){$(this).parents(".hdtuto control-group lst").remove();
        });
    });
</script>

</body>
