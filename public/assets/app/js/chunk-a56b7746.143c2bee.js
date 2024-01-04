(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-a56b7746"],{"8db4":function(t,e,n){"use strict";var a=n("7ed9"),o=n("2ef0");function r(t){return r="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},r(t)}function i(t,e){var n=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),n.push.apply(n,a)}return n}function s(t){for(var e=1;e<arguments.length;e++){var n=null!=arguments[e]?arguments[e]:{};e%2?i(Object(n),!0).forEach((function(e){l(t,e,n[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(n)):i(Object(n)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(n,e))}))}return t}function l(t,e,n){return e=c(e),e in t?Object.defineProperty(t,e,{value:n,enumerable:!0,configurable:!0,writable:!0}):t[e]=n,t}function c(t){var e=u(t,"string");return"symbol"==r(e)?e:String(e)}function u(t,e){if("object"!=r(t)||!t)return t;var n=t[Symbol.toPrimitive];if(void 0!==n){var a=n.call(t,e||"default");if("object"!=r(a))return a;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}var d={data:function(){return{fields:[],columnFilters:{},sorter:null,pageSize:15,paginator:null,search:null,external_url:null}},computed:{items:function(){return this.paginator?this.paginator.data:null},paginationObject:function(){var t,e,n,a;return{pages:(null===(t=this.paginator)||void 0===t||null===(t=t.meta)||void 0===t?void 0:t.last_page)||(null===(e=this.paginator)||void 0===e?void 0:e.last_page)||0,activePage:(null===(n=this.paginator)||void 0===n||null===(n=n.meta)||void 0===n?void 0:n.current_page)||(null===(a=this.paginator)||void 0===a?void 0:a.current_page)||0}}},created:function(){this.fetchItems()},methods:{fetchItems:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};this.columnFilters=this.$route.query;var n=Object.keys(this.columnFilters).reduce((function(e,n){var a;t.columnFilters[n]&&Object(o["isArray"])(t.columnFilters[n])?e["filter[".concat(n,"]")]=[null===(a=t.columnFilters[n])||void 0===a?void 0:a.join(",")]:e["filter[".concat(n,"]")]=t.columnFilters[n];return e}),{}),r={params:s(s({"filter[search]":this.search,pageSize:this.pageSize,sort:this.sorter},n),e)};a["a"].get(this.external_url,r).then((function(e){var n=e.data;return t.paginator=n})).catch((function(t){return console.log(t)})).finally((function(){return t.isLoading=!1}))},updateTableFilter:function(t){this.search=t,this.fetchItems()},updateColumnFilter:function(t){"change"!==t.type&&(this.columnFilters=Object.assign(this.columnFilters,t)),this.fetchItems()},updateSorter:function(t){this.sorter=t.asc?t.column:"-".concat(t.column),this.fetchItems()},updatePerPageItems:function(t){this.pageSize=t,this.fetchItems()},updateActivePage:function(t){this.fetchItems({page:t})}}};e["a"]=d},af5f:function(t,e,n){"use strict";n.r(e);var a=function(){var t=this,e=t.$createElement,n=t._self._c||e;return n("div",{staticClass:"DutyIndex"},[n("CCard",[n("CCardHeader",{staticClass:"d-flex justify-content-between align-content-center"},[n("h5",{staticClass:"m-0"},[t._v("Duties")]),n("button",{staticClass:"btn btn-sm btn-success",on:{click:function(e){t.showCreateModal=!0}}},[n("i",{staticClass:"fa fa-plus"})])]),n("CCardBody",[n("CDataTable",{attrs:{items:t.items,fields:t.fields,loading:t.isLoading,hover:"","items-per-page":t.pageSize,"items-per-page-select":{external:!0},"column-filter":{external:!0,lazy:!0},"table-filter":{external:!0,lazy:!0},sorter:{external:!0,resetable:!0}},on:{"pagination-change":t.updatePerPageItems,"update:table-filter-value":t.updateTableFilter,"update:column-filter-value":t.updateColumnFilter,"update:sorter-value":t.updateSorter},scopedSlots:t._u([{key:"label",fn:function(e){var a=e.item;return[n("td",[n("button",{staticClass:"btn",on:{click:function(e){return t.editItem(a)}}},[t._v(t._s(a.label))])])]}},{key:"actions",fn:function(e){var a=e.item;return[n("td",[n("button",{staticClass:"btn btn-sm btn-danger",attrs:{type:"button"},on:{click:function(e){return t.goingDeleteItem(a)}}},[n("i",{staticClass:"fa fa-trash-alt"})])])]}}])}),n("CPagination",{attrs:{activePage:t.paginationObject.activePage,pages:t.paginationObject.pages},on:{"update:activePage":t.updateActivePage}})],1)],1),n("CModal",{attrs:{title:"Warning",color:"warning",centered:"","close-on-backdrop":!1,show:t.deleteWarningModal},scopedSlots:t._u([{key:"footer",fn:function(){return[n("div",{staticClass:"w-100 d-flex justify-content-between"},[n("button",{staticClass:"btn btn-secondary",on:{click:t.closeModal}},[t._v("Close")]),n("button",{staticClass:"btn btn-danger",on:{click:t.deleteItem}},[t._v("Delete")])])]},proxy:!0}])},[t._v(" Are you sure to delete the item? ")]),n("CModal",{attrs:{title:"Create Duty",color:"success","close-on-backdrop":!1,show:t.showCreateModal},scopedSlots:t._u([{key:"footer",fn:function(){return[n("div",{staticClass:"w-100 d-flex justify-content-between"},[n("button",{staticClass:"btn btn-secondary",on:{click:function(e){t.showCreateModal=!1}}},[t._v("Close")]),n("button",{staticClass:"btn btn-success",on:{click:t.createItem}},[t._v("Create")])])]},proxy:!0}])},[n("form",{staticClass:"form"},[n("div",{staticClass:"form-group"},[n("label",[t._v("Label")]),n("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.label,expression:"formData.label"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.formData.label},on:{input:function(e){e.target.composing||t.$set(t.formData,"label",e.target.value)}}})])])]),n("CModal",{attrs:{title:"Create Duty",color:"success","close-on-backdrop":!1,show:t.showCreateModal},scopedSlots:t._u([{key:"footer",fn:function(){return[n("div",{staticClass:"w-100 d-flex justify-content-between"},[n("button",{staticClass:"btn btn-secondary",on:{click:function(e){t.showCreateModal=!1}}},[t._v("Close")]),n("button",{staticClass:"btn btn-success",on:{click:t.createItem}},[t._v("Create")])])]},proxy:!0}])},[n("form",{staticClass:"form"},[n("div",{staticClass:"form-group"},[n("label",[t._v("Label")]),n("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.label,expression:"formData.label"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.formData.label},on:{input:function(e){e.target.composing||t.$set(t.formData,"label",e.target.value)}}})])])]),n("CModal",{attrs:{title:"Edit Duty",color:"info","close-on-backdrop":!1,show:t.showEditModal},scopedSlots:t._u([{key:"footer",fn:function(){return[n("div",{staticClass:"w-100 d-flex justify-content-between"},[n("button",{staticClass:"btn btn-secondary",on:{click:function(e){t.showEditModal=!1}}},[t._v("Close")]),n("button",{staticClass:"btn btn-success",on:{click:t.updateItem}},[t._v("Update")])])]},proxy:!0}])},[t.selectedItem?n("form",{staticClass:"form"},[n("div",{staticClass:"form-group"},[n("label",[t._v("Label")]),n("input",{directives:[{name:"model",rawName:"v-model",value:t.selectedItem.label,expression:"selectedItem.label"}],staticClass:"form-control",attrs:{type:"text"},domProps:{value:t.selectedItem.label},on:{input:function(e){e.target.composing||t.$set(t.selectedItem,"label",e.target.value)}}})])]):t._e()])],1)},o=[],r=n("d322"),i=n("8db4"),s=n("7ed9"),l={name:"DutyIndex",mixins:[i["a"]],data:function(){return{selectedDeleteItem:null,deleteWarningModal:!1,showCreateModal:!1,showEditModal:!1,isLoading:!0,fields:[{key:"label"},{key:"actions",sorter:!1,filter:!1}],external_url:r["a"].list,selectedItem:null,formData:{label:null}}},computed:{permissions:function(){return this.$store.getters.permissions},items:function(){return this.paginator?this.paginator.data:null},paginationObject:function(){return{pages:this.paginator?this.paginator.last_page:0,activePage:this.paginator?this.paginator.current_page:0}}},created:function(){this.fetchItems()},methods:{goingDeleteItem:function(t){this.selectedDeleteItem=t,this.deleteWarningModal=!0},deleteItem:function(){var t=this;s["a"].delete(r["a"].delete(this.selectedDeleteItem.id)).then((function(){return t.fetchItems()})).then((function(){return t.closeModal()})).catch((function(t){return console.log(t)}))},createItem:function(){var t=this;s["a"].post(r["a"].store,this.formData).then((function(){return t.fetchItems()})).then((function(){return t.formData.label=null})).then((function(){return t.showCreateModal=!1})).catch((function(t){return console.log(t)}))},editItem:function(t){this.selectedItem=t,this.showEditModal=!0},updateItem:function(){var t=this;s["a"].put(r["a"].update(this.selectedItem.id),this.selectedItem).then((function(){return t.fetchItems()})).then((function(){return t.selectedItem=null})).then((function(){return t.showEditModal=!1})).catch((function(t){return console.log(t)}))},closeModal:function(){this.selectedDeleteItem=null,this.deleteWarningModal=!1}}},c=l,u=n("2877"),d=Object(u["a"])(c,a,o,!1,null,"017f77b2",null);e["default"]=d.exports},d322:function(t,e,n){"use strict";var a={all:"/api/agencycore/duties/all",list:"/api/agencycore/duties",store:"/api/agencycore/duties",update:function(t){return"/api/agencycore/duties/".concat(t)},delete:function(t){return"/api/agencycore/duties/".concat(t)}};e["a"]=a}}]);