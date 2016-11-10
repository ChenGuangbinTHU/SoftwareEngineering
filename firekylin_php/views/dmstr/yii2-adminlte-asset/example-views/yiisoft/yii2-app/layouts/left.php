<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->

<!--        <div class="user-panel">-->
<!--            <div class="pull-left image">-->
<!--                <img src="--><?//= $directoryAsset ?><!--/img/user2-160x160.jpg" class="img-circle" alt="User Image"/>-->
<!--            </div>-->
<!--            <div class="pull-left info">-->
<!--                <p>Admin</p>-->
<!---->
<!--                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>-->
<!--            </div>-->
<!--        </div>-->


        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => [
                    ['label' => '菜单', 'options' => ['class' => 'header']],
                    ['label' => '发送信息', 'icon' => 'fa fa-file-code-o', 'visible' => !Yii::$app->user->isGuest, 'url' => ['/firekylin/send-message']],
                    ['label' => '查询发送历史', 'icon' => 'fa fa-dashboard', 'visible' => !Yii::$app->user->isGuest, 'url' => ['/firekylin/inquiry-history']],
                    ['label' => '查询所有发送历史', 'icon' => 'fa fa-dashboard', 'visible' => !Yii::$app->user->isGuest, 'url' => ['/firekylin/inquiry-all']],
                    ['label' => 'Login', 'icon' => 'fa fa-sign-in','url' => ['firekylin/login-site'], 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Logout', 'icon' => 'fa fa-sign-out','url' => ['firekylin/logout'], 'visible' => !Yii::$app->user->isGuest],
                ],
            ]
        ) ?>

    </section>

</aside>
