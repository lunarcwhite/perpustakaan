<script>
    $('input[type="file"]').change(function (e) {

        var reader = new FileReader();
        reader.onload = function (e) {

            // get loaded data and render thumbnail.
            $('.image-preview').append(
                `
                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                    <button type="button" class="btn btn-sm btn-outline-danger btn-close buang"
                    aria-label="Close"><span aria-hidden="true"><i class="fas fa-trash"></i></span></button>
                </div> 
                    <img src="#" id="preview" class="img-thumbnail position-relative">
                `
            );
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
    $(document).on("click", ".buang", function () {
        $('.image-preview').empty();
        $(".file").val("");
    });
</script>
