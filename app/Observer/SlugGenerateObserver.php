<?php
    namespace Mautab\Observer;

    class SlugGenerateObserver
    {
        public function saving($model)
        {
            $model->slug = str_slug($model->title, '-');
        }

        public function saved($model)
        {
        }
    }

    ?>