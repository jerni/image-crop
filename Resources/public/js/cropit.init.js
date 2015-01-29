var imageCrop;

imageCrop = {

    imageName: false,
    saving: false,
    save_path: false,
    callback: function(data){},
    onsubmit: function(){},


    init: function (wd, ht) {

        if(typeof(wd) == 'undefined'){
            wd = 250;
        }

        if(typeof(ht) == 'undefined'){
            ht = 250;
        }

        var imageCrp = $('.image-editor');
        var _this = this;
        imageCrp.cropit({
            imageBackground: true,
            imageBackgroundBorderWidth: 50,
            onImageLoaded: function () {
                _this.imageName = this.$fileInput.val();
                var imageSize = parseInt($('.cropit-image-background').width());
                var previewSize = parseInt(imageCrp.cropit('previewSize').width);
                if (imageSize > previewSize) {
                    imageCrp.cropit('offset', {x: ((previewSize - imageSize) / 2), y: 0});
                }
            }
        });

        imageCrp.cropit('previewSize', { width: wd, height: ht });

        $('.select-image-btn').click(function () {
            $('.cropit-image-input').click();
        });

        $('#image_crop_from').submit(function () {

            if (_this.saving) {
                return false;
            }

            _this.saving = true;

            var imageData = $('.image-editor').cropit('export');

            if (_this.imageName) {
                _this.onsubmit();
                $.post(_this.save_path, {image: imageData, image_name: _this.imageName}, function (data) {
                    _this.saving = false;
                    _this.callback(data);
                });
            }
            return false;
        });

    }
};