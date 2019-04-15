<template>
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						網站流量統計 ( 過去 {{lastDays}} 天 )
					</h3>
				</div>
				<div class="panel-body">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#home">頁面瀏覽排名</a></li>
                        <li><a data-toggle="tab" href="#menu1">訪客種類</a></li>
                    </ul>

                    <div class="tab-content ch-tab-content">
                        <div id="home" class="tab-pane fade in active">
                            <div class="bar-chart"></div>
                        </div>
                        <div id="menu1" class="tab-pane fade">
                            <div class="pie-chart"></div>
                            <div class="user-type-list">
                                <ul>
                                    <li v-for="item in userType">
                                        <span v-if="item.type === 'New Visitor'">新訪客： </span>
                                        <span v-else>回流訪客： </span>
                                        {{item.sessions}}人次
                                    </li>
                                </ul>
                            </div>
                            <!-- <svg class='pie-chart' width="960" height="500"></svg> -->
                        </div>
                    </div>
                    <!-- <button type="button" name="button" @click="getPageViews()">analytics</button> -->
                    <!-- <div class="alert alert-info">
                        <div class="bar-chart">

                        </div>
                        <strong>目前資料庫並無數據可統計，</strong>數據將於流量產生後即可顯示
                    </div> -->
				</div>
			</div>
        </div>
        <div class="col-md-12">
            <div class="panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">
						訂單狀態
					</h3>
				</div>
				<div class="panel-body">
                    <div class="alert alert-warning">
                        <strong>目前沒有新訂單。</strong>
                    </div>
				</div>
			</div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                analyticsData: [],
                userType: [],
                lastDays: 14,
            }
        },
        created: function () {
            $('.loading-bar').fadeOut('100');
            this.generateChart();
            this.generatePieChart();
        },
        methods: {
            generateChart: function () {
                var self = this;

                this.getPageViews().then(function (value) {

                    d3.select('.bar-chart')
                      .selectAll('div')
                      .data(value)
                      .enter()
                      .append('div')
                      .attr('class', 'item clearfix')
                      .text(function (d) {
                          return d.url;
                      })
                      .append('div')
                      .text(function (data) {
                          return data.pageViews;
                      })
                      .attr('class','bar')
                      .style('width', function(d){
                          return (d.pageViews * 100 / value[0].pageViews)  + '%';
                      });
                });
            },
            generatePieChart: function () {
                var serlf = this;

                this.getUserType().then(function (value) {
                    var data = value;

                    var width = 800,
                        height = 600,
                        radius = Math.min(width, height) / 2;

                    var color = d3.scale.ordinal()
                        .range(["#98abc5", "#8a89a6", "#7b6888", "#6b486b", "#a05d56", "#d0743c", "#ff8c00"]);

                    var arc = d3.svg.arc()
                        .outerRadius(radius - 10)
                        .innerRadius(radius - 130);

                    var pie = d3.layout.pie()
                        .sort(null)
                        .value(function (d) {
                        return d.sessions;
                    });



                    var svg = d3.select(".pie-chart").append("svg")
                        .attr("width", width)
                        .attr("height", height)
                        .append("g")
                        .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

                        var g = svg.selectAll(".arc")
                            .data(pie(data))
                            .enter().append("g")
                            .attr("class", "arc");

                        g.append("path")
                            .attr("d", arc)
                            .style("fill", function (d) {
                            return color(d.data.type);
                        });

                        g.append("text")
                            .attr("transform", function (d) {
                            return "translate(" + arc.centroid(d) + ")";
                        })
                            .attr("dy", ".35em")
                            .style("font-size", "30px")
                            .style("text-anchor", "middle")
                            .text(function (d) {
                                if (d.data.type === "New Visitor") {
                                    return '新訪客 \n';
                                } else {
                                    return '回流訪客 \n';
                                }
                        });
                });
            },
            getPageViews: function () {
                var self = this;

                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: '/admin/analytics/get/pageViews/' + self.lastDays,
                        type: 'GET',
                        dataType: 'json'
                    })
                    .done(function(result) {
                        self.analyticsData = [];

                        result.forEach(function (item) {
                            if ((item.pageTitle !== 'good 烘焙房') &&
                                (item.pageTitle !== '台灣帕太股份有限公司') &&
                                (item.pageTitle !== '(not set)')) {
                                self.analyticsData.push(item);
                            }
                        });

                        resolve(self.analyticsData);
                    })
                    .fail(function(xhr) {
                        reject(xhr);
                    });
                });
            },
            getUserType: function () {
                var self = this;

                return new Promise(function (resolve, reject) {
                    $.ajax({
                        url: '/admin/analytics/get/getUserType/' + self.lastDays,
                        type: 'GET',
                        dataType: 'json'
                    })
                    .done(function(result) {
                        self.userType = result;
                        resolve(result);
                    })
                    .fail(function() {
                        reject("error");
                    });
                });
            }
        }
    }
</script>
