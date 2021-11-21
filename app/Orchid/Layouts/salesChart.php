<?php

namespace App\Orchid\Layouts;

use Orchid\Screen\Layouts\Chart;

class salesChart extends Chart
{
    /**
     * Add a title to the Chart.
     *
     * @var string
     */
    protected $title = 'Sales by Date';

    /**
     * Available options:
     * 'bar', 'line',
     * 'pie', 'percentage'.
     *
     * @var string
     */
    protected $type = 'line';

    /**
     * Data source.
     *
     * The name of the key to fetch it from the query.
     * The results of which will be elements of the chart.
     *
     * @var string
     */
    protected $target = 'transactions';

    /**
     * Determines whether to display the export button.
     *
     * @var bool
     */
    protected $export = true;
}
