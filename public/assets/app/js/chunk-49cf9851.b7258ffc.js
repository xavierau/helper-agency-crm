(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-49cf9851"],{"0d3be":function(t,e,n){"use strict";n.r(e);var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"NewsIndex"},[n("CCard",[n("CCardHeader",{staticClass:"d-flex justify-content-between align-content-center"},[n("h5",{staticClass:"m-0"},[t._v("News")]),n("router-link",{staticClass:"btn btn-sm btn-success",attrs:{to:{name:"Create News"}}},[n("i",{staticClass:"fa fa-plus"})])],1),n("CCardBody",[n("CDataTable",{attrs:{items:t.items,fields:t.fields,loading:t.isLoading,hover:"","items-per-page":t.pageSize,"items-per-page-select":{external:!0},"column-filter":{external:!0,lazy:!0},"table-filter":{external:!0,lazy:!0},sorter:{external:!0,resetable:!0}},on:{"pagination-change":t.updatePerPageItems,"update:table-filter-value":t.updateTableFilter,"update:column-filter-value":t.updateColumnFilter,"update:sorter-value":t.updateSorter},scopedSlots:t._u([{key:"is_active",fn:function(e){var a=e.item;return[n("td",[n("span",{staticClass:"badge",class:{"badge-success":!0===a.is_active,"badge-warning":!1===a.is_active}},[t._v(t._s(a.is_active))])])]}},{key:"actions",fn:function(e){var a=e.item;return[n("td",[n("div",{staticClass:"btn-group btn-group-sm mr-3"},[t.canEdit?n("router-link",{staticClass:"btn btn-info",attrs:{to:{name:"Edit News",params:{id:a.id}}}},[n("i",{staticClass:"fa fa-edit"})]):t._e()],1),n("button",{staticClass:"btn btn-sm btn-danger"},[n("i",{staticClass:"fa fa-trash"})])])]}}])}),n("CPagination",{attrs:{activePage:t.paginationObject.activePage,pages:t.paginationObject.pages},on:{"update:activePage":t.updateActivePage}})],1)],1)],1)},i=[],r=n("8db4"),s=n("44f1"),o=n("b23f"),c={name:"NewsIndex",mixins:[r["a"]],filters:{capitalize:s["a"],formatCurrency:s["b"]},data:function(){return{showCreateInvoiceModal:!1,isLoading:!0,search:null,fields:[{key:"title"},{key:"summary"},{key:"is_active"},{key:"actions",sorter:!1,filter:!1}],external_url:o["a"].list_news,newsPaginator:null,formData:{client_id:null,sellables:[]}}},computed:{clients:function(){return this.newsPaginator?this.newsPaginator.items:[]},permissions:function(){return this.$store.getters.permissions},canEdit:function(){return this.$store.getters.can("agency-finance:invoice.edit")}},created:function(){this.fetchItems()},methods:{}},u=c,l=n("2877"),f=Object(l["a"])(u,a,i,!1,null,"4a71599a",null);e["default"]=f.exports},"8db4":function(t,e,n){"use strict";var a=n("7ed9"),i=n("2ef0");function r(t){return r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},r(t)}function s(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function o(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?s(Object(n),!0).forEach((function(e){c(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):s(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function c(t,e,n){return e=u(e),e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function u(t){var e=l(t,"string");return"symbol"==r(e)?e:String(e)}function l(t,e){if("object"!=r(t)||!t)return t;var n=t[Symbol.toPrimitive];if(void 0!==n){var a=n.call(t,e||"default");if("object"!=r(a))return a;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}var f={data:function(){return{fields:[],columnFilters:{},sorter:null,pageSize:15,paginator:null,search:null,external_url:null}},computed:{items:function(){return this.paginator?this.paginator.data:null},paginationObject:function(){var t,e,n,a;return{pages:(null===(t=this.paginator)||void 0===t||null===(t=t.meta)||void 0===t?void 0:t.last_page)||(null===(e=this.paginator)||void 0===e?void 0:e.last_page)||0,activePage:(null===(n=this.paginator)||void 0===n||null===(n=n.meta)||void 0===n?void 0:n.current_page)||(null===(a=this.paginator)||void 0===a?void 0:a.current_page)||0}}},created:function(){this.fetchItems()},methods:{fetchItems:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};this.columnFilters=this.$route.query;var n=Object.keys(this.columnFilters).reduce((function(e,n){var a;t.columnFilters[n]&&Object(i["isArray"])(t.columnFilters[n])?e["filter[".concat(n,"]")]=[null===(a=t.columnFilters[n])||void 0===a?void 0:a.join(",")]:e["filter[".concat(n,"]")]=t.columnFilters[n];return e}),{}),r={params:o(o({"filter[search]":this.search,pageSize:this.pageSize,sort:this.sorter},n),e)};a["a"].get(this.external_url,r).then((function(e){var n=e.data;return t.paginator=n})).catch((function(t){return console.log(t)})).finally((function(){return t.isLoading=!1}))},updateTableFilter:function(t){this.search=t,this.fetchItems()},updateColumnFilter:function(t){"change"!==t.type&&(this.columnFilters=Object.assign(this.columnFilters,t)),this.fetchItems()},updateSorter:function(t){this.sorter=t.asc?t.column:"-".concat(t.column),this.fetchItems()},updatePerPageItems:function(t){this.pageSize=t,this.fetchItems()},updateActivePage:function(t){this.fetchItems({page:t})}}};e["a"]=f},b23f:function(t,e,n){"use strict";var a={pages:"/api/cms/pages",get_page_content:function(t){return"/api/cms/pages/".concat(t,"/contents")},update_page_content:function(t,e){return"/api/cms/pages/".concat(t,"/contents/").concat(e)},common_contents:"/api/cms/common_contents",common_content:function(t){return"/api/cms/common_contents/".concat(t)},update_common_content:function(t){return"/api/cms/common_contents/".concat(t)},list_news:"/api/cms/news",create_news:"/api/cms/news",get_news:function(t){return"/api/cms/news/".concat(t)}};e["a"]=a}}]);