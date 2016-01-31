<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 31.01.2016
 * Time: 14:23
 */

namespace app\widgets;

use yii\helpers\Html;

class Carousel extends \yii\bootstrap\Carousel
{
    /**
     * Renders carousel indicators.
     * @return string the rendering result
     */
    public function renderIndicators()
    {
        if ($this->showIndicators === false) {
            return '';
        }
        $indicators = [];
        for ($i = 0, $count = count($this->items); $i < $count; $i++) {
            $title = isset($this->items[$i]['caption']) ? $this->items[$i]['caption'] : '';
            $options = ['data-target' => '#' . $this->options['id'], 'data-slide-to' => $i];
            if ($i === 0) {
                Html::addCssClass($options, 'active');
            }
            $indicators[] = Html::tag('li', $title, $options);
        }

        return Html::tag('ol', implode("\n", $indicators),
            ['class' => 'carousel-indicators main-page__carousel-carousel-indicators']);
    }
} 