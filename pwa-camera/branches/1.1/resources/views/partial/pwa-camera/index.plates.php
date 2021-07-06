<?php
/**
 * @var Pollen\Partial\PartialTemplateInterface $this
 */
?>
<div <?php echo $this->htmlAttrs(); ?>>
    <div class="PwaCamera-playerArea">
        <?php echo $this->partial('tag', $this->get('player')); ?>
    </div>

    <div class="PwaCamera--handler">
        <button id="takePhoto" class="PwaButton--1 PwaButton--large PwaCamera-handlerButton">
            <?php echo 'Prendre une photo'; ?>
        </button>
    </div>

    <ul class="PwaCamera-photos">
    </ul>
</div>
