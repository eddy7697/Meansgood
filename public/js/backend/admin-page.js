!function(t){function e(n){if(a[n])return a[n].exports;var s=a[n]={i:n,l:!1,exports:{}};return t[n].call(s.exports,s,s.exports,e),s.l=!0,s.exports}var a={};e.m=t,e.c=a,e.d=function(t,a,n){e.o(t,a)||Object.defineProperty(t,a,{configurable:!1,enumerable:!0,get:n})},e.n=function(t){var a=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(a,"a",a),a},e.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},e.p="",e(e.s=189)}({1:function(t,e){t.exports=function(t,e,a,n,s,i){var r,l=t=t||{},o=typeof t.default;"object"!==o&&"function"!==o||(r=t,l=t.default);var c="function"==typeof l?l.options:l;e&&(c.render=e.render,c.staticRenderFns=e.staticRenderFns,c._compiled=!0),a&&(c.functional=!0),s&&(c._scopeId=s);var u;if(i?(u=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),n&&n.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(i)},c._ssrRegister=u):n&&(u=n),u){var d=c.functional,p=d?c.render:c.beforeCreate;d?(c._injectStyles=u,c.render=function(t,e){return u.call(e),p(t,e)}):c.beforeCreate=p?[].concat(p,u):[u]}return{esModule:r,exports:l,options:c}}},189:function(t,e,a){t.exports=a(190)},190:function(t,e,a){Vue.component("adminpage",a(191));new Vue({el:"#adminPage"})},191:function(t,e,a){var n=a(1)(a(192),a(193),!1,null,null,null);t.exports=n.exports},192:function(t,e,a){"use strict";Object.defineProperty(e,"__esModule",{value:!0}),e.default={data:function(){return{analyticsData:[],userType:[],lastDays:14}},created:function(){$(".loading-bar").fadeOut("100"),this.generateChart(),this.generatePieChart()},methods:{generateChart:function(){this.getPageViews().then(function(t){d3.select(".bar-chart").selectAll("div").data(t).enter().append("div").attr("class","item clearfix").text(function(t){return t.url}).append("div").text(function(t){return t.pageViews}).attr("class","bar").style("width",function(e){return 100*e.pageViews/t[0].pageViews+"%"})})},generatePieChart:function(){this.getUserType().then(function(t){var e=t,a=Math.min(800,600)/2,n=d3.scale.ordinal().range(["#98abc5","#8a89a6","#7b6888","#6b486b","#a05d56","#d0743c","#ff8c00"]),s=d3.svg.arc().outerRadius(a-10).innerRadius(a-130),i=d3.layout.pie().sort(null).value(function(t){return t.sessions}),r=d3.select(".pie-chart").append("svg").attr("width",800).attr("height",600).append("g").attr("transform","translate(400,300)").selectAll(".arc").data(i(e)).enter().append("g").attr("class","arc");r.append("path").attr("d",s).style("fill",function(t){return n(t.data.type)}),r.append("text").attr("transform",function(t){return"translate("+s.centroid(t)+")"}).attr("dy",".35em").style("font-size","30px").style("text-anchor","middle").text(function(t){return"New Visitor"===t.data.type?"新訪客 \n":"回流訪客 \n"})})},getPageViews:function(){var t=this;return new Promise(function(e,a){$.ajax({url:"/admin/analytics/get/pageViews/"+t.lastDays,type:"GET",dataType:"json"}).done(function(a){t.analyticsData=[],a.forEach(function(e){"good 烘焙房"!==e.pageTitle&&"台灣帕太股份有限公司"!==e.pageTitle&&"(not set)"!==e.pageTitle&&t.analyticsData.push(e)}),e(t.analyticsData)}).fail(function(t){a(t)})})},getUserType:function(){var t=this;return new Promise(function(e,a){$.ajax({url:"/admin/analytics/get/getUserType/"+t.lastDays,type:"GET",dataType:"json"}).done(function(a){t.userType=a,e(a)}).fail(function(){a("error")})})}}}},193:function(t,e){t.exports={render:function(){var t=this,e=t.$createElement,a=t._self._c||e;return a("div",{staticClass:"row"},[a("div",{staticClass:"col-md-12"},[a("div",{staticClass:"panel panel-default"},[a("div",{staticClass:"panel-heading"},[a("h3",{staticClass:"panel-title"},[t._v("\n\t\t\t\t\t\t網站流量統計 ( 過去 "+t._s(t.lastDays)+" 天 )\n\t\t\t\t\t")])]),t._v(" "),a("div",{staticClass:"panel-body"},[t._m(0),t._v(" "),a("div",{staticClass:"tab-content ch-tab-content"},[t._m(1),t._v(" "),a("div",{staticClass:"tab-pane fade",attrs:{id:"menu1"}},[a("div",{staticClass:"pie-chart"}),t._v(" "),a("div",{staticClass:"user-type-list"},[a("ul",t._l(t.userType,function(e){return a("li",["New Visitor"===e.type?a("span",[t._v("新訪客： ")]):a("span",[t._v("回流訪客： ")]),t._v("\n                                        "+t._s(e.sessions)+"人次\n                                    ")])}))])])])])])]),t._v(" "),t._m(2)])},staticRenderFns:[function(){var t=this.$createElement,e=this._self._c||t;return e("ul",{staticClass:"nav nav-tabs"},[e("li",{staticClass:"active"},[e("a",{attrs:{"data-toggle":"tab",href:"#home"}},[this._v("頁面瀏覽排名")])]),this._v(" "),e("li",[e("a",{attrs:{"data-toggle":"tab",href:"#menu1"}},[this._v("訪客種類")])])])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"tab-pane fade in active",attrs:{id:"home"}},[e("div",{staticClass:"bar-chart"})])},function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticClass:"col-md-12"},[e("div",{staticClass:"panel panel-default"},[e("div",{staticClass:"panel-heading"},[e("h3",{staticClass:"panel-title"},[this._v("\n\t\t\t\t\t\t訂單狀態\n\t\t\t\t\t")])]),this._v(" "),e("div",{staticClass:"panel-body"},[e("div",{staticClass:"alert alert-warning"},[e("strong",[this._v("目前沒有新訂單。")])])])])])}]}}});