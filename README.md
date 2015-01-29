# image-crop

enable the bundle:

  - app\AppKernel.php
  --------------
      public function registerBundles()
      {
        $bundles = array(
          ....
          new Jse\ImageCropBundle\JseImageCropBundle(),
        );
      }

  - app\config\routing.yml
  --------------
      jse_image_crop:
          resource: "@JseImageCropBundle/Resources/config/image_crop_routing.xml"
          prefix:   /

  - app\config\parameters.yml
  --------------
      upload_dir: images/uploads


  - include to your page
  --------------
      {% include 'JseImageCropBundle:ImageCrop:image_crop.html.twig' %}

  - as popup:
  --------------
      <script type="text/javascript">
        $(function(){
          $(".ajax").colorbox({title: false});
        });
      </script>
      <a title="Crop" href="{{ path('jse_image_crop_popup') }}" class="ajax cboxElement">crop</a>

  - template path:
  --------------
      JseImageCropBundle:ImageCrop:image_crop.html.twig

  - initialize js:
  --------------
      imageCrop.init(width, height);
      imageCrop.onsubmit = function(){
       // code here
      }
      imageCrop.callback = function(data){
        if(data.saved) {
          // code here
        } else {
          // code here
        }
      }
