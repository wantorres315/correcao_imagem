import './bootstrap';
import $ from 'jquery';
import Cropper from 'cropperjs';

window.$ = $;

// Função para criar uma nova instância do Cropper
function createCropper(canvas) {
    return new Cropper(canvas, {
        aspectRatio: 16 / 9,
        cropBoxResizable: false,
        dragMode: 'move',
        zoomable: false,
        minCropBoxWidth: 1200,
        maxCropBoxWidth: 800,
    });
}

$('body').on('change', '#fileInput', function () {
    var canvas = $("#canvas")[0],
        context = canvas.getContext("2d"),
        $result = $('#result');

    if (this.files && this.files[0]) {
        if (this.files[0].type.match(/^image\//)) {
            var reader = new FileReader();
            reader.onload = function (evt) {
                var img = new Image();
                img.onload = function () {
                    canvas.height = img.height;
                    canvas.width = img.width;
                    context.drawImage(img, 0, 0);

                    // Destrua a instância anterior do Cropper, se existir
                    if (canvas.cropper) {
                        canvas.cropper.destroy();
                    }

                    // Crie uma nova instância do Cropper e armazene na propriedade 'cropper' do canvas
                    canvas.cropper = createCropper(canvas);
                };

                img.src = evt.target.result;
            };

            reader.readAsDataURL(this.files[0]);
        } else {
            alert("Tipo de arquivo inválido! Por favor, selecione um arquivo de imagem.");
        }
    } else {
        alert('Nenhum arquivo selecionado.');
    }
});

$('body').on('click', '#clear_image', function () {
    var canvas = $("#canvas")[0];

    // Limpe a instância do Cropper, se existir
    if (canvas.cropper) {
        canvas.cropper.clear();
    }
});
