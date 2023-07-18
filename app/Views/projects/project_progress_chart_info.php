<div class="card">
    <div class="bg-primary p30 rounded-top">
        <br />
    </div>
    <div class="clearfix text-center mb-1">
        <div class="mt-50 chart-circle">
            <canvas id="project-progress-chart"></canvas>
        </div>
    </div>

    <ul class="list-group list-group-flush">
        <li class="list-group-item border-top text-center">
            <span class="align-middle text-center">Total de Tasks</span>
        </li>  
        <li class="list-group-item border-top">
            <?php echo app_lang("start_date"); ?>: <?php echo is_date_exists($project_info->start_date) ? format_to_date($project_info->start_date, false) : "-"; ?>
        </li>
        <li class="list-group-item border-top">
            <?php echo app_lang("deadline"); ?>: <?php echo is_date_exists($project_info->deadline) ? format_to_date($project_info->deadline, false) : "-"; ?>
        </li>
        <?php if ($login_user->user_type === "staff" && $project_info->project_type === "client_project") { ?>
            <li class="list-group-item border-top">
                <?php echo app_lang("client"); ?>: <?php echo anchor(get_uri("clients/view/" . $project_info->client_id), $project_info->company_name); ?>
            </li>
        <?php } else { ?>
            <li class="list-group-item border-top">
                <?php echo app_lang("status"); ?>: <?php echo app_lang($project_info->status); ?>
            </li>
        <?php } ?>
    </ul>
</div>

<div class="card">
    <div class="bg-warning p30 rounded-top">
        <br />
    </div>
    <div class="clearfix text-center mb-1">
        <div class="mt-50 chart-circle">
            <canvas id="project-progress-chart-02"></canvas>
        </div>
    </div>

    <ul class="list-group list-group-flush">
        <li class="list-group-item border-top text-center">
            <span class="align-middle text-center">Tasks do Cliente</span>
        </li>  
        <li class="list-group-item border-top">
            <?php echo app_lang("start_date"); ?>: <?php echo is_date_exists($project_info->start_date) ? format_to_date($project_info->start_date, false) : "-"; ?>
        </li>
        <li class="list-group-item border-top">
            <?php echo app_lang("deadline"); ?>: <?php echo is_date_exists($project_info->deadline) ? format_to_date($project_info->deadline, false) : "-"; ?>
        </li>
        <?php if ($login_user->user_type === "staff" && $project_info->project_type === "client_project") { ?>
            <li class="list-group-item border-top">
                <?php echo app_lang("client"); ?>: <?php echo anchor(get_uri("clients/view/" . $project_info->client_id), $project_info->company_name); ?>
            </li>
        <?php } else { ?>
            <li class="list-group-item border-top">
                <?php echo app_lang("status"); ?>: <?php echo app_lang($project_info->status); ?>
            </li>
        <?php } ?>
    </ul>
</div>

<div class="card">
    <div class="bg-secondary p30 rounded-top">
        <br />
    </div>
    <div class="clearfix text-center mb-1">
        <div class="mt-50 chart-circle">
            <canvas id="project-progress-chart-03"></canvas>
        </div>
    </div>

    <ul class="list-group list-group-flush">
        <li class="list-group-item border-top text-center" >
            <span class="align-middle text-center">Tasks da Empresa</span>
        </li>       
        <li class="list-group-item border-top">
            <?php echo app_lang("start_date"); ?>: <?php echo is_date_exists($project_info->start_date) ? format_to_date($project_info->start_date, false) : "-"; ?>
        </li>
        <li class="list-group-item border-top">
            <?php echo app_lang("deadline"); ?>: <?php echo is_date_exists($project_info->deadline) ? format_to_date($project_info->deadline, false) : "-"; ?>
        </li>
        <?php if ($login_user->user_type === "staff" && $project_info->project_type === "client_project") { ?>
            <li class="list-group-item border-top">
                <?php echo app_lang("client"); ?>: <?php echo anchor(get_uri("clients/view/" . $project_info->client_id), $project_info->company_name); ?>
            </li>
        <?php } else { ?>
            <li class="list-group-item border-top">
                <?php echo app_lang("status"); ?>: <?php echo app_lang($project_info->status); ?>
            </li>
        <?php } ?>
    </ul>
</div>



