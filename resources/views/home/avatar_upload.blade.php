<label>Аватар</label>
<div class="input-group">
    <span class="input-group-btn">
        <div class="form-group">
            <span class="btn btn-file">
                {{(empty($user->avatar)) ? 'Загрузить' : 'Изменить'}}
                <input type="file" id="imgInp" name="avatar">
            </span>
            <img src="/user/getMiniAvatarImage"/>
        </div>
    </span>
    <input type="text" class="form-control" name="avatar2" readonly>
</div>
<img id="img-upload" src="/user/getAvatarImage"/>

<script>
    $(document).ready(function () {
        $(document).on('change', '.btn-file :file', function () {
            var input = $(this),
                label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
            input.trigger('fileselect', [label]);
        });

        $('.btn-file :file').on('fileselect', function (event, label) {

            var input = $(this).parents('.input-group').find(':text'),
                log = label;

            if (input.length) {
                input.val(log);
            } else {
                if (log) alert(log);
            }

        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#img-upload').attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imgInp").change(function () {
            readURL(this);
        });
    });
</script>

<style>
    .btn-file {
        position: relative;
        overflow: hidden;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }

    #img-upload {
        width: 100%;
    }
    input[name=avatar2]{
        display: none;
    }

</style>