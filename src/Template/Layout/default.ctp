<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Configure;

$title = 'Task Manager';

?>
<!DOCTYPE html>
<html>
    <head>
        <?= $this->Html->charset() ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>
            <?= $title ?>
        </title>

        <?= $this->Html->css([
            'bootstrap.min',
            'style'
        ]) ?>

        <?= $this->fetch('meta') ?>
        <?= $this->fetch('css') ?>
        <?= $this->fetch('script') ?>
    </head>
    <body<?php if (Configure::read('useAjax') === true) { ?> data-ajax="1"<?php } ?>>
        <div class="container">
            <?= $this->element('nav') ?>
            <?= $this->Flash->render() ?>
            <div class="row">
                <?= $this->fetch('content') ?>
            </div>
            <footer>
            </footer>
        <?= $this->fetch('modal') ?>
        </div>
        <?= $this->Html->script([
            '//code.jquery.com/jquery-3.3.1.min.js',
            'bootstrap.min',
            'common'
        ]) ?>
    </body>
</html>