<script type="text/javascript">
    $(document).ready(function () {
        var project_progress = <?php echo $project_progress; ?>;
        var project_progress_02 = <?php echo $project_progress_client; ?>;
        var project_progress_03 = <?php echo $project_progress_business; ?>;
        var projectProgressChart = document.getElementById("project-progress-chart");
        var projectProgressChart_02 = document.getElementById("project-progress-chart-02");
        var projectProgressChart_03 = document.getElementById("project-progress-chart-03");

        new Chart(projectProgressChart, {
            type: 'doughnut',
            data: {
                datasets: [{
                        label: 'Complete',
                        percent: project_progress,
                        backgroundColor: ['#6690F4'],
                        borderWidth: 0
                    }]
            },
            plugins: [{
                    beforeInit: (chart) => {
                        const dataset = chart.data.datasets[0];
                        chart.data.labels = [dataset.label];
                        dataset.data = [dataset.percent, 100 - dataset.percent];
                    }
                },
                {
                    beforeDraw: (chart) => {
                        var width = chart.chart.width,
                                height = chart.chart.height,
                                ctx = chart.chart.ctx;
                        ctx.restore();
                        ctx.font = 1.5 + "em sans-serif";
                        ctx.fillStyle = "#9b9b9b";
                        ctx.textBaseline = "middle";
                        var text = chart.data.datasets[0].percent + "%",
                                textX = Math.round((width - ctx.measureText(text).width) / 2),
                                textY = height / 2;
                        ctx.fillText(text, textX, textY);
                        ctx.save();
                    }
                }
            ],
            options: {
                maintainAspectRatio: false,
                cutoutPercentage: 90,
                rotation: Math.PI / 2,
                legend: {
                    display: false
                },
                tooltips: {
                    filter: tooltipItem => tooltipItem.index === 0,
                    callbacks: {
                        afterLabel: function (tooltipItem, data) {
                            var dataset = data['datasets'][0];
                            var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset["_meta"][Object.keys(dataset["_meta"])[0]]['total']) * 100);
                            return '(' + percent + '%)';
                        }
                    }
                }
            }
        });
        //02
        new Chart(projectProgressChart_02, {
            type: 'doughnut',
            data: {
                datasets: [{
                        label: 'Complete',
                        percent: project_progress_02,
                        backgroundColor: ['#FFC107'],
                        borderWidth: 0
                    }]
            },
            plugins: [{
                    beforeInit: (chart) => {
                        const dataset = chart.data.datasets[0];
                        chart.data.labels = [dataset.label];
                        dataset.data = [dataset.percent, 100 - dataset.percent];
                    }
                },
                {
                    beforeDraw: (chart) => {
                        var width = chart.chart.width,
                                height = chart.chart.height,
                                ctx = chart.chart.ctx;
                        ctx.restore();
                        ctx.font = 1.5 + "em sans-serif";
                        ctx.fillStyle = "#9b9b9b";
                        ctx.textBaseline = "middle";
                        var text = chart.data.datasets[0].percent + "%",
                                textX = Math.round((width - ctx.measureText(text).width) / 2),
                                textY = height / 2;
                        ctx.fillText(text, textX, textY);
                        ctx.save();
                    }
                }
            ],
            options: {
                maintainAspectRatio: false,
                cutoutPercentage: 90,
                rotation: Math.PI / 2,
                legend: {
                    display: false
                },
                tooltips: {
                    filter: tooltipItem => tooltipItem.index === 0,
                    callbacks: {
                        afterLabel: function (tooltipItem, data) {
                            var dataset = data['datasets'][0];
                            var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset["_meta"][Object.keys(dataset["_meta"])[0]]['total']) * 100);
                            return '(' + percent + '%)';
                        }
                    }
                }
            }
        });
        //03
        new Chart(projectProgressChart_03, {
            type: 'doughnut',
            data: {
                datasets: [{
                        label: 'Complete',
                        percent: project_progress_03,
                        backgroundColor: ['#6C757D'],
                        borderWidth: 0
                    }]
            },
            plugins: [{
                    beforeInit: (chart) => {
                        const dataset = chart.data.datasets[0];
                        chart.data.labels = [dataset.label];
                        dataset.data = [dataset.percent, 100 - dataset.percent];
                    }
                },
                {
                    beforeDraw: (chart) => {
                        var width = chart.chart.width,
                                height = chart.chart.height,
                                ctx = chart.chart.ctx;
                        ctx.restore();
                        ctx.font = 1.5 + "em sans-serif";
                        ctx.fillStyle = "#9b9b9b";
                        ctx.textBaseline = "middle";
                        var text = chart.data.datasets[0].percent + "%",
                                textX = Math.round((width - ctx.measureText(text).width) / 2),
                                textY = height / 2;
                        ctx.fillText(text, textX, textY);
                        ctx.save();
                    }
                }
            ],
            options: {
                maintainAspectRatio: false,
                cutoutPercentage: 90,
                rotation: Math.PI / 2,
                legend: {
                    display: false
                },
                tooltips: {
                    filter: tooltipItem => tooltipItem.index === 0,
                    callbacks: {
                        afterLabel: function (tooltipItem, data) {
                            var dataset = data['datasets'][0];
                            var percent = Math.round((dataset['data'][tooltipItem['index']] / dataset["_meta"][Object.keys(dataset["_meta"])[0]]['total']) * 100);
                            return '(' + percent + '%)';
                        }
                    }
                }
            }
        });
    });
</script>
