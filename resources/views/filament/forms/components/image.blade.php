<input type="file" id="fileInput" accept="image/*" />
<canvas id="canvas">
</canvas>
<button type = "button" id="clear_image" class="full-rounded">{{__('messages.clear')}}</button>
<style>
    img {
        max-width: 100%;
    }
    #canvas {
        height: 600px;
        width: 600px;
        background-color: #ffffff;
        cursor: default;
        border: 1px solid black;
    }
</style>