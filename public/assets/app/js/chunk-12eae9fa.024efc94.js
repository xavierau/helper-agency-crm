(window["webpackJsonp"]=window["webpackJsonp"]||[]).push([["chunk-12eae9fa"],{"8db4":function(t,e,r){"use strict";var a=r("7ed9"),i=r("2ef0");function n(t){return n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(t){return typeof t}:function(t){return t&&"function"==typeof Symbol&&t.constructor===Symbol&&t!==Symbol.prototype?"symbol":typeof t},n(t)}function o(t,e){var r=Object.keys(t);if(Object.getOwnPropertySymbols){var a=Object.getOwnPropertySymbols(t);e&&(a=a.filter((function(e){return Object.getOwnPropertyDescriptor(t,e).enumerable}))),r.push.apply(r,a)}return r}function s(t){for(var e=1;e<arguments.length;e++){var r=null!=arguments[e]?arguments[e]:{};e%2?o(Object(r),!0).forEach((function(e){l(t,e,r[e])})):Object.getOwnPropertyDescriptors?Object.defineProperties(t,Object.getOwnPropertyDescriptors(r)):o(Object(r)).forEach((function(e){Object.defineProperty(t,e,Object.getOwnPropertyDescriptor(r,e))}))}return t}function l(t,e,r){return e=u(e),e in t?Object.defineProperty(t,e,{value:r,enumerable:!0,configurable:!0,writable:!0}):t[e]=r,t}function u(t){var e=c(t,"string");return"symbol"==n(e)?e:String(e)}function c(t,e){if("object"!=n(t)||!t)return t;var r=t[Symbol.toPrimitive];if(void 0!==r){var a=r.call(t,e||"default");if("object"!=n(a))return a;throw new TypeError("@@toPrimitive must return a primitive value.")}return("string"===e?String:Number)(t)}var p={data:function(){return{fields:[],columnFilters:{},sorter:null,pageSize:15,paginator:null,search:null,external_url:null}},computed:{items:function(){return this.paginator?this.paginator.data:null},paginationObject:function(){var t,e,r,a;return{pages:(null===(t=this.paginator)||void 0===t||null===(t=t.meta)||void 0===t?void 0:t.last_page)||(null===(e=this.paginator)||void 0===e?void 0:e.last_page)||0,activePage:(null===(r=this.paginator)||void 0===r||null===(r=r.meta)||void 0===r?void 0:r.current_page)||(null===(a=this.paginator)||void 0===a?void 0:a.current_page)||0}}},created:function(){this.fetchItems()},methods:{fetchItems:function(){var t=this,e=arguments.length>0&&void 0!==arguments[0]?arguments[0]:{};this.columnFilters=this.$route.query;var r=Object.keys(this.columnFilters).reduce((function(e,r){var a;t.columnFilters[r]&&Object(i["isArray"])(t.columnFilters[r])?e["filter[".concat(r,"]")]=[null===(a=t.columnFilters[r])||void 0===a?void 0:a.join(",")]:e["filter[".concat(r,"]")]=t.columnFilters[r];return e}),{}),n={params:s(s({"filter[search]":this.search,pageSize:this.pageSize,sort:this.sorter},r),e)};a["a"].get(this.external_url,n).then((function(e){var r=e.data;return t.paginator=r})).catch((function(t){return console.log(t)})).finally((function(){return t.isLoading=!1}))},updateTableFilter:function(t){this.search=t,this.fetchItems()},updateColumnFilter:function(t){"change"!==t.type&&(this.columnFilters=Object.assign(this.columnFilters,t)),this.fetchItems()},updateSorter:function(t){this.sorter=t.asc?t.column:"-".concat(t.column),this.fetchItems()},updatePerPageItems:function(t){this.pageSize=t,this.fetchItems()},updateActivePage:function(t){this.fetchItems({page:t})}}};e["a"]=p},cb50:function(t,e,r){"use strict";var a={list:"/api/agencycore/suppliers",store:"/api/agencycore/suppliers",edit:function(t){return"/api/agencycore/suppliers/".concat(t)}};e["a"]=a},f2af:function(t,e,r){"use strict";r.r(e);var a=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("div",{staticClass:"SupplierIndex"},[r("CCard",[r("CCardHeader",{staticClass:"d-flex justify-content-between align-content-center"},[r("h5",{staticClass:"m-0"},[t._v("Suppliers")]),r("button",{staticClass:"btn btn-sm btn-success",on:{click:t.createSupplier}},[r("i",{staticClass:"fa fa-plus"}),t._v(" Supplier ")])]),t.items?r("CCardBody",[r("CDataTable",{attrs:{items:t.items,fields:t.fields,loading:t.isLoading,hover:"","items-per-page":t.pageSize,"column-filter":{external:!0,lazy:!0},"table-filter":{external:!0,lazy:!0},sorter:{external:!0,resetable:!0}},on:{"pagination-change":t.updatePerPageItems,"update:table-filter-value":t.updateTableFilter,"update:column-filter-value":t.updateColumnFilter,"update:sorter-value":t.updateSorter},scopedSlots:t._u([{key:"actions",fn:function(e){var a=e.item;return[r("td",[r("router-link",{staticClass:"btn btn-sm btn-icon btn-primary",attrs:{to:{name:"Supplier",params:{id:a.id}}}},[r("i",{staticClass:"fa fa-eye"})]),r("button",{staticClass:"ml-1 btn btn-sm btn-icon btn-info",on:{click:function(e){return t.editSupplier(a)}}},[r("i",{staticClass:"fas fa-edit"})])],1)]}}],null,!1,1025026725)})],1):r("CCardBody",[r("h4",[t._v("Loading...")])])],1),r("CModal",{attrs:{show:t.showSupplierFormModal,title:t.modalHeader,color:"success",static:"",size:"xl"},on:{"update:show":function(e){t.showSupplierFormModal=e}},scopedSlots:t._u([{key:"footer",fn:function(){return[r("button",{staticClass:"btn btn-success",on:{click:t.submit}},[t._v(" "+t._s(t.formButtonText))])]},proxy:!0}])},[r("supplier-form",{attrs:{"form-data":t.formData},on:{"update:formData":function(e){t.formData=e},"update:form-data":function(e){t.formData=e}}})],1)],1)},i=[],n=r("cb50"),o=function(){var t=this,e=t.$createElement,r=t._self._c||e;return r("form",{staticClass:"form"},[r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"label"}},[t._v("Label")]),r("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.name,expression:"formData.name"}],staticClass:"form-control",attrs:{id:"label",type:"text"},domProps:{value:t.formData.name},on:{input:function(e){e.target.composing||t.$set(t.formData,"name",e.target.value)}}})]),r("div",{staticClass:"form-group"},[r("label",{attrs:{for:"code"}},[t._v("Code")]),r("input",{directives:[{name:"model",rawName:"v-model",value:t.formData.code,expression:"formData.code"}],staticClass:"form-control",attrs:{id:"code",type:"text"},domProps:{value:t.formData.code},on:{input:function(e){e.target.composing||t.$set(t.formData,"code",e.target.value)}}})])])},s=[],l={name:"SupplierForm",props:{formData:{type:Object,required:!0}}},u=l,c=r("2877"),p=Object(c["a"])(u,o,s,!1,null,"e5a4dac8",null),f=p.exports,d=r("7ed9"),m=r("8db4"),h={name:"SupplierIndex",components:{SupplierForm:f},mixins:[m["a"]],data:function(){return{showSupplierFormModal:!1,showAttachWorkflowModal:!1,isLoading:!0,external_url:n["a"].list,isEdit:!1,entity:null,entities:[],fields:[{key:"name"},{key:"code"},{key:"actions",sorter:!1,filter:!1}],formData:{id:null,name:null,code:null}}},computed:{formButtonText:function(){return this.isEdit?"Update":"Create"},modalHeader:function(){return this.isEdit?"Update Supplier":"Create Supplier"},successMessage:function(){return this.isEdit?"Supplier updated":"Supplier created"}},methods:{editSupplier:function(t){this.formData.id=t.id,this.formData.name=t.name,this.formData.code=t.code,this.isEdit=!0,this.showSupplierFormModal=!0},createSupplier:function(){this.resetFormData(),this.isEdit=!1,this.showSupplierFormModal=!0},submit:function(){var t=this;this.isLoading=!0;var e=this.isEdit?n["a"].edit(this.formData.id):n["a"].store,r=this.isEdit?"put":"post";d["a"][r](e,this.formData).then((function(){return t.fetchItems()})).then((function(){return t.$toasted.success(t.successMessage)})).then((function(){return t.resetFormData()})).then((function(){return t.showSupplierFormModal=!1})).catch((function(e){return t.$toasted.error("Something wrong. "+e.message)})).finally((function(){return t.isLoading=!1}))},resetFormData:function(){this.formData={id:null,label:null,code:null}}}},b=h,g=Object(c["a"])(b,a,i,!1,null,"f9b0adf4",null);e["default"]=g.exports}}]);