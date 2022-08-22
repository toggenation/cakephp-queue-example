<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
$this->Html->css('fix', ['block' => true]);
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Users'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="users form content">
            <?= $this->Form->create($form) ?>
            <fieldset>
                <legend><?= __('Notify Users') ?></legend>
                <?php
                echo $this->Form->control('subject');
                echo $this->Form->control('body');

                $this->Form->setTemplates([
                    'checkboxWrapper' => '<div class="checkbox fix">{{label}}</div>',
                ]);
                echo $this->Form->control('users', [
                    'multiple' => 'checkbox',
                    'required' => false
                ]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>